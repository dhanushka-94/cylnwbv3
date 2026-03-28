@extends('layouts.app')

@section('title', 'Shopping Cart - Ceylon IT Solutions')

@section('content')
<div class="min-h-screen bg-black py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">Shopping Cart</h1>
            <p class="text-gray-400 mt-2 text-sm sm:text-base">Review your items before checkout</p>
        </div>

        @if($cartItems->isEmpty())
            <!-- Empty Cart -->
            <div class="bg-[#1a1a1c] rounded-lg border border-gray-800 p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 text-gray-600">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V18C19 19.1 18.1 20 17 20H7C5.9 20 5 19.1 5 18V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V18H17V6H7Z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Your cart is empty</h3>
                <p class="text-gray-400 mb-6">Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('categories.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-[#f59e0b] text-black font-semibold rounded-lg hover:bg-[#d97706] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-[#1a1a1c] rounded-lg border border-gray-800 overflow-hidden">
                        <div class="px-4 sm:px-6 py-4 border-b border-gray-800">
                            <h2 class="text-lg font-semibold text-white">Cart Items</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-800">
                            @foreach($cartItems as $item)
                                <div class="p-4 sm:p-6 cart-item" data-item-id="{{ $item->id }}">
                                    <div class="flex flex-col sm:flex-row sm:items-start space-y-4 sm:space-y-0 sm:space-x-4">
                                        <!-- Product Image & Basic Info -->
                                        <div class="flex items-start space-x-3 sm:space-x-4 flex-1">
                                            <!-- Product Image -->
                                            <div class="flex-shrink-0">
                                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#2c2c2e] rounded-lg overflow-hidden">
                                                    <img src="{{ $item->product->main_image }}" 
                                                         alt="{{ $item->product->name }}"
                                                         class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                            
                                            <!-- Product Details -->
                                            <div class="flex-grow min-w-0">
                                                <h3 class="text-white font-medium text-sm sm:text-base leading-tight">{{ $item->product->name }}</h3>
                                                <p class="text-gray-400 text-xs mt-1">Code: {{ $item->product->code }}</p>
                                                
                                                @if($item->product->is_on_sale)
                                                    <div class="flex items-center space-x-2 mt-2">
                                                        <span class="text-[#f59e0b] font-semibold text-sm sm:text-base">LKR {{ number_format($item->product->final_price, 2) }}</span>
                                                        <span class="text-gray-500 line-through text-xs sm:text-sm">LKR {{ number_format($item->product->price, 2) }}</span>
                                                    </div>
                                                @else
                                                    <p class="text-[#f59e0b] font-semibold mt-2 text-sm sm:text-base">LKR {{ number_format($item->product->final_price, 2) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Mobile: Price and Remove (shown on mobile) -->
                                        <div class="flex sm:hidden items-center justify-between">
                                            <div class="text-right">
                                                <p class="text-white font-semibold item-total text-lg">LKR {{ number_format($item->product->final_price * $item->quantity, 2) }}</p>
                                            </div>
                                            <button type="button" 
                                                    class="remove-item text-red-400 hover:text-red-300 text-sm px-3 py-1 rounded transition-colors"
                                                    data-item-id="{{ $item->id }}">
                                                Remove
                                            </button>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center justify-between sm:justify-start sm:flex-col sm:items-end space-y-0 sm:space-y-3">
                                            <div class="flex items-center space-x-3">
                                                <label class="text-gray-400 text-sm">Qty:</label>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" 
                                                            class="quantity-btn w-10 h-10 sm:w-8 sm:h-8 bg-[#2c2c2e] border border-gray-700 rounded text-white hover:bg-[#3c3c3e] transition-colors text-lg sm:text-base"
                                                            data-action="decrease" data-item-id="{{ $item->id }}">-</button>
                                                    <input type="number" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" 
                                                           max="{{ $item->product->stock_quantity }}"
                                                           class="quantity-input w-16 h-10 sm:w-16 sm:h-8 bg-[#2c2c2e] border border-gray-700 text-white text-center text-sm rounded focus:ring-1 focus:ring-[#f59e0b] focus:border-[#f59e0b]"
                                                           data-item-id="{{ $item->id }}"
                                                           data-max-stock="{{ $item->product->stock_quantity }}">
                                                    <button type="button" 
                                                            class="quantity-btn w-10 h-10 sm:w-8 sm:h-8 bg-[#2c2c2e] border border-gray-700 rounded text-white hover:bg-[#3c3c3e] transition-colors text-lg sm:text-base"
                                                            data-action="increase" data-item-id="{{ $item->id }}">+</button>
                                                </div>
                                            </div>
                                            
                                            <!-- Desktop: Item Total & Remove (hidden on mobile) -->
                                            <div class="hidden sm:block text-right">
                                                <p class="text-white font-semibold item-total">LKR {{ number_format($item->product->final_price * $item->quantity, 2) }}</p>
                                                <button type="button" 
                                                        class="remove-item text-red-400 hover:text-red-300 text-sm mt-2 transition-colors"
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
                    
                    <!-- Continue Shopping -->
                    <div class="mt-6">
                        <a href="{{ route('categories.index') }}" 
                           class="inline-flex items-center text-[#f59e0b] hover:text-[#d97706] transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1 space-y-4 sm:space-y-6">
                    <div class="bg-[#1a1a1c] rounded-lg border border-gray-800 p-4 sm:p-6 lg:sticky lg:top-32">
                        <h2 class="text-lg font-semibold text-white mb-4">Order Summary</h2>
                        
                        <div class="space-y-3">
                            <!-- Subtotal (before discounts) -->
                            <div class="flex justify-between text-gray-300">
                                <span>Subtotal</span>
                                <span class="cart-original-subtotal">LKR {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 2) }}</span>
                            </div>
                            
                            <!-- Discount (if any) -->
                            <div class="flex justify-between text-green-400 discount-row" style="{{ $cartItems->sum(function($item) { return ($item->product->price - $item->product->final_price) * $item->quantity; }) > 0 ? '' : 'display: none;' }}">
                                <span>
                                    Discount
                                    <span class="text-xs text-gray-500 block">You save</span>
                                </span>
                                <span class="cart-discount">
                                    -LKR {{ number_format($cartItems->sum(function($item) { return ($item->product->price - $item->product->final_price) * $item->quantity; }), 2) }}
                                </span>
                            </div>
                            
                            <div class="flex justify-between text-gray-300">
                                <span>Shipping</span>
                                <span class="text-amber-400 text-xs">
                                    Pay on delivery
                                </span>
                            </div>
                            
                            <!-- Grand Total Section -->
                            <div class="border-t border-gray-700 pt-4">
                                <div class="flex justify-between items-center text-white font-bold text-xl mb-2">
                                    <span>Grand Total</span>
                                    <span class="cart-total cart-page-total text-[#f59e0b]">LKR {{ number_format($cartTotal, 2) }}</span>
                            </div>
                                <div class="flex justify-between text-gray-400 text-sm">
                                    <span>Final amount to pay</span>
                                    <span>(Excluding delivery charges)</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-3">
                            <a href="{{ route('checkout.index') }}" 
                               class="w-full bg-[#f59e0b] text-black font-semibold py-3 px-4 rounded-lg hover:bg-[#d97706] transition-colors text-center block">
                                Proceed to Checkout
                            </a>
                            <button type="button" 
                                    id="clear-cart"
                                    class="w-full bg-transparent border border-gray-700 text-gray-300 font-semibold py-3 px-4 rounded-lg hover:bg-[#2c2c2e] transition-colors">
                                Clear Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Shipping/Delivery Information -->
                    <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-lg border border-gray-800 p-4 sm:p-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-5 h-5 text-primary-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                            </svg>
                            <h3 class="text-base sm:text-lg font-medium text-white">Shipping Information</h3>
                        </div>
                        
                        <div class="bg-amber-900/20 border border-amber-700/50 rounded-lg p-3 sm:p-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-amber-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h4 class="text-amber-400 font-medium text-sm mb-2">Delivery Charges</h4>
                                    <p class="text-amber-300 text-xs sm:text-sm mb-3 leading-relaxed">
                                        Kindly note that delivery charges are due at the time of parcel receipt.
                                    </p>
                                    <p class="text-amber-300 text-xs sm:text-sm font-medium leading-relaxed">
                                        පාර්සලය ලැබුණු අවස්ථාවේදී බෙදා හැරීමේ ගාස්තු ගෙවිය යුතු බව කරුණාවෙන් සලකන්න.
                                    </p>
                                </div>
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
    // Quantity buttons
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
    
    // Quantity input change
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
    
    // Remove item buttons
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            removeCartItem(itemId);
        });
    });
    
    // Clear cart button
    document.getElementById('clear-cart')?.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            clearCart();
        }
    });
    
    function updateCartItem(itemId, quantity) {
        console.log('Updating cart item:', itemId, 'quantity:', quantity);
        
        fetch(`/cart/update/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => {
            console.log('Update response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Update response data:', data);
            if (data.success) {
                // Update item total
                const itemRow = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                if (itemRow) {
                    const itemTotalElement = itemRow.querySelector('.item-total');
                    if (itemTotalElement) {
                        itemTotalElement.textContent = `LKR ${data.item_total}`;
                    }
                }
                
                // Update cart totals
                updateCartTotals(data);
                
                // Update cart total using global function
                if (window.updateCartTotal) {
                    window.updateCartTotal(data.cart_total);
                } else {
                    // Update localStorage as fallback
                    localStorage.setItem('cartTotal', data.cart_total);
                }
            } else {
                alert(data.message || 'Failed to update cart item');
            }
        })
        .catch(error => {
            console.error('Error updating cart item:', error);
            alert('Something went wrong. Please try again.');
        });
    }
    
    function removeCartItem(itemId) {
        console.log('Removing cart item:', itemId);
        
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            console.log('Remove response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Remove response data:', data);
            if (data.success) {
                // Remove item from DOM
                const itemElement = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                if (itemElement) {
                    itemElement.remove();
                }
                
                // Update cart totals
                updateCartTotals(data);
                
                // Update cart total using global function
                if (window.updateCartTotal) {
                    window.updateCartTotal(data.cart_total);
                } else {
                    // Update localStorage as fallback
                    localStorage.setItem('cartTotal', data.cart_total);
                }
                
                // Check if cart is empty by checking if total is 0
                if (parseFloat(data.cart_total) === 0) {
                    location.reload();
                }
            } else {
                alert(data.message || 'Failed to remove cart item');
            }
        })
        .catch(error => {
            console.error('Error removing cart item:', error);
            alert('Failed to remove item. Please try again.');
        });
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
                // Update cart total using server response data
                if (window.updateCartTotal) {
                    window.updateCartTotal(data.cart_total);
                } else {
                    // Update localStorage as fallback
                    localStorage.setItem('cartTotal', data.cart_total);
                }
                
                // Small delay to ensure count update is visible before reload
                setTimeout(() => {
                location.reload();
                }, 300);
            }
        })
        .catch(error => {
            console.error('Error clearing cart:', error);
            alert('Failed to clear cart. Please try again.');
        });
    }
    
    function updateCartTotals(data) {
        console.log('=== updateCartTotals START ===');
        console.log('Data received:', data);
        
        // Handle both new object format and old string format for backward compatibility
        let cartTotal, originalSubtotal, totalDiscount, hasDiscount;
        
        if (typeof data === 'string') {
            // Old format - just a cart total string
            cartTotal = data;
            console.log('Using old string format:', cartTotal);
        } else if (typeof data === 'object' && data !== null) {
            // New format - object with multiple values
            cartTotal = data.cart_total;
            originalSubtotal = data.original_subtotal;
            totalDiscount = data.total_discount;
            hasDiscount = data.has_discount;
            console.log('Using new object format');
        } else {
            console.error('Invalid data format passed to updateCartTotals:', data);
            return;
        }
        
        console.log('Parsed values:', {
            cartTotal,
            originalSubtotal,
            totalDiscount,
            hasDiscount
        });
        
        // DEBUG: List all elements with cart-related classes
        console.log('=== DOM INSPECTION ===');
        const allCartElements = document.querySelectorAll('[class*="cart"]');
        console.log('All elements with "cart" in class:', allCartElements);
        allCartElements.forEach((el, i) => {
            console.log(`Element ${i}:`, el.className, '→', el.textContent.trim());
        });
        
        // Update the main cart total (CRITICAL)
        console.log('=== UPDATING CART TOTAL ===');
        
        // Debug: Check all .cart-total elements
        const allCartTotalElements = document.querySelectorAll('.cart-total');
        console.log('All .cart-total elements found:', allCartTotalElements.length);
        allCartTotalElements.forEach((el, i) => {
            console.log(`Element ${i}:`, el, 'Text:', el.textContent, 'Parent:', el.parentElement);
        });
        
        // Find the specific cart total element in the Order Summary (use more specific selector)
        const cartTotalElement = document.querySelector('.cart-page-total') || document.querySelector('.cart-total');
        console.log('Cart page total element found:', cartTotalElement);
        
        if (cartTotalElement) {
            const currentText = cartTotalElement.textContent;
            const newTotal = `LKR ${cartTotal}`;
            
            console.log('Current text:', currentText);
            console.log('Setting new text:', newTotal);
            
            // Try multiple update methods
            cartTotalElement.textContent = newTotal;
            cartTotalElement.innerHTML = newTotal;
            
            // Force a visual update and repaint
            cartTotalElement.style.color = '#ffffff';
            cartTotalElement.style.fontWeight = 'bold';
            
            // Trigger a reflow
            cartTotalElement.offsetHeight;
            
            // Add a visual flash to confirm update (enhanced for grand total)
            cartTotalElement.style.backgroundColor = '#ffffff';
            cartTotalElement.style.color = '#000000';
            setTimeout(() => {
                cartTotalElement.style.backgroundColor = '';
                cartTotalElement.style.color = '#f59e0b';
            }, 300);
            
            console.log('Text after update:', cartTotalElement.textContent);
            console.log('innerHTML after update:', cartTotalElement.innerHTML);
            
            // Verify the change took effect
            setTimeout(() => {
                console.log('Verification after 100ms:', cartTotalElement.textContent);
            }, 100);
            
        } else {
            console.error('❌ Cart total element NOT FOUND with .cart-total');
            
            // Extensive fallback search
            const alternatives = [
                'span.cart-total',
                '.cart-total',
                '[class="cart-total"]',
                '[class*="cart-total"]',
                'span[class*="cart-total"]'
            ];
            
            for (let selector of alternatives) {
                const altElement = document.querySelector(selector);
                console.log(`Trying ${selector}:`, altElement);
                if (altElement) {
                    altElement.textContent = `LKR ${cartTotal}`;
                    console.log(`✅ Updated using ${selector}`);
                    break;
                }
            }
        }
        
        // Update original subtotal
        console.log('=== UPDATING SUBTOTAL ===');
        const originalSubtotalElement = document.querySelector('.cart-original-subtotal');
        if (originalSubtotalElement && originalSubtotal !== undefined) {
            originalSubtotalElement.textContent = `LKR ${originalSubtotal}`;
            console.log('✅ Updated original subtotal to:', `LKR ${originalSubtotal}`);
        } else {
            console.log('Subtotal element:', originalSubtotalElement, 'Data:', originalSubtotal);
        }
        
        // Update discount row
        console.log('=== UPDATING DISCOUNT ===');
        const discountRow = document.querySelector('.discount-row');
        const discountElement = document.querySelector('.cart-discount');
        
        console.log('Discount row:', discountRow);
        console.log('Discount element:', discountElement);
        console.log('Has discount:', hasDiscount, 'Amount:', totalDiscount);
        
        if (hasDiscount && totalDiscount !== undefined && parseFloat(totalDiscount.toString().replace(/[^\d.,]/g, '').replace(',', '')) > 0) {
            if (discountElement) {
                discountElement.textContent = `-LKR ${totalDiscount}`;
                console.log('✅ Updated discount to:', `-LKR ${totalDiscount}`);
            }
            if (discountRow) {
                discountRow.style.display = 'flex';
                console.log('✅ Showing discount row');
            }
        } else {
            if (discountRow) {
                discountRow.style.display = 'none';
                console.log('✅ Hiding discount row');
            }
        }
        
        console.log('=== updateCartTotals COMPLETE ===');
    }
    
    // Global test function for manual debugging
    window.testCartUpdate = function() {
        console.log('=== MANUAL GRAND TOTAL UPDATE TEST ===');
        const testData = {
            cart_total: "45,500.00",
            original_subtotal: "55,000.00", 
            total_discount: "9,500.00",
            has_discount: true
        };
        console.log('Testing Grand Total update with:', testData);
        updateCartTotals(testData);
    };
    
    // Global DOM inspection function
    window.inspectCartElements = function() {
        console.log('=== CART ELEMENT INSPECTION ===');
        const allCartTotals = document.querySelectorAll('.cart-total');
        const cartPageTotal = document.querySelector('.cart-page-total');
        const cartSubtotal = document.querySelector('.cart-original-subtotal');
        const cartDiscount = document.querySelector('.cart-discount');
        
        console.log('All Cart Total Elements:', allCartTotals.length);
        allCartTotals.forEach((el, i) => {
            console.log(`  Element ${i}:`, el.textContent, '(in:', el.closest('.container, header, nav, main')?.tagName || 'unknown', ')');
        });
        
        console.log('Cart Page Total Element:', cartPageTotal);
        console.log('Cart Page Total Text:', cartPageTotal ? cartPageTotal.textContent : 'NOT FOUND');
        console.log('Cart Subtotal Element:', cartSubtotal);
        console.log('Cart Subtotal Text:', cartSubtotal ? cartSubtotal.textContent : 'NOT FOUND');
        console.log('Cart Discount Element:', cartDiscount);
        console.log('Cart Discount Text:', cartDiscount ? cartDiscount.textContent : 'NOT FOUND');
        
        return {
            allCartTotals,
            cartPageTotal,
            cartSubtotal, 
            cartDiscount
        };
    };
    
    // Helper function to update header cart total (since global function excludes cart page)
    function updateHeaderCartTotal(cartTotal) {
        try {
            // Update all cart total elements in header (not in cart page content)
            const headerCartElements = document.querySelectorAll('header .cart-total, nav .cart-total, .header .cart-total');
            headerCartElements.forEach(element => {
                if (element && !element.closest('.cart-item')) {
                    element.textContent = `LKR ${cartTotal}`;
                }
            });
            console.log('Header cart total updated to:', cartTotal);
        } catch (error) {
            console.error('Error updating header cart total:', error);
        }
    }
    
    console.log('🔧 Debug functions available:');
    console.log('- window.testCartUpdate() - Test manual cart update');
    console.log('- window.inspectCartElements() - Inspect DOM elements');
});
</script>
@endpush
@endsection

@push('scripts')
<script>
    // Initialize cart total on page load (no count needed)
    document.addEventListener('DOMContentLoaded', function() {
        // No need to fetch cart count anymore - removed feature
    });
</script>
@endpush
