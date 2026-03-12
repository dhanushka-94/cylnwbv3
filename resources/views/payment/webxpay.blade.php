@extends('layouts.app')

@section('title', 'Complete Card Payment - MSK Computers')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0a0a0a] via-[#1a1a1a] to-[#0f0f0f] py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center space-x-4 mb-6">
                <img src="{{ asset('cts-sys-logo-clr.png') }}" alt="Ceylon IT Solutions" class="w-16 h-16">
                <div class="text-4xl text-gray-400">→</div>
                <div class="bg-white p-3 rounded-lg shadow-lg">
                    <img src="{{ asset('images/webxpay-logo.webp') }}" alt="WebXPay" class="h-10">
                </div>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Complete Card Payment</h1>
            <p class="text-gray-400">Secure payment processing via WebXPay</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6">
                <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Order Summary
                        </h2>

                <!-- Order Info -->
                <div class="bg-[#0f0f0f] rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center text-sm mb-2">
                        <span class="text-gray-400">Order #</span>
                        <span class="font-mono text-green-400 font-medium">{{ $order->order_number }}</span>
                    </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Customer</span>
                                <span class="text-gray-200">{{ $order->customer_name }}</span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="space-y-3 mb-6">
                            @foreach($order->orderItems as $item)
                    <div class="flex justify-between items-center p-3 bg-[#0f0f0f] rounded-lg">
                        <div>
                            <p class="text-white font-medium text-sm">{{ $item->product_name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $item->quantity }} × LKR {{ number_format($item->unit_price, 2) }}</p>
                                </div>
                        <div class="text-green-400 font-semibold text-sm">
                                    LKR {{ number_format($item->total_price, 2) }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                <!-- Pricing Breakdown -->
                <div class="border-t border-gray-700 pt-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Subtotal:</span>
                        <span class="text-white">LKR {{ number_format($originalSubtotal > 0 ? $originalSubtotal : $subtotal, 2) }}</span>
                    </div>

                        @if($totalDiscount > 0)
                        <div class="flex justify-between text-sm">
                        <span class="text-green-400">Discount:</span>
                            <span class="text-green-400">-LKR {{ number_format($totalDiscount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Subtotal (after discount):</span>
                        <span class="text-white">LKR {{ number_format($subtotal, 2) }}</span>
                        </div>
                        @endif
                        
                        <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Shipping:</span>
                        <span class="text-amber-400 text-xs">Pay on delivery</span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-yellow-400">Transaction Fee (3%):</span>
                        <span class="text-yellow-400">+LKR {{ number_format($transactionFee, 2) }}</span>
                    </div>
                    
                    <div class="border-t border-gray-600 pt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-white">Order Total:</span>
                            <span class="text-xl font-bold text-green-400">LKR {{ number_format($totalWithFee, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6">
                <h3 class="text-xl font-semibold text-white mb-6">Payment Information</h3>

                <form action="{{ $paymentData['checkout_url'] }}" method="POST" id="webxpay-form" class="space-y-4">
                        @csrf
                        
                        <!-- Hidden Fields for WebXPay -->
                        <input type="hidden" name="secret_key" value="{{ $paymentData['secret_key'] }}">
                        <input type="hidden" name="payment" value="{{ $paymentData['payment'] }}">
                        <input type="hidden" name="custom_fields" value="{{ $paymentData['custom_fields'] }}">
                        <input type="hidden" name="enc_method" value="{{ $paymentData['enc_method'] }}">
                        <input type="hidden" name="process_currency" value="{{ $paymentData['process_currency'] }}">
                        <input type="hidden" name="cms" value="{{ $paymentData['cms'] }}">
                        <input type="hidden" name="return_url" value="{{ $paymentData['return_url'] }}">
                        <input type="hidden" name="cancel_url" value="{{ $paymentData['cancel_url'] }}">
                        <input type="hidden" name="notify_url" value="{{ $paymentData['notify_url'] }}">
                        
                    <!-- Customer Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">First Name *</label>
                            <input type="text" name="first_name" value="{{ $paymentData['first_name'] }}" 
                                   class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   required>
                                </div>
                                <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Last Name *</label>
                            <input type="text" name="last_name" value="{{ $paymentData['last_name'] }}" 
                                   class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   required>
                                </div>
                            </div>

                            <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ $paymentData['email'] }}" 
                               class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Phone Number *</label>
                                <input type="tel" name="contact_number" value="{{ $paymentData['contact_number'] }}" 
                               class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                               required>
                            </div>

                            <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Address *</label>
                        <input type="text" name="address_line_one" value="{{ $paymentData['address_line_one'] }}" 
                               class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                               required>
                            </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">City *</label>
                                    <input type="text" name="city" value="{{ $paymentData['city'] }}" 
                                   class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                   required>
                                </div>
                                <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Country</label>
                            <input type="text" name="country" value="{{ $paymentData['country'] }}" 
                                   class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                            </div>

                    <!-- Hidden optional fields -->
                    <input type="hidden" name="address_line_two" value="{{ $paymentData['address_line_two'] }}">
                    <input type="hidden" name="state" value="{{ $paymentData['state'] }}">
                    <input type="hidden" name="postal_code" value="{{ $paymentData['postal_code'] }}">

                    <!-- Security Notice -->
                    <div class="bg-green-900/20 border border-green-700/50 rounded-lg p-4 mt-6">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <div>
                                <p class="text-green-400 text-sm font-medium">Secure Payment</p>
                                <p class="text-green-300 text-xs">Your payment is protected by SSL encryption</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                    <div class="flex flex-col space-y-3 pt-6">
                            <button type="submit" 
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            <div>
                                <div class="text-lg">Complete Card Payment</div>
                                <div class="text-sm opacity-90">LKR {{ number_format($totalWithFee, 2) }}</div>
                                </div>
                            </button>
                            
                            <a href="{{ route('checkout.index') }}" 
                           class="w-full bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Back to Checkout
                            </a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('webxpay-form');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        if (submitBtn.disabled) {
            e.preventDefault();
            return false;
        }
        
        const originalContent = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Connecting to WebXPay...
        `;
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75');
        
        setTimeout(() => {
            if (!document.hidden) {
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75');
            }
        }, 10000);
    });
});
</script>
@endsection