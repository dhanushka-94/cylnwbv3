{{-- Payment Method Badges Component (hidden for now) --}}
<div class="payment-badges flex flex-wrap gap-2 mt-3 mb-3 hidden">
    {{-- KokoPay Badge - Glass Professional Style --}}
    <div class="flex items-center bg-gradient-to-r from-purple-500/15 to-pink-500/15 backdrop-blur-sm border border-purple-400/40 rounded-xl px-3 py-2 hover:from-purple-500/20 hover:to-pink-500/20 hover:border-purple-400/60 transition-all duration-300 shadow-lg hover:shadow-purple-500/20">
        <img src="{{ asset('images/kokopay-logo.png') }}" 
             alt="KokoPay" 
             class="w-5 h-5 mr-2 object-contain">
        <span class="text-xs font-bold text-purple-200 tracking-wide">KOKO Pay</span>
        </div>
    
    {{-- Installments Badge - Glass Professional Style --}}
    <div class="flex items-center bg-gradient-to-r from-emerald-500/15 to-teal-500/15 backdrop-blur-sm border border-emerald-400/40 rounded-xl px-3 py-2 hover:from-emerald-500/20 hover:to-teal-500/20 hover:border-emerald-400/60 transition-all duration-300 shadow-lg hover:shadow-emerald-500/20">
        <svg class="w-5 h-5 mr-2 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
        </svg>
        <span class="text-xs font-bold text-emerald-200 tracking-wide">Installments</span>
    </div>
</div>
