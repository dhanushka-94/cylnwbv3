@extends('layouts.app')

@section('title', 'Contact Us - Ceylon IT Solutions | Get Expert Computer Support')
@section('description', 'Contact Ceylon IT Solutions for all your computer needs. Expert sales, repairs, and technical support across our branches in Sri Lanka and UAE.')
@section('keywords', 'contact Ceylon IT Solutions, computer repair Sri Lanka, technical support, computer sales, Embilipitiya computer shop')

@section('content')
<!-- Hero Section -->
<section class="py-16 bg-gradient-to-b from-black to-[#0f0f0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-[#f59e0b]/10 border border-[#f59e0b]/20 rounded-lg text-[#f59e0b] text-sm font-medium mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Get In Touch
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Contact <span class="text-[#f59e0b]">Ceylon IT Solutions</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-8">
                Reach our branches in Sharjah, Embilipitiya, and Kandy for sales, repairs, and expert technical support.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://wa.me/{{ config('bank.whatsapp_payment_number') }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center px-6 py-3 rounded-lg bg-green-500 text-black font-semibold text-sm shadow-lg hover:bg-green-400 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.726"/>
                    </svg>
                    WhatsApp: {{ config('bank.whatsapp_payment_display') }}
                </a>
                <a href="mailto:info@ceylonitsolutions.com"
                   class="inline-flex items-center px-6 py-3 rounded-lg border border-gray-600 text-gray-100 font-semibold text-sm hover:border-[#f59e0b] hover:text-[#f59e0b] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    info@ceylonitsolutions.com
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16 bg-[#0f0f0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- 3000+ Products -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-[#f59e0b] mb-2">3000+</h3>
                <p class="text-white font-semibold">Products</p>
            </div>

            <!-- 10,000+ Happy Customers -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-[#f59e0b] mb-2">10,000+</h3>
                <p class="text-white font-semibold">Happy Customers</p>
            </div>

            <!-- Expert Support -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-purple-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Expert</h3>
                <p class="text-white font-semibold">Support Available</p>
            </div>

            <!-- Best Warranty -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Best</h3>
                <p class="text-white font-semibold">Warranty</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Store Info Section -->
<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h2 class="text-3xl font-bold text-white mb-8">Send Us a Message</h2>
                
                <form class="space-y-6">
                    <!-- First & Last Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="John" 
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Doe" 
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent transition-all duration-300">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="john@example.com" 
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="+94 XXX XXX XXX" 
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent transition-all duration-300">
                    </div>

                    <!-- Service Type -->
                    <div>
                        <label for="service_type" class="block text-sm font-medium text-gray-300 mb-2">Service Type</label>
                        <select id="service_type" name="service_type" 
                                class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent transition-all duration-300">
                            <option value="" class="text-gray-400">Select a service...</option>
                            <option value="laptop_sales" class="text-white">Laptop Sales</option>
                            <option value="desktop_pcs" class="text-white">Desktop PCs</option>
                            <option value="computer_repair" class="text-white">Computer Repair</option>
                            <option value="data_recovery" class="text-white">Data Recovery</option>
                            <option value="upgrades" class="text-white">Upgrades</option>
                            <option value="technical_support" class="text-white">Technical Support</option>
                            <option value="warranty_service" class="text-white">Warranty Service</option>
                            <option value="custom_builds" class="text-white">Custom Builds</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tell us how we can help you..." 
                                  class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent transition-all duration-300 resize-vertical"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-[#f59e0b] text-black font-bold py-4 px-6 rounded-lg hover:bg-[#d97706] transition-colors duration-300 transform hover:scale-[1.02]">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Send Message
                        </span>
                    </button>
                </form>
            </div>

            <!-- Our Branches -->
            <div class="space-y-10">
                <h2 class="text-3xl font-bold text-white mb-2">Our Branches</h2>
                <p class="text-sm text-gray-400 mb-4">Visit or contact any of our branches in the UAE and Sri Lanka.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Sharjah – UAE -->
                    <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6">
                        <div class="w-12 h-12 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center flex-shrink-0 mb-4">
                            <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Sharjah – UAE</h3>
                        <p class="text-gray-300 text-sm mb-3">
                            Shubra No.18–19, Maleha St,<br>
                            Behind Souk Al Mubarak, Ind. Area 5, Sharjah
                        </p>
                        <p class="text-gray-400 text-sm">Mobile / WhatsApp: <a href="https://wa.me/{{ config('bank.whatsapp_payment_number') }}" target="_blank" rel="noopener noreferrer" class="text-[#f59e0b] hover:underline">{{ config('bank.whatsapp_payment_display') }}</a></p>
                    </div>
                    <!-- Embilipitiya – Sri Lanka -->
                    <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6">
                        <div class="w-12 h-12 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center flex-shrink-0 mb-4">
                            <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Embilipitiya – Sri Lanka</h3>
                        <p class="text-gray-300 text-sm mb-3">
                            No. 74, Main Street, Pallegama, Embilipitiya
                        </p>
                        <p class="text-gray-400 text-sm">Tel: +94 47 223 0429 · Mobile / WhatsApp: <a href="https://wa.me/94741847422" target="_blank" rel="noopener noreferrer" class="text-[#f59e0b] hover:underline">+94 74 184 7422</a></p>
                    </div>
                    <!-- Kandy – Sri Lanka -->
                    <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6">
                        <div class="w-12 h-12 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center flex-shrink-0 mb-4">
                            <svg class="w-6 h-6 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Kandy – Sri Lanka</h3>
                        <p class="text-gray-300 text-sm mb-3">
                            No. 9A, Danthure Road, Pilimathalawa, Kandy
                        </p>
                        <p class="text-gray-400 text-sm">Mobile / WhatsApp: <a href="https://wa.me/{{ config('bank.whatsapp_payment_number') }}" target="_blank" rel="noopener noreferrer" class="text-[#f59e0b] hover:underline">{{ config('bank.whatsapp_payment_display') }}</a></p>
                    </div>
                </div>
                <!-- Email (shared) -->
                <div class="flex items-start space-x-4 mt-6">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-semibold mb-1">info@ceylonitsolutions.com</p>
                        <p class="text-gray-400 text-sm">Expert support – all branches</p>
                    </div>
                </div>
            </div>

            <!-- Business Hours (per branch) -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-white mb-6">Business Hours</h3>
                <div class="space-y-4 text-sm text-gray-300">
                    <div>
                        <span class="font-semibold text-white">Sharjah – UAE:</span>
                        <span class="text-[#f59e0b] font-semibold"> 11.00 AM – 11.00 PM</span>
                        <span class="text-gray-400"> (GMT+4:00 Dubai)</span>
                    </div>
                    <div>
                        <span class="font-semibold text-white">Embilipitiya – LK:</span>
                        <span class="text-[#f59e0b] font-semibold"> 09.00 AM – 06.00 PM</span>
                        <span class="text-gray-400"> (GMT+5:30 Colombo)</span>
                    </div>
                    <div>
                        <span class="font-semibold text-white">Kandy – LK:</span>
                        <span class="text-[#f59e0b] font-semibold"> 09.00 AM – 06.00 PM</span>
                        <span class="text-gray-400"> (GMT+5:30 Colombo)</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section class="py-16 bg-[#0f0f0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Our Services</h2>
            <p class="text-lg text-gray-400">Complete computer solutions for all your needs</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Laptop Sales -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Laptop Sales</h3>
                <p class="text-gray-400 text-sm">Latest laptops from top brands</p>
            </div>

            <!-- Desktop PCs -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Desktop PCs</h3>
                <p class="text-gray-400 text-sm">Custom and pre-built desktop solutions</p>
            </div>

            <!-- Computer Repair -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-purple-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Computer Repair</h3>
                <p class="text-gray-400 text-sm">Professional repair services</p>
            </div>

            <!-- Data Recovery -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Data Recovery</h3>
                <p class="text-gray-400 text-sm">Recover lost data safely</p>
            </div>

            <!-- Upgrades -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-red-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Upgrades</h3>
                <p class="text-gray-400 text-sm">Hardware upgrades and improvements</p>
            </div>

            <!-- Technical Support -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-indigo-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Technical Support</h3>
                <p class="text-gray-400 text-sm">Expert technical assistance</p>
            </div>

            <!-- Warranty Service -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-yellow-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Warranty Service</h3>
                <p class="text-gray-400 text-sm">Comprehensive warranty support</p>
            </div>

            <!-- Custom Builds -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300 group">
                <div class="w-16 h-16 bg-pink-500/20 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Custom Builds</h3>
                <p class="text-gray-400 text-sm">Tailored PC builds for your needs</p>
            </div>
        </div>
    </div>
</section>

@endsection
