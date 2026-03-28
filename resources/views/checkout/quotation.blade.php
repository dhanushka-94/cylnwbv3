@extends('layouts.app')

@section('title', 'Get Quotation - Ceylon IT Solutions')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#1a1a1c] to-[#0f0f0f] py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center space-x-2 text-blue-400 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h1 class="text-3xl font-bold text-white">Get Quotation</h1>
            </div>
            <p class="text-gray-300">Fill in your details to download a professional PDF quotation</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-900/20 border border-red-700/50 rounded-lg p-4 mb-6">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="text-red-400 font-medium text-sm mb-2">Please fix the following errors:</h4>
                        <ul class="text-red-300 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-2xl mx-auto">
            <form action="{{ route('quotation.generate') }}" method="POST" id="quotation-form">
                @csrf
                
                <!-- Simple Contact Information -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-8 mb-6">
                    <h3 class="text-xl font-semibold text-white mb-6 text-center flex items-center justify-center space-x-2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Contact Information</span>
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">
                                First Name *
                            </label>
                            <input type="text" 
                                   id="first_name" 
                                   name="first_name" 
                                   value="{{ old('first_name', Auth::user() ? explode(' ', Auth::user()->name)[0] : '') }}" 
                                   required
                                   placeholder="Enter your first name"
                                   class="w-full px-4 py-3 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">
                                Last Name *
                            </label>
                            <input type="text" 
                                   id="last_name" 
                                   name="last_name" 
                                   value="{{ old('last_name', Auth::user() && str_contains(Auth::user()->name, ' ') ? substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1) : '') }}" 
                                   required
                                   placeholder="Enter your last name"
                                   class="w-full px-4 py-3 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-300 mb-2">
                                Phone Number *
                            </label>
                            <input type="tel" 
                                   id="customer_phone" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone', Auth::user()->phone ?? '') }}" 
                                   required
                                   placeholder="Enter your phone number"
                                   class="w-full px-4 py-3 bg-[#0f0f0f] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="bg-gradient-to-br from-[#1a1a1c] to-[#2a2a2c] rounded-xl border border-gray-800 p-6 mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" 
                               name="terms" 
                               required
                               class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-700 rounded bg-[#0f0f0f] mt-0.5">
                        <span class="ml-3 text-sm text-gray-300">
                            I agree to the <a href="{{ route('terms-of-service') }}" target="_blank" class="text-blue-400 hover:text-blue-300 underline">Terms of Service</a> and 
                            <a href="{{ route('privacy-policy') }}" target="_blank" class="text-blue-400 hover:text-blue-300 underline">Privacy Policy</a> *
                        </span>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        Download Quotation PDF
                    </button>
                    
                    <!-- Back Link -->
                    <div class="mt-4">
                        <a href="{{ route('checkout.index') }}" class="text-gray-400 hover:text-blue-400 text-sm transition-colors">
                            ← Back to options
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

