@extends('admin.layout')

@section('title', 'Order Management')

@section('content')
<div class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Order Management</h1>
            <p class="text-gray-400">Manage and track all customer orders</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.orders.create') }}" 
               class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>Create Order
            </a>
            <a href="{{ route('admin.orders.statistics') }}" 
               class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-chart-bar mr-2"></i>Statistics
            </a>
        </div>
    </div>

    <!-- Quick Sort & Filter Buttons -->
    <div class="bg-gradient-to-r from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-4">
        <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium text-gray-300">🚀 Quick Filters:</span>
            
            <!-- New/Unread Orders -->
            <a href="{{ route('admin.orders.index', ['status' => 'pending', 'view_status' => 'unread']) }}" 
               class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ request('status') === 'pending' && request('view_status') === 'unread' ? 'bg-red-500/20 text-red-400 border border-red-500/30' : 'bg-gray-700/50 text-gray-300 hover:bg-red-500/10 hover:text-red-400' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                🔴 New Orders
                @php
                    $newOrdersCount = \App\Models\Order::where('status', 'pending')->where('admin_viewed_at', null)->count();
                @endphp
                @if($newOrdersCount > 0)
                    <span class="ml-2 px-2 py-1 bg-red-500 text-white text-xs rounded-full">{{ $newOrdersCount }}</span>
                @endif
            </a>
            
            <!-- Confirmed Orders -->
            <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" 
               class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ request('status') === 'confirmed' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/30' : 'bg-gray-700/50 text-gray-300 hover:bg-blue-500/10 hover:text-blue-400' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                ✅ Confirmed
                @php
                    $confirmedCount = \App\Models\Order::where('status', 'confirmed')->count();
                @endphp
                @if($confirmedCount > 0)
                    <span class="ml-2 px-2 py-1 bg-blue-500/70 text-white text-xs rounded-full">{{ $confirmedCount }}</span>
                @endif
            </a>
            
            <!-- Pending Orders -->
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
               class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ request('status') === 'pending' && !request('view_status') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30' : 'bg-gray-700/50 text-gray-300 hover:bg-sky-500/10 hover:text-sky-300' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                ⏰ Pending
                @php
                    $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="ml-2 px-2 py-1 bg-sky-500/70 text-white text-xs rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
            
            <!-- Processing Orders -->
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" 
               class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ request('status') === 'processing' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/30' : 'bg-gray-700/50 text-gray-300 hover:bg-purple-500/10 hover:text-purple-400' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                🔄 Processing
                @php
                    $processingCount = \App\Models\Order::where('status', 'processing')->count();
                @endphp
                @if($processingCount > 0)
                    <span class="ml-2 px-2 py-1 bg-purple-500/70 text-white text-xs rounded-full">{{ $processingCount }}</span>
                @endif
            </a>
            
            <!-- Payment Pending -->
            <a href="{{ route('admin.orders.index', ['payment_status' => 'pending']) }}" 
               class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ request('payment_status') === 'pending' ? 'bg-orange-500/20 text-orange-400 border border-orange-500/30' : 'bg-gray-700/50 text-gray-300 hover:bg-orange-500/10 hover:text-orange-400' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3-3v8a3 3 0 003 3z"/>
                </svg>
                💳 Payment Due
                @php
                    $paymentPendingCount = \App\Models\Order::where('payment_status', 'pending')->count();
                @endphp
                @if($paymentPendingCount > 0)
                    <span class="ml-2 px-2 py-1 bg-orange-500/70 text-white text-xs rounded-full">{{ $paymentPendingCount }}</span>
                @endif
            </a>
            
            <!-- Clear All Filters -->
            <div class="border-l border-gray-600 pl-3 ml-2">
                <a href="{{ route('admin.orders.index') }}" 
                   class="inline-flex items-center px-3 py-2 bg-gray-600/50 text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-500/50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Clear All
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gradient-to-r from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6">
        <form method="GET" action="{{ route('admin.orders.index') }}">
            <div class="space-y-4">
                <!-- First Row: Search, Status, Payment Status, Payment Method -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Order number, customer, email, mobile..."
                               class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select id="status" name="status" class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-300 mb-2">Payment Status</label>
                        <select id="payment_status" name="payment_status" class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                            <option value="">All Methods</option>
                            <option value="webxpay" {{ request('payment_method') === 'webxpay' ? 'selected' : '' }}>💳 WebXPay</option>
                            <option value="kokopay" {{ request('payment_method') === 'kokopay' ? 'selected' : '' }}>⏰ Koko Pay (BNPL)</option>
                            <option value="bank_transfer" {{ request('payment_method') === 'bank_transfer' ? 'selected' : '' }}>🏦 Bank Transfer</option>
                        </select>
                    </div>
                </div>

                <!-- Second Row: Date Range, View Status, and Quick Filters -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Date From -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-300 mb-2">Date From</label>
                        <input type="date" 
                               id="date_from" 
                               name="date_from" 
                               value="{{ request('date_from') }}"
                               max="{{ now()->format('Y-m-d') }}"
                               class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                    </div>

                    <!-- Date To -->
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-300 mb-2">Date To</label>
                        <input type="date" 
                               id="date_to" 
                               name="date_to" 
                               value="{{ request('date_to') }}"
                               max="{{ now()->format('Y-m-d') }}"
                               class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                    </div>

                    <!-- View Status -->
                    <div>
                        <label for="view_status" class="block text-sm font-medium text-gray-300 mb-2">View Status</label>
                        <select id="view_status" name="view_status" class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                            <option value="">All Orders</option>
                            <option value="unviewed" {{ request('view_status') === 'unviewed' ? 'selected' : '' }}>🔵 Unviewed Only</option>
                            <option value="viewed" {{ request('view_status') === 'viewed' ? 'selected' : '' }}>👁️ Viewed Only</option>
                        </select>
                    </div>

                    <!-- Quick Date Presets -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Quick Filters</label>
                        <select id="date_preset" class="w-full px-3 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb]">
                            <option value="">Select Period</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this_week">This Week</option>
                            <option value="last_week">Last Week</option>
                            <option value="this_month">This Month</option>
                            <option value="last_month">Last Month</option>
                            <option value="last_30_days">Last 30 Days</option>
                            <option value="last_90_days">Last 90 Days</option>
                        </select>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="px-4 py-2 bg-[#2563eb] text-white rounded-lg hover:bg-[#1d4ed8] transition-colors text-sm font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                            </svg>
                            Filter
                        </button>
                        @if(request()->hasAny(['search', 'status', 'payment_status', 'payment_method', 'view_status', 'date_from', 'date_to']))
                            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors text-sm flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Active Filters Display -->
                @if(request()->hasAny(['search', 'status', 'payment_status', 'payment_method', 'view_status', 'date_from', 'date_to']))
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-gray-700">
                        <span class="text-sm text-gray-400 mr-2">Active Filters:</span>
                        
                        @if(request('search'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-900/50 text-blue-200 border border-blue-700">
                                Search: "{{ request('search') }}"
                                <a href="{{ route('admin.orders.index', request()->except('search')) }}" class="ml-1 text-blue-300 hover:text-blue-100">×</a>
                            </span>
                        @endif
                        
                        @if(request('status'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-purple-900/50 text-purple-200 border border-purple-700">
                                Status: {{ ucfirst(request('status')) }}
                                <a href="{{ route('admin.orders.index', request()->except('status')) }}" class="ml-1 text-purple-300 hover:text-purple-100">×</a>
                            </span>
                        @endif
                        
                        @if(request('payment_status'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-900/50 text-green-200 border border-green-700">
                                Payment Status: {{ ucfirst(request('payment_status')) }}
                                <a href="{{ route('admin.orders.index', request()->except('payment_status')) }}" class="ml-1 text-green-300 hover:text-green-100">×</a>
                            </span>
                        @endif

                        @if(request('payment_method'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-indigo-900/50 text-indigo-200 border border-indigo-700">
                                Method: 
                                @if(request('payment_method') === 'webxpay')
                                    💳 WebXPay
                                @elseif(request('payment_method') === 'kokopay')
                                    ⏰ Koko Pay
                                @elseif(request('payment_method') === 'bank_transfer')
                                    🏦 Bank Transfer
                                @else
                                    {{ ucfirst(str_replace('_', ' ', request('payment_method'))) }}
                                @endif
                                <a href="{{ route('admin.orders.index', request()->except('payment_method')) }}" class="ml-1 text-indigo-300 hover:text-indigo-100">×</a>
                            </span>
                        @endif

                        @if(request('view_status'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-cyan-900/50 text-cyan-200 border border-cyan-700">
                                View: {{ request('view_status') === 'unviewed' ? '🔵 Unviewed' : '👁️ Viewed' }}
                                <a href="{{ route('admin.orders.index', request()->except('view_status')) }}" class="ml-1 text-cyan-300 hover:text-cyan-100">×</a>
                            </span>
                        @endif
                        
                        @if(request('date_from') || request('date_to'))
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-orange-900/50 text-orange-200 border border-orange-700">
                                Date: 
                                @if(request('date_from') && request('date_to'))
                                    {{ request('date_from') }} to {{ request('date_to') }}
                                @elseif(request('date_from'))
                                    From {{ request('date_from') }}
                                @else
                                    Until {{ request('date_to') }}
                                @endif
                                <a href="{{ route('admin.orders.index', request()->except(['date_from', 'date_to'])) }}" class="ml-1 text-orange-300 hover:text-orange-100">×</a>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 overflow-hidden">
        @if($orders->count() > 0)
            <!-- Orders Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-800/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Payment Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Payment Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-800/30 transition-colors {{ !$order->isViewedByAdmin() ? 'bg-blue-900/20 border-l-4 border-blue-500' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <div class="flex items-center space-x-2">
                                                <div class="text-sm font-medium {{ !$order->isViewedByAdmin() ? 'text-blue-200 font-bold' : 'text-white' }}">
                                                    {{ $order->order_number }}
                                                </div>
                                                @if(!$order->isViewedByAdmin())
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-blue-900 text-blue-200 border border-blue-700">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        NEW
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-400">{{ $order->orderItems->count() }} items</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-white">{{ $order->customer_name }}</div>
                                        <div class="text-sm text-gray-400">{{ $order->customer_email }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium {{ $order->payment_method_badge }}">
                                            {{ $order->payment_method_display }}
                                        </span>
                                        @if($order->payment_method === 'kokopay')
                                            <span class="text-xs text-purple-400 font-medium">BNPL</span>
                                        @elseif($order->payment_method === 'webxpay')
                                            <span class="text-xs text-blue-400 font-medium">Gateway</span>
                                        @elseif($order->payment_method === 'bank_transfer')
                                            <span class="text-xs text-green-400 font-medium">Manual</span>
                                            @if($order->transfer_slip_path)
                                                <span class="text-xs text-blue-400 font-medium" title="Transfer slip uploaded">📎</span>
                                            @else
                                                <span class="text-xs text-gray-500 font-medium" title="No transfer slip">⏳</span>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->payment_status_badge }}">
                                            @if($order->payment_status === 'paid')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                            @elseif($order->payment_status === 'pending')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                            @elseif($order->payment_status === 'failed')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                            {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                                        </span>
                                        @if($order->payment_status === 'paid' && $order->payment_reference)
                                            <span class="text-xs text-gray-400" title="Payment Reference">
                                                Ref: {{ substr($order->payment_reference, 0, 12) }}{{ strlen($order->payment_reference) > 12 ? '...' : '' }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                    LKR {{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    <div class="flex flex-col">
                                        <div>{{ $order->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.orders.show', $order) }}" 
                                           class="text-[#f59e0b] hover:text-[#d97706] transition-colors">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                        <button onclick="editOrder({{ $order->id }})" 
                                                class="text-blue-400 hover:text-blue-300 transition-colors">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        @if(in_array($order->status, ['pending', 'cancelled']) && $order->payment_status !== 'paid')
                                            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                                    <i class="fas fa-trash mr-1"></i>Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-800">
                {{ $orders->appends(request()->query())->links('custom.pagination') }}
            </div>

        @else
            <!-- Empty State -->
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h3 class="text-lg font-medium text-white mb-2">No orders found</h3>
                @if(request()->hasAny(['search', 'status', 'payment_status', 'date_from', 'date_to']))
                    <p class="text-gray-400 mb-4">Try adjusting your filters</p>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-700 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors">
                        Clear Filters
                    </a>
                @else
                    <p class="text-gray-400">No orders have been placed yet</p>
                @endif
            </div>
        @endif
    </div>
</div>

<script>
// Edit order function
function editOrder(orderId) {
    // Redirect to order details page
    window.location.href = `/admin/orders/${orderId}`;
}

// Date range functionality
document.addEventListener('DOMContentLoaded', function() {
    const dateFrom = document.getElementById('date_from');
    const dateTo = document.getElementById('date_to');
    const datePreset = document.getElementById('date_preset');

    // Date validation - ensure 'from' is not after 'to'
    function validateDateRange() {
        if (dateFrom.value && dateTo.value) {
            if (new Date(dateFrom.value) > new Date(dateTo.value)) {
                dateTo.value = dateFrom.value;
            }
        }
    }

    // Update date_to minimum based on date_from
    if (dateFrom) {
        dateFrom.addEventListener('change', function() {
            if (this.value) {
                dateTo.min = this.value;
            } else {
                dateTo.removeAttribute('min');
            }
            validateDateRange();
        });
    }

    // Update date_from maximum based on date_to
    if (dateTo) {
        dateTo.addEventListener('change', function() {
            if (this.value) {
                dateFrom.max = this.value;
            } else {
                dateFrom.max = '{{ now()->format('Y-m-d') }}';
            }
            validateDateRange();
        });
    }

    // Quick date presets functionality
    if (datePreset) {
        datePreset.addEventListener('change', function() {
            const today = new Date();
            const preset = this.value;
            
            // Clear preset selection after use
            setTimeout(() => this.value = '', 100);

            switch(preset) {
                case 'today':
                    const todayStr = today.toISOString().split('T')[0];
                    dateFrom.value = todayStr;
                    dateTo.value = todayStr;
                    break;

                case 'yesterday':
                    const yesterday = new Date(today);
                    yesterday.setDate(yesterday.getDate() - 1);
                    const yesterdayStr = yesterday.toISOString().split('T')[0];
                    dateFrom.value = yesterdayStr;
                    dateTo.value = yesterdayStr;
                    break;

                case 'this_week':
                    const thisWeekStart = new Date(today);
                    thisWeekStart.setDate(today.getDate() - today.getDay());
                    dateFrom.value = thisWeekStart.toISOString().split('T')[0];
                    dateTo.value = today.toISOString().split('T')[0];
                    break;

                case 'last_week':
                    const lastWeekEnd = new Date(today);
                    lastWeekEnd.setDate(today.getDate() - today.getDay() - 1);
                    const lastWeekStart = new Date(lastWeekEnd);
                    lastWeekStart.setDate(lastWeekEnd.getDate() - 6);
                    dateFrom.value = lastWeekStart.toISOString().split('T')[0];
                    dateTo.value = lastWeekEnd.toISOString().split('T')[0];
                    break;

                case 'this_month':
                    const thisMonthStart = new Date(today.getFullYear(), today.getMonth(), 1);
                    dateFrom.value = thisMonthStart.toISOString().split('T')[0];
                    dateTo.value = today.toISOString().split('T')[0];
                    break;

                case 'last_month':
                    const lastMonthStart = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                    const lastMonthEnd = new Date(today.getFullYear(), today.getMonth(), 0);
                    dateFrom.value = lastMonthStart.toISOString().split('T')[0];
                    dateTo.value = lastMonthEnd.toISOString().split('T')[0];
                    break;

                case 'last_30_days':
                    const thirtyDaysAgo = new Date(today);
                    thirtyDaysAgo.setDate(today.getDate() - 30);
                    dateFrom.value = thirtyDaysAgo.toISOString().split('T')[0];
                    dateTo.value = today.toISOString().split('T')[0];
                    break;

                case 'last_90_days':
                    const ninetyDaysAgo = new Date(today);
                    ninetyDaysAgo.setDate(today.getDate() - 90);
                    dateFrom.value = ninetyDaysAgo.toISOString().split('T')[0];
                    dateTo.value = today.toISOString().split('T')[0];
                    break;
            }

            // Trigger change events to update validation
            if (dateFrom.value) {
                dateFrom.dispatchEvent(new Event('change'));
            }
            if (dateTo.value) {
                dateTo.dispatchEvent(new Event('change'));
            }
        });
    }

    // Auto-submit on preset selection (optional)
    // Uncomment the following lines if you want automatic filtering when selecting presets
    /*
    if (datePreset) {
        datePreset.addEventListener('change', function() {
            if (this.value) {
                setTimeout(() => {
                    document.querySelector('form').submit();
                }, 200);
            }
        });
    }
    */
});
</script>
@endsection
