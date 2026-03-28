@extends('layouts.app')

@section('title', 'Page Coming Soon - Ceylon IT Solutions')
@section('description', 'This page is under construction and will be available soon. Please check back later or contact us for more information.')
@section('keywords', 'coming soon, under construction, Ceylon IT Solutions, services, bank details, about us')

@section('content')
<!-- Simple Coming Soon Section (shared for Services, Bank Details, About Us) -->
<section class="py-20 bg-gradient-to-b from-black to-[#0f0f0f] relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-32 w-64 h-64 bg-[#f59e0b]/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center">
            <div class="inline-flex items-center px-4 py-2 bg-[#f59e0b]/10 border border-[#f59e0b]/30 rounded-full text-[#f59e0b] text-xs sm:text-sm font-medium mb-6">
                <span class="w-2 h-2 rounded-full bg-[#f59e0b] mr-2 animate-pulse"></span>
                This page will be available soon
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-4">
                Beautiful things are <span class="text-[#f59e0b]">on the way</span>
            </h1>

            <p class="text-base sm:text-lg text-gray-300 mb-8">
                We’re currently redesigning this section to give you a better experience.
                In the meantime, you can browse products or contact our team for any information you need.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-[#f59e0b] text-black font-semibold text-sm shadow-lg hover:bg-[#d97706] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                    </svg>
                    Back to Home
                </a>

                <a href="{{ route('contact-us.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 rounded-lg border border-gray-600 text-gray-100 font-semibold text-sm hover:border-[#f59e0b] hover:text-[#f59e0b] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contact Support
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-gray-400">
                <div class="bg-[#1a1a1c] border border-gray-800 rounded-lg p-4">
                    <p class="font-semibold text-white mb-1">Service Center</p>
                    <p>On‑site & remote services page is being upgraded.</p>
                </div>
                <div class="bg-[#1a1a1c] border border-gray-800 rounded-lg p-4">
                    <p class="font-semibold text-white mb-1">Bank Details</p>
                    <p>New, simplified payment instructions coming soon.</p>
                </div>
                <div class="bg-[#1a1a1c] border border-gray-800 rounded-lg p-4">
                    <p class="font-semibold text-white mb-1">About Us</p>
                    <p>We’re preparing a refreshed story about Ceylon IT Solutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

