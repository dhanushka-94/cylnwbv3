@extends('layouts.app')

@section('title', 'Bank Details | Ceylon IT Solutions')
@section('description', 'Bank transfer details for payments to Ceylon IT Solutions (Pvt) Ltd.')
@section('keywords', 'bank details, bank transfer, Ceylon IT Solutions, Commercial Bank, Embilipitiya')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-black to-[#0f0f0f] py-12 sm:py-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Bank details</h1>
            <p class="text-gray-400 text-sm sm:text-base">Use these details for bank transfers to Ceylon IT Solutions.</p>
        </div>

        <div class="bg-[#1a1a1c] border border-[#f59e0b]/40 rounded-2xl p-6 sm:p-8 shadow-xl">
            <div class="flex items-center justify-center mb-8">
                <div class="w-16 h-16 bg-white/5 rounded-xl flex items-center justify-center p-2">
                    <img src="{{ asset('images/commercial_bank.png') }}" alt="" class="w-full h-full object-contain">
                </div>
            </div>

            <dl class="space-y-5">
                <div class="border-b border-gray-800 pb-5">
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Account name</dt>
                    <dd class="text-white font-semibold text-lg">{{ config('bank.account_name') }}</dd>
                </div>
                <div class="border-b border-gray-800 pb-5">
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Account number</dt>
                    <dd class="text-[#f59e0b] font-bold text-xl tracking-wide">{{ config('bank.account_number') }}</dd>
                </div>
                <div class="border-b border-gray-800 pb-5">
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Bank</dt>
                    <dd class="text-white font-medium">{{ config('bank.bank_name') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Branch</dt>
                    <dd class="text-white font-medium">{{ config('bank.branch') }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-8 rounded-xl border border-[#25D366]/40 bg-[#25D366]/10 p-5 text-center">
            <p class="text-white font-medium mb-2">After you pay, send your payment slip on WhatsApp</p>
            <a href="https://wa.me/{{ config('bank.whatsapp_payment_number') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#25D366] hover:bg-[#20BA5A] text-white text-sm font-semibold rounded-lg transition-colors">
                {{ config('bank.whatsapp_payment_display') }}
            </a>
        </div>

        <p class="text-center text-gray-500 text-sm mt-6">
            Include your <strong class="text-gray-400">order number</strong> as the transfer reference when you pay after checkout.
            Questions? <a href="{{ route('contact-us.index') }}" class="text-[#f59e0b] hover:underline">Contact us</a>.
        </p>
    </div>
</div>
@endsection
