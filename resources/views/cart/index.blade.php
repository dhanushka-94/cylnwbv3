@extends('layouts.app')

@section('title', 'Shopping Cart - Ceylon IT Solutions')

@section('content')
{{-- Bluish dark theme: slate + blue accents --}}
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-[#0a1628] to-slate-950 py-8 sm:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page header -->
        <div class="mb-8 sm:mb-10">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-blue-500/10 border border-blue-500/25 px-3 py-1 text-xs font-medium text-blue-300/90 mb-3">
                        <svg class="w-3.5 h-3.5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Secure checkout
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Shopping cart</h1>
                    <p class="text-slate-400 mt-2 text-sm sm:text-base max-w-xl">Review quantities and totals. Shipping is confirmed at checkout.</p>
                </div>
                @if(!$cartItems->isEmpty())
                <div class="text-left sm:text-right">
                    <p class="text-xs uppercase tracking-wider text-slate-500 font-medium">{{ $cartItems->count() }} {{ $cartItems->count() === 1 ? 'item' : 'items' }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($cartItems->isEmpty())
            <!-- Empty state -->
            <div class="relative overflow-hidden rounded-2xl border border-blue-500/20 bg-gradient-to-br from-slate-900/90 to-[#0c1829] p-10 sm:p-14 text-center shadow-xl shadow-blue-950/40">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-blue-600/10 via-transparent to-transparent pointer-events-none" aria-hidden="true"></div>
                <div class="relative">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-blue-500/10 border border-blue-500/25 flex items-center justify-center text-blue-400/80">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-semibold text-white mb-2">Your cart is empty</h3>
                    <p class="text-slate-400 mb-8 max-w-md mx-auto text-sm sm:text-base">Browse categories and add products — your selections will appear here.</p>
                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-sky-600 text-white font-semibold text-sm sm:text-base shadow-lg shadow-blue-900/40 hover:from-blue-500 hover:to-sky-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-slate-950 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Continue shopping
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Line items -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="rounded-2xl border border-blue-500/15 bg-slate-900/60 backdrop-blur-sm overflow-hidden shadow-xl shadow-blue-950/30">
                        <div class="px-4 sm:px-6 py-4 border-b border-blue-500/10 flex items-center justify-between gap-3 bg-slate-900/40">
                            <h2 class="text-base font-semibold text-white flex items-center gap-2">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/15 text-sky-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                </span>
                                Cart items
                            </h2>
                        </div>

                        <div class="divide-y divide-blue-500/10">
                            @foreach($cartItems as $item)
                                <div class="p-4 sm:p-6 cart-item group hover:bg-blue-950/20 transition-colors" data-item-id="{{ $item->id }}">
                                    <div class="flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-5">
                                        <div class="flex items-start gap-3 sm:gap-4 flex-1 min-w-0">
                                            <div class="flex-shrink-0 rounded-xl overflow-hidden ring-2 ring-blue-500/20 group-hover:ring-blue-400/40 transition-all bg-slate-800/80">
                                                <div class="w-20 h-20 sm:w-24 sm:h-24">
                                                    <img src="{{ $item->product->main_image }}"
                                                         alt="{{ $item->product->name }}"
                                                         class="w-full h-full object-cover"
                                                         loading="lazy">
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <h3 class="text-white font-medium text-sm sm:text-base leading-snug line-clamp-2">{{ $item->product->name }}</h3>
                                                <p class="text-slate-500 text-xs mt-1 font-mono">Code: {{ $item->product->code }}</p>

                                                @if($item->product->is_on_sale)
                                                    <div class="flex flex-wrap items-baseline gap-2 mt-2">
                                                        <span class="text-sky-400 font-semibold text-sm sm:text-base tabular-nums">LKR {{ number_format($item->product->final_price, 2) }}</span>
                                                        <span class="text-slate-500 line-through text-xs sm:text-sm tabular-nums">LKR {{ number_format($item->product->price, 2) }}</span>
                                                        <span class="text-[10px] sm:text-xs font-medium uppercase tracking-wide text-emerald-400/90 bg-emerald-500/10 px-2 py-0.5 rounded">Sale</span>
                                                    </div>
                                                @else
                                                    <p class="text-sky-400 font-semibold mt-2 text-sm sm:text-base tabular-nums">LKR {{ number_format($item->product->final_price, 2) }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex sm:hidden items-center justify-between pt-1 border-t border-blue-500/10 sm:border-0">
                                            <p class="text-white font-semibold item-total text-lg tabular-nums">LKR {{ number_format($item->product->final_price * $item->quantity, 2) }}</p>
                                            <button type="button"
                                                    class="remove-item text-sm font-medium text-rose-400/90 hover:text-rose-300 px-3 py-1.5 rounded-lg hover:bg-rose-500/10 transition-colors"
                                                    data-item-id="{{ $item->id }}">
                                                Remove
                                            </button>
                                        </div>

                                        <div class="flex items-center justify-between sm:justify-end sm:flex-col sm:items-end gap-3 sm:gap-4 sm:min-w-[9rem]">
                                            <div>
                                                <span class="sr-only">Quantity</span>
                                                <div class="inline-flex items-center rounded-xl border border-blue-500/25 bg-slate-900/80 p-0.5 shadow-inner shadow-black/20">
                                                    <button type="button"
                                                            class="quantity-btn w-10 h-10 sm:w-9 sm:h-9 rounded-lg text-slate-200 hover:bg-blue-600/30 hover:text-white transition-colors disabled:opacity-40"
                                                            data-action="decrease" data-item-id="{{ $item->id }}" aria-label="Decrease quantity">−</button>
                                                    <input type="number"
                                                           value="{{ $item->quantity }}"
                                                           min="1"
                                                           max="{{ $item->product->stock_quantity }}"
                                                           class="quantity-input w-12 sm:w-11 h-10 sm:h-9 bg-transparent border-0 text-center text-sm font-semibold text-white tabular-nums focus:ring-0 focus:outline-none"
                                                           data-item-id="{{ $item->id }}"
                                                           data-max-stock="{{ $item->product->stock_quantity }}"
                                                           aria-label="Quantity">
                                                    <button type="button"
                                                            class="quantity-btn w-10 h-10 sm:w-9 sm:h-9 rounded-lg text-slate-200 hover:bg-blue-600/30 hover:text-white transition-colors"
                                                            data-action="increase" data-item-id="{{ $item->id }}" aria-label="Increase quantity">+</button>
                                                </div>
                                                <p class="text-[11px] text-slate-500 mt-1.5 text-center sm:text-right">{{ $item->product->stock_quantity }} in stock</p>
                                            </div>

                                            <div class="hidden sm:block text-right">
                                                <p class="text-white font-semibold item-total tabular-nums text-base">LKR {{ number_format($item->product->final_price * $item->quantity, 2) }}</p>
                                                <button type="button"
                                                        class="remove-item mt-2 text-xs font-medium text-rose-400/90 hover:text-rose-300 transition-colors"
                                                        data-item-id="{{ $item->id }}">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-medium text-sky-400 hover:text-sky-300 transition-colors group">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Continue shopping
                    </a>
                </div>

                <!-- Summary column -->
                <div class="lg:col-span-1 space-y-5">
                    <div class="rounded-2xl border border-blue-500/20 bg-gradient-to-b from-slate-900/90 to-[#0c1829] p-5 sm:p-6 lg:sticky lg:top-28 shadow-xl shadow-blue-950/40">
                        <h2 class="text-lg font-semibold text-white mb-5 flex items-center gap-2">
                            <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Order summary
                        </h2>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-slate-300 gap-4">
                                <span>Subtotal</span>
                                <span class="cart-original-subtotal tabular-nums text-slate-200 font-medium">LKR {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 2) }}</span>
                            </div>

                            <div class="flex justify-between text-emerald-400/95 discount-row gap-4" style="{{ $cartItems->sum(function($item) { return ($item->product->price - $item->product->final_price) * $item->quantity; }) > 0 ? '' : 'display: none;' }}">
                                <span>
                                    Discount
                                    <span class="text-[11px] text-slate-500 block font-normal">You save</span>
                                </span>
                                <span class="cart-discount tabular-nums font-medium">
                                    -LKR {{ number_format($cartItems->sum(function($item) { return ($item->product->price - $item->product->final_price) * $item->quantity; }), 2) }}
                                </span>
                            </div>

                            <div class="flex justify-between text-slate-300 gap-4">
                                <span>Shipping</span>
                                <span class="text-xs text-sky-400/90 font-medium text-right max-w-[10rem]">Set at checkout</span>
                            </div>

                            <div class="border-t border-blue-500/20 pt-4 mt-2">
                                <div class="flex justify-between items-baseline gap-4">
                                    <span class="text-white font-bold text-lg">Grand total</span>
                                    <span class="cart-total cart-page-total text-xl font-bold text-sky-300 tabular-nums">LKR {{ number_format($cartTotal, 2) }}</span>
                                </div>
                                <p class="text-slate-500 text-xs mt-2">Final amount before delivery fees.</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            <a href="{{ route('checkout.index') }}"
                               class="w-full inline-flex justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-sky-600 text-white font-semibold py-3.5 px-4 shadow-lg shadow-blue-900/35 hover:from-blue-500 hover:to-sky-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-[#0c1829] transition-all text-center">
                                Proceed to checkout
                                <svg class="w-4 h-4 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <button type="button"
                                    id="clear-cart"
                                    class="w-full rounded-xl border border-blue-500/25 bg-slate-900/50 text-slate-300 font-medium py-3 px-4 hover:bg-slate-800/80 hover:border-blue-400/30 transition-colors text-sm">
                                Clear cart
                            </button>
                        </div>
                    </div>

                    <!-- Delivery note -->
                    <div class="rounded-2xl border border-blue-500/15 bg-slate-900/50 p-4 sm:p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-blue-500/15 text-sky-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-sky-200 mb-2">Delivery charges</h3>
                                <p class="text-slate-400 text-xs sm:text-sm leading-relaxed mb-2">
                                    Delivery charges are payable when you receive your parcel.
                                </p>
                                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                                    පාර්සලය ලැබුණු අවස්ථාවේදී බෙදා හැරීමේ ගාස්තු ගෙවිය යුතු බව කරුණාවෙන් සලකන්න.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            const maxStock = parseInt(input.dataset.maxStock);

            let newQuantity = parseInt(input.value);
            if (action === 'increase') {
                if (newQuantity < maxStock) {
                    newQuantity++;
                } else {
                    alert(`Maximum available quantity is ${maxStock}`);
                    return;
                }
            } else if (action === 'decrease' && newQuantity > 1) {
                newQuantity--;
            }

            input.value = newQuantity;
            updateCartItem(itemId, newQuantity);
        });
    });

    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const itemId = this.dataset.itemId;
            const quantity = parseInt(this.value);
            const maxStock = parseInt(this.dataset.maxStock);

            if (quantity < 1) {
                this.value = 1;
                return;
            }

            if (quantity > maxStock) {
                alert(`Maximum available quantity is ${maxStock}. Setting to maximum.`);
                this.value = maxStock;
                updateCartItem(itemId, maxStock);
                return;
            }

            updateCartItem(itemId, quantity);
        });
    });

    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            removeCartItem(itemId);
        });
    });

    document.getElementById('clear-cart')?.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            clearCart();
        }
    });

    function updateCartItem(itemId, quantity) {
        fetch(`/cart/update/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const itemRow = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                if (itemRow) {
                    const itemTotalElement = itemRow.querySelector('.item-total');
                    if (itemTotalElement) {
                        itemTotalElement.textContent = `LKR ${data.item_total}`;
                    }
                }
                updateCartTotals(data);
                if (window.updateCartTotal) {
                    window.updateCartTotal(data.cart_total);
                } else {
                    localStorage.setItem('cartTotal', data.cart_total);
                }
            } else {
                alert(data.message || 'Failed to update cart item');
            }
        })
        .catch(() => alert('Something went wrong. Please try again.'));
    }

    function removeCartItem(itemId) {
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const itemElement = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                if (itemElement) itemElement.remove();

                updateCartTotals(data);
                if (window.updateCartTotal) {
                    window.updateCartTotal(data.cart_total);
                } else {
                    localStorage.setItem('cartTotal', data.cart_total);
                }

                if (parseFloat(data.cart_total) === 0) {
                    location.reload();
                }
            } else {
                alert(data.message || 'Failed to remove cart item');
            }
        })
        .catch(() => alert('Failed to remove item. Please try again.'));
    }

    function clearCart() {
        fetch('/cart/clear', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (window.updateCartTotal) {
                    window.updateCartTotal(data.cart_total);
                } else {
                    localStorage.setItem('cartTotal', data.cart_total);
                }
                setTimeout(() => location.reload(), 300);
            }
        })
        .catch(() => alert('Failed to clear cart. Please try again.'));
    }

    function updateCartTotals(data) {
        let cartTotal, originalSubtotal, totalDiscount, hasDiscount;

        if (typeof data === 'string') {
            cartTotal = data;
        } else if (typeof data === 'object' && data !== null) {
            cartTotal = data.cart_total;
            originalSubtotal = data.original_subtotal;
            totalDiscount = data.total_discount;
            hasDiscount = data.has_discount;
        } else {
            return;
        }

        const cartTotalElement = document.querySelector('.cart-page-total') || document.querySelector('.cart-total');
        if (cartTotalElement) {
            cartTotalElement.textContent = `LKR ${cartTotal}`;
            cartTotalElement.style.color = '#7dd3fc';
            cartTotalElement.style.fontWeight = '700';
            cartTotalElement.style.backgroundColor = 'rgba(59, 130, 246, 0.15)';
            setTimeout(() => {
                cartTotalElement.style.backgroundColor = '';
                cartTotalElement.style.color = '';
            }, 280);
        }

        const originalSubtotalElement = document.querySelector('.cart-original-subtotal');
        if (originalSubtotalElement && originalSubtotal !== undefined) {
            originalSubtotalElement.textContent = `LKR ${originalSubtotal}`;
        }

        const discountRow = document.querySelector('.discount-row');
        const discountElement = document.querySelector('.cart-discount');

        if (hasDiscount && totalDiscount !== undefined && parseFloat(totalDiscount.toString().replace(/[^\d.,]/g, '').replace(',', '')) > 0) {
            if (discountElement) discountElement.textContent = `-LKR ${totalDiscount}`;
            if (discountRow) discountRow.style.display = 'flex';
        } else {
            if (discountRow) discountRow.style.display = 'none';
        }
    }

    window.testCartUpdate = function() {
        updateCartTotals({
            cart_total: "45,500.00",
            original_subtotal: "55,000.00",
            total_discount: "9,500.00",
            has_discount: true
        });
    };

    window.inspectCartElements = function() {
        return {
            cartPageTotal: document.querySelector('.cart-page-total'),
            cartSubtotal: document.querySelector('.cart-original-subtotal'),
            cartDiscount: document.querySelector('.cart-discount')
        };
    };
});
</script>
@endpush
@endsection
