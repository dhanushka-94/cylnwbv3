@extends('layouts.app')

@section('title', 'Complete Your Secure Payment - Ceylon IT Solutions')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#1a1a1c] to-[#0f0f0f] py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Simple Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-3 rounded-xl shadow-lg">
                    <img src="{{ asset('images/kokopay-logo.png') }}" alt="Koko Pay" class="h-8 brightness-0 invert">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Complete Your Secure Payment</h1>
                    <p class="text-purple-400 text-sm">Buy Now, Pay Later with Koko Pay</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Order Summary -->
            <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6">
                <h2 class="text-xl font-semibold text-white mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Order Summary
                </h2>

                <!-- Order Info -->
                <div class="bg-[#0f0f0f] rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-400">Order Number:</span>
                        <span class="font-mono text-purple-400 font-medium">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Customer:</span>
                        <span class="text-white">{{ $order->customer_name }}</span>
                    </div>
                </div>

                <!-- Items -->
                <div class="space-y-3 mb-6">
                    @foreach($order->orderItems as $item)
                    <div class="flex justify-between items-center py-2 border-b border-gray-700 last:border-b-0">
                        <div class="flex-1">
                            <p class="text-white font-medium text-sm">{{ $item->product_name }}</p>
                            <p class="text-gray-400 text-xs">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-purple-400 font-semibold">
                            LKR {{ number_format($item->total_price, 2) }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="border-t border-gray-700 pt-4">
                    <div class="flex justify-between text-lg font-bold">
                        <span class="text-white">Total Amount:</span>
                        <span class="text-purple-400">LKR {{ number_format($totalWithFee, 2) }}</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Includes 10% processing fee</p>
                </div>

                <!-- Payment Plan -->
                <div class="mt-6 bg-gradient-to-r from-purple-900/20 to-blue-900/20 rounded-lg p-4 border border-purple-700/30">
                    <h4 class="text-purple-400 font-medium mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"/>
                        </svg>
                        Your Payment Plan
                    </h4>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-white">Today:</span>
                            <span class="text-purple-300 font-semibold">LKR {{ number_format($totalWithFee / 3, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-300">In 30 days:</span>
                            <span class="text-gray-300">LKR {{ number_format($totalWithFee / 3, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-300">In 60 days:</span>
                            <span class="text-gray-300">LKR {{ number_format($totalWithFee / 3, 2) }}</span>
                        </div>
                    </div>
                    <p class="text-purple-300 text-xs mt-3">✓ No hidden fees • ✓ Automatic payments</p>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6">
                <h3 class="text-lg font-semibold text-white mb-6">Customer Information</h3>

                <form action="{{ $apiUrl }}" method="POST" id="kokopay-form" class="space-y-6">
                    @csrf
                    
                    <!-- Hidden Fields for Koko Pay -->
                    @foreach($paymentData as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    
                    <!-- Customer Details (Read-only display) -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">First Name</label>
                                <div class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg">
                                    {{ $paymentData['_firstName'] }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
                                <div class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg">
                                    {{ $paymentData['_lastName'] ?: 'Not provided' }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                            <div class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg">
                                {{ $paymentData['_email'] }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Mobile Number</label>
                            <div class="w-full bg-[#0f0f0f] border border-gray-700 text-white px-4 py-3 rounded-lg">
                                {{ $paymentData['_mobileNo'] ?: 'Not provided' }}
                            </div>
                        </div>
                    </div>

                    <!-- Important Notice -->
                    <div class="bg-blue-900/20 border border-blue-700/50 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="text-blue-400 font-medium text-sm">Important Information</h4>
                                <ul class="text-blue-300 text-sm mt-2 space-y-1">
                                    <li>• You will be redirected to Koko Pay's secure payment gateway</li>
                                    <li>• Your information is encrypted and protected</li>
                                    <li>• Delivery charges are payable upon receipt</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4 pt-6">
                        <!-- Complete KOKO Payment Button -->
                        <button type="submit" 
                                class="w-full relative overflow-hidden bg-gradient-to-r from-purple-600 via-purple-700 to-blue-600 text-white font-bold py-5 px-8 rounded-2xl hover:from-purple-700 hover:via-purple-800 hover:to-blue-700 transition-all duration-500 flex items-center justify-center shadow-2xl shadow-purple-500/25 ring-2 ring-purple-500/20 hover:ring-purple-400/40 hover:shadow-purple-500/40 transform hover:scale-105 hover:-translate-y-1 group">
                            <!-- Animated background gradient -->
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-400 via-pink-500 to-blue-500 opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                            
                            <!-- Button content -->
                            <div class="relative flex items-center justify-center">
                                <div class="flex items-center space-x-4">
                                    <!-- Koko Pay Icon -->
                                    <div class="bg-white/20 p-2.5 rounded-xl group-hover:bg-white/30 transition-all duration-300 group-hover:scale-110">
                                        <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                    </div>
                                    
                                    <!-- Button text -->
                                    <div class="text-center">
                                        <div class="text-xl font-extrabold tracking-wide">Complete KOKO Payment</div>
                                        <div class="text-sm font-semibold text-purple-100 group-hover:text-white transition-colors duration-300">
                                            LKR {{ number_format($totalWithFee, 2) }}
                                        </div>
                                    </div>
                                    
                                    <!-- Arrow icon -->
                                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Shine effect -->
                            <div class="absolute inset-0 -top-2 -bottom-2 bg-gradient-to-r from-transparent via-white/10 to-transparent skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </button>
                        
                        <!-- Back to Checkout Button -->
                        <a href="{{ route('checkout.index') }}" 
                           class="w-full relative overflow-hidden bg-gradient-to-r from-gray-800 via-gray-700 to-gray-800 text-white font-semibold py-4 px-6 rounded-xl hover:from-gray-700 hover:via-gray-600 hover:to-gray-700 transition-all duration-300 flex items-center justify-center shadow-xl shadow-gray-900/25 ring-1 ring-gray-600/50 hover:ring-gray-500/60 transform hover:scale-102 hover:-translate-y-0.5 group border border-gray-600/50">
                            <!-- Button content -->
                            <div class="flex items-center space-x-3">
                                <!-- Back arrow -->
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                                </svg>
                                
                                <!-- Button text -->
                                <span class="text-base font-semibold tracking-wide">Back to Checkout</span>
                            </div>
                            
                            <!-- Subtle shine effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center space-x-2 text-green-400 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>SSL Encrypted • Your data is secure</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('kokopay-form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function() {
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
    });
});
</script>
@endsection