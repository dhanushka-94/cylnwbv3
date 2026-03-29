 # Payment Receipt & Email Receipt Information

## 📧 Payment Receipt Email Template

**Location:** `resources/views/emails/payment-received.blade.php`

This is the email template that is sent to customers after payment is successfully received.

### Email Content Structure:

1. **Header Section**
   - Title: "Payment Received ✅"
   - Greeting with customer name

2. **Payment Confirmation**
   - Order Number
   - Payment Date
   - Amount Paid
   - Payment Method
   - Payment Reference (if available)

3. **Order Summary Table**
   - Product Name
   - Quantity
   - Unit Price
   - Total Price

4. **Payment Breakdown**
   - Subtotal
   - Shipping Cost (if applicable)
   - Tax Amount (if applicable)
   - Discount (if applicable)
   - **Total Paid**

5. **Payment Status Panel**
   - Confirmation message
   - Status indicator

6. **What Happens Next**
   - Order Processing steps
   - Expected Timeline

7. **Delivery Information**
   - Shipping Address
   - Contact Number

8. **Receipt & Warranty**
   - Digital Receipt information
   - Warranty details

9. **Payment Security**
   - Security assurances

10. **Contact Information**
    - Phone, WhatsApp, Email

11. **Account Access Button**
    - Link to user dashboard

12. **Footer**
    - Payment confirmation details
    - Order number
    - Payment reference

---

## 🎨 Email Layout Structure

**Location:** `resources/views/vendor/mail/html/`

### Main Layout File: `layout.blade.php`

The email uses Laravel's default mail layout which includes:

1. **HTML Structure**
   - DOCTYPE and HTML tags
   - Meta tags for responsive design
   - Viewport settings

2. **Layout Components:**
   - **Header** (`header.blade.php`) - App name/logo
   - **Body** - Main email content
   - **Footer** (`footer.blade.php`) - Copyright and footer text

3. **Responsive Design**
   - Mobile-friendly CSS
   - Media queries for different screen sizes

### Message Component: `message.blade.php`

This is the wrapper component that includes:
- Header slot
- Body content (main message)
- Subcopy slot (for additional info)
- Footer slot

---

## 📋 Full Payment Receipt Email Template

```blade
@component('mail::message')
# Payment Received ✅

Hello {{ $order->customer_name }},

Excellent! We've successfully received your payment for order **{{ $order->order_number }}**.

## Payment Confirmation

**Order Number:** {{ $order->order_number }}  
**Payment Date:** {{ now()->format('F d, Y \a\t g:i A') }}  
**Amount Paid:** **LKR {{ number_format($order->total_amount, 2) }}**  
**Payment Method:** {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}  
@if($order->payment_reference)
**Payment Reference:** {{ $order->payment_reference }}
@endif

## Order Summary

@component('mail::table')
| Product | Quantity | Unit Price | Total |
|:--------|:--------:|:----------:|------:|
@foreach($order->orderItems as $item)
| {{ $item->product_name }} | {{ $item->quantity }} | LKR {{ number_format($item->unit_price, 2) }} | LKR {{ number_format($item->total_price, 2) }} |
@endforeach
@endcomponent

## Payment Breakdown

| | |
|:-----------|----------:|
| **Subtotal** | LKR {{ number_format($order->subtotal, 2) }} |
@if($order->shipping_cost > 0)
| **Shipping** | LKR {{ number_format($order->shipping_cost, 2) }} |
@endif
@if($order->tax_amount > 0)
| **Tax** | LKR {{ number_format($order->tax_amount, 2) }} |
@endif
@if($order->discount_amount > 0)
| **Discount** | -LKR {{ number_format($order->discount_amount, 2) }} |
@endif
| **Total Paid** | **LKR {{ number_format($order->total_amount, 2) }}** |

@component('mail::panel')
**Payment Status: CONFIRMED** ✅

Your payment has been verified and your order is now confirmed for processing.
@endcomponent

## What Happens Next?

Now that your payment is confirmed:

1. **Order Processing** - We'll start preparing your items immediately
2. **Quality Check** - Each item will be inspected for quality
3. **Packaging** - Items will be securely packed
4. **Shipping** - You'll receive tracking information within 24-48 hours

### Expected Timeline
- **Processing:** 1-2 business days
- **Shipping:** 2-3 business days
- **Total Delivery:** 3-5 business days

@component('mail::button', ['url' => route('orders.show', $order->order_number)])
Track Your Order
@endcomponent

## Delivery Information

**Shipping Address:**  
{{ $order->customer_name }}  
{{ $order->shipping_address_line_1 }}  
@if($order->shipping_address_line_2)
{{ $order->shipping_address_line_2 }}  
@endif
{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}  
{{ $order->shipping_country }}

**Contact Number:** {{ $order->customer_phone }}

## Receipt & Warranty

### Digital Receipt
This email serves as your official payment receipt. Please keep it for:
- **Warranty Claims**
- **Returns/Exchanges**
- **Tax Records**
- **Future Reference**

### Warranty Information
- **Manufacturer Warranty:** As per product specifications
- **CITS service support:** Available at our service center
- **Extended Warranty:** Available for purchase

## Payment Security

✅ **Secure Transaction:** Your payment was processed through secure channels  
🔒 **Data Protection:** Your payment information is encrypted and protected  
🛡️ **Fraud Prevention:** Transaction verified through multiple security layers

## Need Help?

Questions about your payment or order?

- **WhatsApp:** +94 777 506 939
- **Email:** orders@ceylonitsolutions.com

### Account Access
View your order status anytime:

@component('mail::button', ['url' => route('user.dashboard')])
My Account Dashboard
@endcomponent

## Thank You!

Thank you for your payment and for choosing Ceylon IT Solutions. We appreciate your business and look forward to delivering your order soon!

Best regards,  
Ceylon IT Solutions payments team

@component('mail::subcopy')
Payment confirmed: {{ now()->format('F d, Y \a\t g:i A') }}  
Order Number: {{ $order->order_number }}  
@if($order->payment_reference)Reference: {{ $order->payment_reference }}@endif
@endcomponent
@endcomponent
```

---

## 📧 Email Layout Files

### 1. Main Layout (`layout.blade.php`)
- HTML structure
- Responsive design
- Header, body, and footer slots

### 2. Header (`header.blade.php`)
- App name/logo
- Clickable link to website

### 3. Footer (`footer.blade.php`)
- Copyright information
- Footer text

### 4. Message Component (`message.blade.php`)
- Wraps all email content
- Includes header, body, subcopy, and footer

### 5. Supporting Components
- **Button** (`button.blade.php`) - Styled action buttons
- **Panel** (`panel.blade.php`) - Highlighted information boxes
- **Table** (`table.blade.php`) - Formatted tables
- **Subcopy** (`subcopy.blade.php`) - Small text footer

---

## 🔧 Where Email is Sent From

**Current Status:** The payment receipt email template exists but needs to be integrated.

**Location to Add Email Sending:**
- `app/Http/Controllers/PaymentController.php` - In the `handleWebXPayReturn` method
- `app/Http/Controllers/CheckoutController.php` - After order creation

**Note:** There's a TODO comment in `PaymentController.php` line 598:
```php
// TODO: Send email notification to customer about payment status
```

---

## 📝 To Send Payment Receipt Email

You need to create a Mailable class and send it when payment is confirmed:

1. **Create Mailable Class:**
```php
php artisan make:mail PaymentReceived
```

2. **In PaymentController, after payment confirmation:**
```php
use App\Mail\PaymentReceived;
use Illuminate\Support\Facades\Mail;

// After payment is confirmed
Mail::to($order->customer_email)->send(new PaymentReceived($order));
```

---

## 📄 Files Summary

| File | Location | Purpose |
|------|----------|---------|
| Payment Receipt Email | `resources/views/emails/payment-received.blade.php` | Email content template |
| Email Layout | `resources/views/vendor/mail/html/layout.blade.php` | Main email HTML structure |
| Email Header | `resources/views/vendor/mail/html/header.blade.php` | Email header component |
| Email Footer | `resources/views/vendor/mail/html/footer.blade.php` | Email footer component |
| Message Component | `resources/views/vendor/mail/html/message.blade.php` | Message wrapper |

---

## 🎯 Key Features of Payment Receipt Email

✅ **Comprehensive Payment Details**
- Order number, date, amount, method, reference

✅ **Order Summary**
- Product list with quantities and prices

✅ **Payment Breakdown**
- Subtotal, shipping, tax, discount, total

✅ **Delivery Information**
- Complete shipping address

✅ **Receipt & Warranty Info**
- Digital receipt confirmation
- Warranty details

✅ **Security Information**
- Payment security assurances

✅ **Action Buttons**
- Track order link
- Account dashboard link

✅ **Contact Information**
- Phone, WhatsApp, Email

✅ **Professional Design**
- Responsive layout
- Clean formatting
- Brand consistency

---

**Last Updated:** {{ date('Y-m-d') }}

