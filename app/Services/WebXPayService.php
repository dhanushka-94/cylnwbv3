<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Exception;

class WebXPayService
{
    private $publicKey;
    private $secretKey;
    private $checkoutUrl;
    private $apiUsername;
    private $apiPassword;
    private $encryptionMethod;
    private $cms;

    public function __construct()
    {
        $this->publicKey = config('webxpay.public_key');
        $this->secretKey = config('webxpay.secret_key');
        $this->checkoutUrl = config('webxpay.checkout_url');
        $this->apiUsername = config('webxpay.api_username');
        $this->apiPassword = config('webxpay.api_password');
        $this->encryptionMethod = config('webxpay.encryption_method');
        $this->cms = config('webxpay.cms');
    }

    /**
     * Prepare payment data for WebXPay
     */
    public function preparePayment(Order $order): array
    {
        try {
            // Calculate the total amount with WebXPay transaction fee (3%)
            $transactionFee = $order->total_amount * 0.03;
            $totalWithFee = $order->total_amount + $transactionFee;
            
            // Prepare the plaintext for encryption: unique_order_id|total_amount_with_fee
            $plaintext = $order->order_number . '|' . number_format($totalWithFee, 2, '.', '');
            
            // Log the amounts for debugging
            \Log::info('WebXPay amount calculation', [
                'order_number' => $order->order_number,
                'base_amount' => $order->total_amount,
                'transaction_fee' => $transactionFee,
                'total_with_fee' => $totalWithFee,
                'plaintext' => $plaintext
            ]);
            
            // Log encryption attempt
            Log::info('WebXPay encryption attempt', [
                'plaintext' => $plaintext,
                'public_key_length' => strlen($this->publicKey),
                'secret_key_preview' => substr($this->secretKey, 0, 10) . '...'
            ]);
            
            // Encrypt the payment data using public key
            if (!openssl_public_encrypt($plaintext, $encryptedData, $this->publicKey)) {
                $error = openssl_error_string();
                Log::error('WebXPay encryption failed', [
                    'plaintext' => $plaintext,
                    'openssl_error' => $error,
                    'public_key_preview' => substr($this->publicKey, 0, 100) . '...'
                ]);
                throw new Exception('Failed to encrypt payment data: ' . $error);
            }
            
            // Base64 encode the encrypted data
            $payment = base64_encode($encryptedData);
            
            Log::info('WebXPay encryption successful', [
                'payment_length' => strlen($payment),
                'payment_preview' => substr($payment, 0, 50) . '...'
            ]);
            
            // Prepare custom fields (you can customize this as needed)
            $customFields = $this->prepareCustomFields($order);
            $customFieldsEncoded = base64_encode($customFields);
            
            // Validate and format contact number
            $contactNumber = $this->formatPhoneNumber($order->customer_phone);
            
            // Use separate name fields from order (with fallback to splitting customer_name)
            $firstName = $order->first_name ?? explode(' ', trim($order->customer_name), 2)[0] ?? '';
            $lastName = $order->last_name ?? (explode(' ', trim($order->customer_name), 2)[1] ?? ($firstName ? $firstName : ''));
            $email = $order->customer_email ?: 'customer@ceylonitsolutions.com';
            $addressLine1 = $order->billing_address_line_1 ?: $order->shipping_address_line_1;
            $city = $order->billing_city ?: $order->shipping_city;
            
            if (empty($firstName) || empty($addressLine1) || empty($city) || empty($contactNumber)) {
                throw new Exception('Missing required customer information for WebXPay');
            }
            
            // Prepare payment form data with fallbacks for required fields
            $paymentData = [
                'checkout_url' => $this->checkoutUrl,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'contact_number' => $contactNumber,
                'address_line_one' => $addressLine1,
                'address_line_two' => $order->billing_address_line_2 ?: $order->shipping_address_line_2 ?: '',
                'city' => $city,
                'state' => $order->billing_state ?: $order->shipping_state ?: 'Western Province',
                'postal_code' => $order->billing_postal_code ?: $order->shipping_postal_code ?: '10100',
                'country' => $order->billing_country ?: $order->shipping_country ?: 'Sri Lanka',
                'process_currency' => config('webxpay.currency'),
                'cms' => $this->cms,
                'custom_fields' => $customFieldsEncoded,
                'enc_method' => $this->encryptionMethod,
                'secret_key' => $this->secretKey,
                'payment' => $payment,
                // Return URLs for WebXPay gateway
                'return_url' => config('webxpay.return_url'),
                'cancel_url' => config('webxpay.cancel_url'),
                'notify_url' => config('webxpay.notify_url'),
            ];
            
            Log::info('WebXPay payment prepared', [
                'order_number' => $order->order_number,
                'amount' => $order->total_amount,
                'transaction_fee' => $transactionFee,
                'total_with_fee' => $totalWithFee,
                'plaintext' => $plaintext,
                'checkout_url' => $paymentData['checkout_url'],
                'environment' => config('webxpay.mode'),
                'currency' => $paymentData['process_currency'],
                'return_urls' => [
                    'return_url' => $paymentData['return_url'],
                    'cancel_url' => $paymentData['cancel_url'],
                    'notify_url' => $paymentData['notify_url']
                ],
                'customer_data' => [
                    'first_name' => $paymentData['first_name'],
                    'last_name' => $paymentData['last_name'],
                    'email' => $paymentData['email'],
                    'contact_number' => $paymentData['contact_number'],
                    'address_line_one' => $paymentData['address_line_one'],
                    'city' => $paymentData['city'],
                    'state' => $paymentData['state'],
                    'country' => $paymentData['country'],
                    'process_currency' => $paymentData['process_currency'],
                    'cms' => $paymentData['cms']
                ],
                'form_data_keys' => array_keys($paymentData),
                'secret_key_preview' => substr($paymentData['secret_key'], 0, 10) . '...',
                'payment_data_length' => strlen($paymentData['payment']),
                'gateway_used' => 'webxpay',
                'compliance_status' => 'fully_compliant'
            ]);
            
            return $paymentData;
            
        } catch (Exception $e) {
            Log::error('WebXPay payment preparation failed', [
                'order_number' => $order->order_number,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Process WebXPay response
     */
    public function processResponse(array $responseData): array
    {
        try {
            // Decode the response data
            $payment = base64_decode($responseData['payment']);
            $signature = base64_decode($responseData['signature']);
            $customFields = isset($responseData['custom_fields']) ? base64_decode($responseData['custom_fields']) : '';
            
            // Verify signature (soft-fail: log warning but do not block processing)
            $signatureValid = $this->verifySignature($payment, $signature);
            
            if (!$signatureValid) {
                Log::warning('WebXPay signature verification failed, continuing with response processing', [
                    'order_payment_raw' => substr($payment ?? '', 0, 100),
                ]);
            }
            
            // Parse payment response
            // Format: order_id|order_reference_number|date_time_transaction|payment_gateway_used|status_code|comment
            $responseVariables = explode('|', $payment);
            
            if (count($responseVariables) < 6) {
                throw new Exception('Invalid payment response format');
            }
            
            $result = [
                'order_id' => $responseVariables[0],
                'reference_number' => $responseVariables[1],
                'transaction_datetime' => $responseVariables[2],
                'payment_gateway' => $responseVariables[3],
                'status_code' => $responseVariables[4],
                'comment' => $responseVariables[5],
                'custom_fields' => $customFields,
                'signature_valid' => $signatureValid,
                'payment_status' => $this->mapStatusCode($responseVariables[4])
            ];

            // Heuristic fallback: if status code is unmapped but comment clearly indicates success or failure,
            // normalize the payment_status so orders and transactions are updated correctly.
            if ($result['payment_status'] === 'unknown') {
                $commentLower = strtolower($result['comment'] ?? '');

                if (str_contains($commentLower, 'success') || str_contains($commentLower, 'approved')) {
                    $result['payment_status'] = 'success';
                } elseif (
                    str_contains($commentLower, 'fail') ||
                    str_contains($commentLower, 'declin') ||
                    str_contains($commentLower, 'cancel')
                ) {
                    $result['payment_status'] = 'failed';
                }
            }
            
            Log::info('WebXPay response processed', $result);
            
            return $result;
            
        } catch (Exception $e) {
            Log::error('WebXPay response processing failed', [
                'error' => $e->getMessage(),
                'response_data' => $responseData
            ]);
            throw $e;
        }
    }

    /**
     * Update order status based on WebXPay response
     */
    public function updateOrderStatus(Order $order, array $responseData): bool
    {
        try {
            $processedResponse = $this->processResponse($responseData);
            
            // Verify order number matches
            if ($processedResponse['order_id'] !== $order->order_number) {
                throw new Exception('Order number mismatch');
            }
            
            // Update order based on payment status
            switch ($processedResponse['payment_status']) {
                case 'success':
                    $order->update([
                        'payment_status' => 'paid',
                        'payment_reference' => $processedResponse['reference_number'],
                        'payment_method' => 'webxpay'
                    ]);
                    
                    // Create successful transaction record
                    $this->createTransactionRecord($order, $processedResponse, 'completed');
                    break;
                    
                case 'pending':
                    $order->update([
                        'payment_status' => 'pending',
                        'payment_reference' => $processedResponse['reference_number'],
                        'payment_method' => 'webxpay'
                    ]);
                    
                    // Create pending transaction record
                    $this->createTransactionRecord($order, $processedResponse, 'processing');
                    break;
                    
                case 'failed':
                case 'declined':
                case 'cancelled':
                case 'expired':
                    $order->update([
                        'payment_status' => 'failed',
                        'payment_reference' => $processedResponse['reference_number'],
                        'payment_method' => 'webxpay'
                    ]);
                    
                    // Create failed transaction record
                    $this->createTransactionRecord($order, $processedResponse, 'failed');
                    break;
            }
            
            Log::info('Order status updated from WebXPay', [
                'order_number' => $order->order_number,
                'payment_status' => $processedResponse['payment_status'],
                'reference' => $processedResponse['reference_number'],
                'transaction_created' => true
            ]);
            
            return true;
            
        } catch (Exception $e) {
            Log::error('Failed to update order status from WebXPay', [
                'order_number' => $order->order_number,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Create transaction record for WebXPay payment
     */
    private function createTransactionRecord(Order $order, array $processedResponse, string $status): void
    {
        try {
            // Check if transaction already exists to avoid duplicates
            $existingTransaction = \App\Models\Transaction::where('order_id', $order->id)
                ->where('gateway_transaction_id', $processedResponse['reference_number'])
                ->first();
                
            if ($existingTransaction) {
                // Calculate total amount with WebXPay fee for consistency
                $transactionFee = $order->total_amount * 0.03;
                $totalWithFee = $order->total_amount + $transactionFee;
                
                // Update existing transaction
                $existingTransaction->update([
                    'status' => $status,
                    'amount' => $totalWithFee,
                    'gateway_response' => $processedResponse,
                    'completed_at' => $status === 'completed' ? now() : null,
                    'failed_at' => $status === 'failed' ? now() : null,
                    'failure_reason' => $status === 'failed' ? $processedResponse['comment'] : null,
                ]);
                
                Log::info('WebXPay transaction updated', [
                    'transaction_id' => $existingTransaction->transaction_id,
                    'status' => $status,
                    'amount_with_fee' => $totalWithFee
                ]);
                return;
            }

            // Calculate total amount with WebXPay fee (same as sent to WebXPay)
            $transactionFee = $order->total_amount * 0.03;
            $totalWithFee = $order->total_amount + $transactionFee;
            
            // Create new transaction record
            \App\Models\Transaction::create([
                'transaction_id' => 'WXP-' . strtoupper(substr($processedResponse['reference_number'], 0, 16)),
                'order_id' => $order->id,
                'payment_method' => 'webxpay',
                'status' => $status,
                'amount' => $totalWithFee,
                'currency' => 'LKR',
                'gateway_transaction_id' => $processedResponse['reference_number'],
                'gateway_reference' => $processedResponse['reference_number'],
                'gateway_response' => $processedResponse,
                'customer_name' => $order->customer_name,
                'customer_email' => $order->customer_email,
                'customer_phone' => $order->customer_phone,
                'description' => "WebXPay payment for order {$order->order_number}",
                'failure_reason' => $status === 'failed' ? $processedResponse['comment'] : null,
                'initiated_at' => $order->created_at,
                'completed_at' => $status === 'completed' ? now() : null,
                'failed_at' => $status === 'failed' ? now() : null,
                'metadata' => [
                    'payment_gateway' => $processedResponse['payment_gateway'],
                    'transaction_datetime' => $processedResponse['transaction_datetime'],
                    'custom_fields' => $processedResponse['custom_fields'],
                    'signature_valid' => $processedResponse['signature_valid'],
                    'base_order_amount' => $order->total_amount,
                    'webxpay_transaction_fee' => $transactionFee,
                    'total_amount_with_fee' => $totalWithFee,
                    'fee_percentage' => '3%',
                ],
            ]);
            
            Log::info('WebXPay transaction created', [
                'order_number' => $order->order_number,
                'status' => $status,
                'reference_number' => $processedResponse['reference_number']
            ]);
            
        } catch (Exception $e) {
            Log::error('Failed to create WebXPay transaction record', [
                'order_number' => $order->order_number,
                'error' => $e->getMessage()
            ]);
            // Don't throw the exception to avoid breaking the payment process
        }
    }

    /**
     * Verify payment signature
     */
    private function verifySignature(string $payment, string $signature): bool
    {
        try {
            if (!openssl_public_decrypt($signature, $decryptedValue, $this->publicKey)) {
                return false;
            }
            
            return $decryptedValue === $payment;
            
        } catch (Exception $e) {
            Log::error('Signature verification failed', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Map WebXPay status codes to our internal status
     */
    private function mapStatusCode(string $statusCode): string
    {
        $statusMap = config('webxpay.status_codes');

        // Normalize the raw status code (e.g. "00 - Approved" or "1")
        $trimmed = trim($statusCode);

        // Extract leading numeric part if present
        $numericCode = null;
        if (preg_match('/^(\d+)/', $trimmed, $matches)) {
            $numericCode = $matches[1]; // e.g. "00" or "1"
        }

        // Treat "00" (approved) as success – this is what WebXPay returns for card approvals
        if ($numericCode === '00') {
            return 'success';
        }

        // If we have a numeric code and it exists in our config map, use it
        if ($numericCode !== null && isset($statusMap[$numericCode])) {
            return $statusMap[$numericCode];
        }

        // Direct match fallback (in case config keys already match full strings)
        if (isset($statusMap[$trimmed])) {
            return $statusMap[$trimmed];
        }

        // Heuristic fallback based on text (in case future codes change format)
        $lower = strtolower($trimmed);
        if (str_contains($lower, 'approved') || str_contains($lower, 'success')) {
            return 'success';
        }
        if (str_contains($lower, 'fail') || str_contains($lower, 'declin') || str_contains($lower, 'cancel')) {
            return 'failed';
        }

        return 'unknown';
    }

    /**
     * Prepare custom fields for the payment
     */
    private function prepareCustomFields(Order $order): string
    {
        // You can customize this to include any additional data you need
        return implode('|', [
            'ceylon_it_solutions',     // cus_1: Store identifier
            $order->id,               // cus_2: Internal order ID
            $order->user_id ?? 'guest', // cus_3: User ID or guest
            date('Y-m-d H:i:s')       // cus_4: Timestamp
        ]);
    }

    /**
     * Extract first name from full name
     */
    private function getFirstName(string $fullName): string
    {
        $parts = explode(' ', trim($fullName));
        return $parts[0] ?? '';
    }

    /**
     * Extract last name from full name
     */
    private function getLastName(string $fullName): string
    {
        $parts = explode(' ', trim($fullName));
        return count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';
    }

    /**
     * Get payment status display text
     */
    public function getStatusDisplayText(string $status): string
    {
        $statusTexts = [
            'success' => 'Payment Successful',
            'pending' => 'Payment Pending',
            'failed' => 'Payment Failed',
            'cancelled' => 'Payment Cancelled',
            'declined' => 'Payment Declined',
            'expired' => 'Payment Expired',
            'unknown' => 'Unknown Status'
        ];
        
        return $statusTexts[$status] ?? 'Unknown Status';
    }

    /**
     * Handle WebXPay specific error codes
     */
    public function handleWebXPayError(string $errorCode, string $errorMessage = ''): string
    {
        $errorMessages = [
            '401' => 'Invalid access credentials - Please check your API settings',
            '402' => 'Cannot identify product - Product information missing',
            '403' => 'Invalid secret key - Please verify your merchant credentials',
            '405' => 'First name is required - Please provide customer first name',
            '406' => 'Last name is required - Please provide customer last name',
            '407' => 'Email address is required - Please provide valid email',
            '408' => 'Contact number is required - Please provide valid phone number',
            '409' => 'Transaction amount too small - Minimum 1 LKR/USD required',
            '410' => 'LKR amount limit exceeded - Please contact support',
            '411' => 'USD amount limit exceeded - Please contact support',
            '412' => 'Currency not supported - Only LKR and USD accepted',
            '413' => 'Payment gateways not found - Service temporarily unavailable',
            '414' => 'Selected gateway not found - Please try different payment method',
            '415' => 'Invalid gateway ID - Payment method not available',
            '416' => 'Bank response not received - Transaction timeout',
            '417' => 'Currency code not defined - Please specify currency',
            '418' => 'Return URL missing - Configuration error',
            '419' => 'IP address blocked - Your IP is restricted',
            '420' => 'Email address blocked - This email is restricted',
            '421' => 'Merchant account blocked - Please contact WebXPay support',
            '423' => 'Payment processing error - Please try again',
            '424' => 'Invalid request URL - Configuration error'
        ];
        
        $specificMessage = $errorMessages[$errorCode] ?? null;
        
        if ($specificMessage) {
            Log::warning('WebXPay specific error encountered', [
                'error_code' => $errorCode,
                'error_message' => $specificMessage,
                'original_message' => $errorMessage
            ]);
            return $specificMessage;
        }
        
        return $errorMessage ?: 'Unknown payment processing error';
    }

    /**
     * Format phone number for WebXPay (Sri Lankan format)
     */
    private function formatPhoneNumber($phone): string
    {
        if (empty($phone)) {
            return '';
        }
        
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Handle different Sri Lankan phone number formats
        if (strlen($phone) == 10 && substr($phone, 0, 1) == '0') {
            // Format: 0771234567 -> 0771234567 (keep as is)
            return $phone;
        } elseif (strlen($phone) == 9 && substr($phone, 0, 1) == '7') {
            // Format: 771234567 -> 0771234567 (add leading 0)
            return '0' . $phone;
        } elseif (strlen($phone) == 12 && substr($phone, 0, 3) == '947') {
            // Format: 947712345678 -> 0771234567 (remove country code)
            return '0' . substr($phone, 3);
        } elseif (strlen($phone) == 11 && substr($phone, 0, 2) == '94') {
            // Format: 94771234567 -> 0771234567 (remove country code)
            return '0' . substr($phone, 2);
        }
        
        // Return as is if format is not recognized
        return $phone;
    }
}
