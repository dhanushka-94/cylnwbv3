@extends('layouts.app')

@section('title', 'My Orders - Ceylon IT Solutions')
@section('description', 'View and track your Ceylon IT Solutions orders, download invoices, and manage your purchase history.')

@section('content')
<div class="min-h-screen bg-[#0f0f0f] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">My Orders</h1>
                <p class="text-gray-400">Track and manage your order history</p>
            </div>
            <a href="{{ route('user.dashboard') }}" 
               class="inline-flex items-center text-[#f59e0b] hover:text-[#d97706] transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-gradient-to-r from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6 mb-8">
            <form method="GET" action="{{ route('user.orders') }}" class="flex flex-wrap items-center gap-4">
                <!-- Search -->
                <div class="flex-1 min-w-64">
                    <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search Orders</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by order number..."
                           class="w-full px-4 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent">
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                    <select id="status" 
                            name="status"
                            class="px-4 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end">
                    <button type="submit" 
                            class="px-6 py-2 bg-[#f59e0b] text-black rounded-lg hover:bg-[#d97706] transition-colors font-medium">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('user.orders') }}" 
                           class="ml-2 px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Orders List -->
        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
                        <!-- Order Header -->
                        <div class="px-6 py-4 border-b border-gray-800">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <h3 class="text-lg font-medium text-white">{{ $order->order_number }}</h3>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->payment_status_badge }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-medium text-white">{{ $order->formatted_total }}</p>
                                    <p class="text-sm text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="px-6 py-4">
                            <div class="flex items-center space-x-4 mb-4">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span class="text-sm text-gray-400">
                                    {{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }}
                                </span>
                                @if($order->shipping_address)
                                    <span class="text-gray-500">•</span>
                                    <span class="text-sm text-gray-400">{{ $order->shipping_city }}</span>
                                @endif
                            </div>

                            <!-- Item List -->
                            <div class="space-y-2">
                                @foreach($order->orderItems->take(3) as $item)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <div class="w-8 h-8 bg-gray-800 rounded flex items-center justify-center">
                                            <span class="text-xs text-gray-400">{{ $item->quantity }}x</span>
                                        </div>
                                        <span class="flex-1 text-gray-300">{{ $item->product_name }}</span>
                                        <span class="text-white font-medium">{{ $item->formatted_total_price }}</span>
                                    </div>
                                @endforeach
                                @if($order->orderItems->count() > 3)
                                    <div class="text-sm text-gray-400">
                                        + {{ $order->orderItems->count() - 3 }} more items
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Actions -->
                        <div class="px-6 py-4 border-t border-gray-800 bg-gray-800/20">
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-3">
                                    <a href="{{ route('user.orders.detail', $order->order_number) }}" 
                                       class="text-[#f59e0b] hover:text-[#d97706] text-sm font-medium transition-colors">
                                        View Details
                                    </a>
                                    @if($order->status === 'delivered')
                                        <form action="{{ route('user.orders.reorder', $order) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="text-[#f59e0b] hover:text-[#d97706] text-sm font-medium transition-colors">
                                                Reorder
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('orders.invoice', $order->order_number) }}" 
                                       class="text-gray-400 hover:text-white text-sm font-medium transition-colors">
                                        Download Invoice
                                    </a>
                                </div>
                                
                                @if($order->canBeCancelled())
                                    <button type="button" 
                                            onclick="showCancelContactInfo('{{ $order->order_number }}')"
                                            class="text-red-400 hover:text-red-300 text-sm font-medium transition-colors">
                                        Request Cancellation
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->appends(request()->query())->links('custom.pagination') }}
            </div>

        @else
            <!-- Empty State -->
            <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-lg font-medium text-white mb-2">No orders found</h3>
                @if(request()->hasAny(['search', 'status']))
                    <p class="text-gray-400 mb-6">Try adjusting your search criteria or filters</p>
                    <a href="{{ route('user.orders') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors">
                        Clear Filters
                    </a>
                @else
                    <p class="text-gray-400 mb-6">You haven't placed any orders yet</p>
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-black bg-[#f59e0b] hover:bg-[#d97706] transition-colors">
                        Start Shopping
                    </a>
                @endif
            </div>
        @endif
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
                <p class="text-gray-300 mb-4">To cancel your order <strong class="text-white" id="modalOrderNumber"></strong>, please contact our customer service team:</p>
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
                        <a href="#" id="whatsappLink" target="_blank" class="text-green-400 hover:text-green-300 text-sm">0777 50 69 39</a>
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
                        <a href="#" id="emailLink" class="text-blue-400 hover:text-blue-300 text-sm">info@ceylonitsolutions.com</a>
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
                        <strong>Important:</strong> Please include your order number <strong id="warningOrderNumber"></strong> when contacting us for faster processing.
                    </div>
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <button onclick="hideCancelContactInfo()" 
                        class="flex-1 px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors">
                    Close
                </button>
                <a href="#" id="whatsappNowButton" target="_blank" class="flex-1 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-center">
                    WhatsApp Now
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let currentOrderNumber = '';

function showCancelContactInfo(orderNumber) {
    currentOrderNumber = orderNumber;
    
    // Update order number in modal
    document.getElementById('modalOrderNumber').textContent = orderNumber;
    document.getElementById('warningOrderNumber').textContent = orderNumber;
    
    // Update WhatsApp links
    const whatsappMessage = `Hi, I would like to cancel my order ${orderNumber}`;
    const whatsappUrl = `https://wa.me/94777506939?text=${encodeURIComponent(whatsappMessage)}`;
    document.getElementById('whatsappLink').href = whatsappUrl;
    document.getElementById('whatsappNowButton').href = whatsappUrl;
    
    // Update email link
    const emailSubject = `Order Cancellation Request - ${orderNumber}`;
    const emailBody = `Hi, I would like to cancel my order ${orderNumber}. Please process this request and confirm.`;
    const emailUrl = `mailto:info@ceylonitsolutions.com?subject=${encodeURIComponent(emailSubject)}&body=${encodeURIComponent(emailBody)}`;
    document.getElementById('emailLink').href = emailUrl;
    
    // Show modal
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
