@extends('layouts.app')

@section('title', 'Order Details - ' . $order->order_number . ' - MSK COMPUTERS')
@section('description', 'View detailed information about your MSK Computers order including items, shipping, and payment details.')

@section('content')
<div class="min-h-screen bg-[#0f0f0f] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Order Details</h1>
                <p class="text-gray-400">Order #{{ $order->order_number }}</p>
            </div>
            <a href="{{ route('user.orders') }}" 
               class="inline-flex items-center text-[#f59e0b] hover:text-[#d97706] transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Orders
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Order Status & Summary -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h2 class="text-xl font-semibold text-white">Order Summary</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                                <div class="text-2xl font-bold text-white mb-1">{{ $order->formatted_total }}</div>
                                <div class="text-sm text-gray-400">Total Amount</div>
                            </div>
                            <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                                <div class="text-lg font-semibold text-white mb-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-400">Order Status</div>
                            </div>
                            <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                                <div class="text-lg font-semibold text-white mb-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->payment_status_badge }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-400">Payment Status</div>
                            </div>
                            <div class="text-center p-4 bg-gray-800/30 rounded-lg">
                                <div class="text-lg font-semibold text-white mb-1">{{ $order->orderItems->count() }}</div>
                                <div class="text-sm text-gray-400">{{ Str::plural('Item', $order->orderItems->count()) }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                            <div>
                                <h3 class="font-medium text-white mb-2">Order Information</h3>
                                <div class="space-y-1 text-gray-400">
                                    <div><span class="text-gray-500">Order Date:</span> {{ $order->created_at->format('M d, Y \a\t g:i A') }}</div>
                                    <div><span class="text-gray-500">Payment Method:</span> {{ ucfirst($order->payment_method) }}</div>
                                    @if($order->payment_reference)
                                        <div><span class="text-gray-500">Payment Reference:</span> {{ $order->payment_reference }}</div>
                                    @endif
                                    @if($order->tracking_number)
                                        <div><span class="text-gray-500">Tracking Number:</span> {{ $order->tracking_number }}</div>
                                    @endif
                                    @if($order->courier_service)
                                        <div><span class="text-gray-500">Courier:</span> {{ $order->courier_service }}</div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <h3 class="font-medium text-white mb-2">Timeline</h3>
                                <div class="space-y-1 text-gray-400">
                                    <div><span class="text-gray-500">Ordered:</span> {{ $order->created_at->format('M d, Y g:i A') }}</div>
                                    @if($order->shipped_at)
                                        <div><span class="text-gray-500">Shipped:</span> {{ $order->shipped_at->format('M d, Y g:i A') }}</div>
                                    @endif
                                    @if($order->delivered_at)
                                        <div><span class="text-gray-500">Delivered:</span> {{ $order->delivered_at->format('M d, Y g:i A') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h2 class="text-xl font-semibold text-white">Order Items</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-center space-x-4 p-4 bg-gray-800/20 rounded-lg">
                                    <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-medium text-white">{{ $item->product_name }}</h3>
                                        @if($item->product_sku)
                                            <p class="text-sm text-gray-400">SKU: {{ $item->product_sku }}</p>
                                        @endif
                                        <div class="flex items-center space-x-4 mt-2 text-sm">
                                            <span class="text-gray-400">Qty: {{ $item->quantity }}</span>
                                            <span class="text-gray-400">Unit Price: {{ $item->formatted_unit_price }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-semibold text-white">{{ $item->formatted_total_price }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Totals -->
                        <div class="mt-6 pt-6 border-t border-gray-800">
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Subtotal:</span>
                                    <span class="text-white">{{ $order->formatted_subtotal }}</span>
                                </div>
                                @if($order->discount_amount > 0)
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Discount:</span>
                                        <span class="text-green-400">-{{ $order->formatted_discount }}</span>
                                    </div>
                                @endif
                                @if($order->tax_amount > 0)
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Tax:</span>
                                        <span class="text-white">{{ $order->formatted_tax }}</span>
                                    </div>
                                @endif
                                @if($order->shipping_cost > 0)
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Shipping:</span>
                                        <span class="text-white">{{ $order->formatted_shipping }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between pt-2 border-t border-gray-700">
                                    <span class="font-semibold text-white">Total:</span>
                                    <span class="font-semibold text-white text-lg">{{ $order->formatted_total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                @if($order->transactions->count() > 0)
                    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-800">
                            <h2 class="text-xl font-semibold text-white">Payment History</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($order->transactions as $transaction)
                                    <div class="flex items-center justify-between p-4 bg-gray-800/20 rounded-lg">
                                        <div>
                                            <div class="font-medium text-white">{{ ucfirst($transaction->payment_method) }}</div>
                                            <div class="text-sm text-gray-400">{{ $transaction->transaction_id }}</div>
                                            @if($transaction->completed_at)
                                                <div class="text-xs text-gray-500">{{ $transaction->completed_at->format('M d, Y g:i A') }}</div>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-white">{{ $transaction->currency }} {{ number_format($transaction->amount, 2) }}</div>
                                            <div class="text-sm">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                       ($transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                
                <!-- Customer Information -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h2 class="text-lg font-semibold text-white">Customer Information</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <h3 class="font-medium text-white mb-2">Contact Details</h3>
                            <div class="space-y-1 text-sm text-gray-400">
                                <div>{{ $order->customer_name }}</div>
                                <div>{{ $order->customer_email }}</div>
                                @if($order->customer_phone)
                                    <div>{{ $order->customer_phone }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                @if($order->shipping_address_line_1)
                    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-800">
                            <h2 class="text-lg font-semibold text-white">Shipping Address</h2>
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-400 space-y-1">
                                <div>{{ $order->shipping_address_line_1 }}</div>
                                @if($order->shipping_address_line_2)
                                    <div>{{ $order->shipping_address_line_2 }}</div>
                                @endif
                                <div>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}</div>
                                <div>{{ $order->shipping_country }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Billing Address -->
                @if($order->billing_address_line_1)
                    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-800">
                            <h2 class="text-lg font-semibold text-white">Billing Address</h2>
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-400 space-y-1">
                                <div>{{ $order->billing_address_line_1 }}</div>
                                @if($order->billing_address_line_2)
                                    <div>{{ $order->billing_address_line_2 }}</div>
                                @endif
                                <div>{{ $order->billing_city }}, {{ $order->billing_state }} {{ $order->billing_postal_code }}</div>
                                <div>{{ $order->billing_country }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Order Actions -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h2 class="text-lg font-semibold text-white">Actions</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('orders.invoice', $order->order_number) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-[#f59e0b] text-black rounded-lg hover:bg-[#d97706] transition-colors font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Invoice
                        </a>

                        @if($order->status === 'delivered')
                            <form action="{{ route('user.orders.reorder', $order) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Reorder Items
                                </button>
                            </form>
                        @endif

                        @if($order->canBeCancelled())
                            <button type="button" 
                                    onclick="showCancelContactInfo()"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-600 text-red-400 rounded-lg hover:bg-red-600 hover:text-white transition-colors font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Request Cancellation
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Order Notes -->
                @if($order->notes)
                    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-800">
                            <h2 class="text-lg font-semibold text-white">Order Notes</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-400">{{ $order->notes }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- Cancel Order Contact Modal -->
<div id="cancelContactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 max-w-md w-full">
        <div class="px-6 py-4 border-b border-gray-800">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">Request Order Cancellation</h3>
                <button onclick="hideCancelContactInfo()" class="text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <p class="text-gray-300 mb-4">To cancel your order <strong class="text-white">{{ $order->order_number }}</strong>, please contact our customer service team:</p>
            </div>
            
            <!-- Shop Information -->
            <div class="mb-6 p-4 bg-[#f59e0b]/10 border border-[#f59e0b]/20 rounded-lg">
                <div class="text-center">
                    <h4 class="font-bold text-white text-lg mb-2">MSK COMPUTERS</h4>
                    <div class="text-sm text-gray-300 space-y-1">
                        <div>No.296/3D, Delpe Junction, Ragama</div>
                        <div>Sri Lanka</div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Phone Contact -->
                <div class="flex items-center space-x-3 p-3 bg-gray-800/30 rounded-lg">
                    <div class="w-10 h-10 bg-[#f59e0b] rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Call Us</div>
                        <div class="space-y-1">
                            <div><a href="tel:+94112959005" class="text-[#f59e0b] hover:text-[#d97706] text-sm">0112 95 9005</a></div>
                            <div><a href="tel:+94777506939" class="text-[#f59e0b] hover:text-[#d97706] text-sm">0777 50 69 39</a></div>
                        </div>
                        <div class="text-xs text-gray-400">Call us anytime</div>
                    </div>
                </div>

                <!-- WhatsApp Contact -->
                <div class="flex items-center space-x-3 p-3 bg-gray-800/30 rounded-lg">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">WhatsApp</div>
                        <a href="https://wa.me/94777506939?text=Hi, I would like to cancel my order {{ $order->order_number }}" 
                           target="_blank"
                           class="text-green-400 hover:text-green-300 text-sm">0777 50 69 39</a>
                        <div class="text-xs text-gray-400">Quick response available</div>
                    </div>
                </div>

                <!-- Email Contact -->
                <div class="flex items-center space-x-3 p-3 bg-gray-800/30 rounded-lg">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Email Us</div>
                        <a href="mailto:info@ceylonitsolutions.com?subject=Order Cancellation Request - {{ $order->order_number }}&body=Hi, I would like to cancel my order {{ $order->order_number }}. Please process this request and confirm." 
                           class="text-blue-400 hover:text-blue-300 text-sm">info@ceylonitsolutions.com</a>
                        <div class="text-xs text-gray-400">Expert support</div>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-lg">
                <div class="flex items-start space-x-2">
                    <svg class="w-5 h-5 text-yellow-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="text-sm text-yellow-300">
                        <strong>Important:</strong> Please include your order number <strong>{{ $order->order_number }}</strong> when contacting us for faster processing.
                    </div>
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <button onclick="hideCancelContactInfo()" 
                        class="flex-1 px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors">
                    Close
                </button>
                <a href="https://wa.me/94777506939?text=Hi, I would like to cancel my order {{ $order->order_number }}" 
                   target="_blank"
                   class="flex-1 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-center">
                    WhatsApp Now
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function showCancelContactInfo() {
    document.getElementById('cancelContactModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideCancelContactInfo() {
    document.getElementById('cancelContactModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('cancelContactModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideCancelContactInfo();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideCancelContactInfo();
    }
});
</script>

@endsection
