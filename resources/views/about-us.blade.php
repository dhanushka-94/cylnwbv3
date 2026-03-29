@extends('layouts.app')

@section('title', 'About Us - Ceylon IT Solutions (CITS)')
@section('description', 'Vision, goal, mission, brand positioning and group purpose of Ceylon IT Solutions (CITS).')
@section('keywords', 'about Ceylon IT Solutions, computer company Sri Lanka, warranty, delivery service, after sales service, computer retailer')

@section('content')
<!-- Hero Section -->
<section class="py-16 bg-gradient-to-b from-black to-[#0f0f0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-[#f59e0b]/10 border border-[#f59e0b]/20 rounded-lg text-[#f59e0b] text-sm font-medium mb-6">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                About Our Company
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                About <span class="text-[#f59e0b]">Ceylon IT Solutions</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                Ceylon IT Solutions (CITS) — strategy, purpose, and commitment to our stakeholders and markets.
            </p>
        </div>
    </div>
</section>

<!-- Vision, Goal, Mission, Brand Positioning & Group Purpose -->
<section class="py-16 bg-[#0f0f0f]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">Ceylon IT Solutions (CITS)</h2>
            <p class="text-gray-400">Strategy, purpose &amp; brand</p>
        </div>
        <div class="space-y-8">
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h3 class="text-lg font-semibold text-blue-400 mb-4">Vision</h3>
                <p class="text-gray-300 leading-relaxed">CITS's strategy will focus on achieving profitable growth and attractive returns to our stakeholders, while managing the transition from a very successful past and adapting to the new IT industry needs and market changes.</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h3 class="text-lg font-semibold text-[#f59e0b] mb-4">Goal</h3>
                <p class="text-gray-300 leading-relaxed">To be a reputable and well-respected brand to our Stakeholders while evolving as one of the most efficient provider of IT solutions in our chosen markets.</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h3 class="text-lg font-semibold text-green-400 mb-4">Mission</h3>
                <p class="text-gray-300 leading-relaxed">To create long-term value for all our stakeholders</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h3 class="text-lg font-semibold text-purple-400 mb-4">Brand Positioning</h3>
                <p class="text-gray-300 leading-relaxed text-lg tracking-wide">Superior Quality <span class="text-gray-600">|</span> Lasting Value <span class="text-gray-600">|</span> Tested &amp; Trusted</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <h3 class="text-lg font-semibold text-cyan-400 mb-4">Group Purpose</h3>
                <p class="text-gray-300 leading-relaxed">To drive change for a better world</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 bg-black">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Our Story</h2>
        <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
            <p class="text-gray-300 text-lg leading-relaxed">
                Ceylon IT Solutions (CITS) has grown from a small shop into one of Sri Lanka's most trusted computer retailers. We proudly serve students, professionals, businesses, and government institutions with quality products, competitive pricing, and exceptional customer service. Staying ahead with the latest technology, we remain committed to our core values of trust, quality, and customer satisfaction.
            </p>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-[#0f0f0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Why Choose Ceylon IT Solutions</h2>
            <p class="text-lg text-gray-400">Trusted expertise and exceptional service that sets us apart</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- 3000+ Products -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#f59e0b] mb-2">3000+</h3>
                <h4 class="text-lg font-semibold text-white mb-2">Products Available</h4>
                <p class="text-gray-400 text-sm">Trusted expertise in computer sales and service</p>
            </div>

            <!-- 10,000+ Customers -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#f59e0b] mb-2">10,000+</h3>
                <h4 class="text-lg font-semibold text-white mb-2">Customers</h4>
                <p class="text-gray-400 text-sm">Serving satisfied customers across Sri Lanka</p>
            </div>

            <!-- Quality Products -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-purple-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Quality Products</h3>
                <p class="text-gray-400 text-sm">Genuine products with full warranty coverage</p>
            </div>

            <!-- Expert Support -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center hover:border-[#f59e0b]/30 transition-all duration-300">
                <div class="w-16 h-16 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Expert Support</h3>
                <p class="text-gray-400 text-sm">Professional after-sales service and support</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Branches Section -->
<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Our Branches</h2>
            <p class="text-lg text-gray-400">Visit us at any of our locations in Sri Lanka and the UAE</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-bold text-[#f59e0b] mb-3">Sharjah – United Arab Emirates</h3>
                <p class="text-gray-300 text-sm mb-2">Shubra No.18–19, Maleha Street, Behind Souk Al Mubarak Hypermarket, Industrial Area 5, Sharjah, UAE</p>
                <p class="text-gray-400 text-sm">Mobile / WhatsApp: +971 58 181 1579</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-bold text-[#f59e0b] mb-3">Embilipitiya – Sri Lanka</h3>
                <p class="text-gray-300 text-sm mb-2">No. 74, Main Street, Pallegama, Embilipitiya</p>
                <p class="text-gray-400 text-sm">Tel: +94 47 223 0429</p>
                <p class="text-gray-400 text-sm">Mobile / WhatsApp: +94 74 184 7422</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-bold text-[#f59e0b] mb-3">Kandy Branch – Sri Lanka</h3>
                <p class="text-gray-300 text-sm mb-2">No. 9A, Danthure Road, Pilimathalawa, Kandy</p>
                <p class="text-gray-400 text-sm">Mobile / WhatsApp: {{ config('bank.whatsapp_payment_display') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Warranty Section -->
<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">වගකීම් සහතිකය හා අදාළ කොන්දේසි</h2>
            <h3 class="text-2xl font-semibold text-gray-400 mb-4">Warranty Certificate and Related Terms</h3>
            <p class="text-lg text-gray-400">Comprehensive warranty coverage with clear terms and conditions for your peace of mind.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Bill Required -->
            <div class="bg-[#1a1a1c] border border-red-500/30 rounded-xl p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-red-400">Bill Required</h3>
                </div>
                <p class="text-gray-300 text-sm mb-2">වගකීම ලබාදීම සඳහා බිල්පත අනිවාර්යයෙන් ඉදිරිපත් කළ යුතුය</p>
                <p class="text-gray-400 text-sm">The bill must be submitted to provide warranty coverage</p>
            </div>

            <!-- Manufacturing Defects Only -->
            <div class="bg-[#1a1a1c] border border-orange-500/30 rounded-xl p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.316 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-orange-400">Manufacturing Defects Only</h3>
                </div>
                <p class="text-gray-300 text-sm mb-2">නිෂ්පාදිත දෝෂ සඳහා පමණක් වගකීම හිමි වේ</p>
                <p class="text-gray-400 text-sm">Warranty covers manufacturing defects only</p>
            </div>

            <!-- Processing Time -->
            <div class="bg-[#1a1a1c] border border-blue-500/30 rounded-xl p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-blue-400">Processing Time</h3>
                </div>
                <p class="text-gray-300 text-sm mb-2">Brand new අයිතම සඳහා warranty ලබා ගැනීමේදී දින 10 ත් දින 30ත් අතර කාලයක් ගතවනු ඇත</p>
                <p class="text-gray-400 text-sm">Brand new items: 10-30 days processing time</p>
            </div>
        </div>

        <!-- Warranty Periods -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <h3 class="text-2xl font-bold text-[#f59e0b] mb-2">1 Year</h3>
                <p class="text-gray-400">350 days</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <h3 class="text-2xl font-bold text-[#f59e0b] mb-2">2 Years</h3>
                <p class="text-gray-400">700 days</p>
            </div>
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <h3 class="text-2xl font-bold text-[#f59e0b] mb-2">3 Years</h3>
                <p class="text-gray-400">1050 days</p>
            </div>
        </div>

        <!-- Warranty Exclusions -->
        <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
            <h3 class="text-2xl font-bold text-white mb-6">Warranty Exclusions</h3>
            <p class="text-gray-300 mb-6">This warranty certificate does not cover the following types of damage:</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Burn marks (පිළිස්සුණු ලකුණු)</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Physical damage marks (පෑස්සූ ලකුණු)</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Rust damage (මලකඩ කෑම)</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Scratch marks (සීරීම් ලකුණු)</span>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Lightning damage (අකුණු වලින් සිදුවී ඇති හානි)</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Liquid spills (ආහාර හෝ බීම වර්ග හැලීමෙන් සිදුවන හානි)</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">User error damage (පරිගණක දැනුමක් නැති අය සිදුකරන වැරදි)</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                        <span class="text-gray-300 text-sm">Natural disasters (ස්වාභාවික විපත් වැනි හානි)</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                <p class="text-red-400 font-medium text-sm">
                    <strong>Important:</strong> If the warranty label is deleted or damaged, the warranty becomes void. No refunds will be given for purchased items.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Delivery Service Section -->
<section class="py-16 bg-[#0f0f0f]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Delivery කරනු ලබන ආයතනයේ විස්තර</h2>
            <h3 class="text-2xl font-semibold text-gray-400 mb-4">Delivery Service Details</h3>
            <p class="text-lg text-gray-400">Professional courier services through Prompt Xpress with island-wide coverage.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Prompt Xpress -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-3">Prompt Xpress Courier</h3>
                <p class="text-gray-400 text-sm mb-2">අප ඔබ වෙත courier කරන items එවනු ලබන්නේ Prompt Xpress courier සේවාව මඟින් පමණි</p>
                <p class="text-gray-500 text-xs">All items are sent through Prompt Xpress courier service only</p>
            </div>

            <!-- Island-wide Coverage -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-3">Island-wide Coverage</h3>
                <p class="text-gray-400 text-sm mb-2">එය ලංකාව පුරා විහිදී පවතින ශාඛා 55 කින් සහ සියලුම නගර ආවරණය වන පරිදි ක්‍රියාත්මක වේ</p>
                <p class="text-gray-500 text-xs">55 branches across Sri Lanka covering all cities</p>
            </div>

            <!-- Delivery Time -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-[#f59e0b]/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#f59e0b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-3">Delivery Time</h3>
                <p class="text-gray-400 text-sm mb-2">Courier සේවාව හරහා භාණ්ඩයක් ලබා ගැනීමේදී එය ඔබ අතට පත් වීමට පැය 24 ත් 48 ත් අතර කාලයක් ගත වේ</p>
                <p class="text-gray-500 text-xs">24-48 hours delivery time for courier services</p>
            </div>

            <!-- Damage Protection -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-purple-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-3">Damage Protection</h3>
                <p class="text-gray-400 text-sm mb-2">Courier එක මඟින් භාණ්ඩ එවීමේදී යම් හානියක් සිදුවුවහොත් වගකීම අප විසින් දරනු ලබයි</p>
                <p class="text-gray-500 text-xs">We take responsibility for any courier damage</p>
            </div>
        </div>
        
        <div class="mt-8 p-4 bg-gray-800/30 border border-gray-700 rounded-lg text-center">
            <p class="text-gray-400 text-sm">
                <strong>Note:</strong> Courier services are not active on weekends (Saturday/Sunday).
            </p>
        </div>
    </div>
</section>

<!-- After Sales Service Section -->
<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">අලෙවියෙන් පසු සේවාව</h2>
            <h3 class="text-2xl font-semibold text-gray-400 mb-4">After Sales Service</h3>
            <p class="text-lg text-gray-400">Comprehensive after-sales support with multiple service options for your convenience.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- In-Store Service -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">In-Store Service</h3>
                </div>
                
                <div class="space-y-4">
                    <p class="text-gray-300">ඔබ shop එකට පැමිණිය හැකි දුරකින් නම්, එය අප වෙත රැගෙන එමින් සේවාව ගත හැක</p>
                    <p class="text-gray-400 text-sm">If you are within distance to visit the shop, bring your device for service</p>
                    
                    <div class="mt-6 p-4 bg-orange-500/10 border border-orange-500/30 rounded-lg">
                        <p class="text-orange-400 font-medium text-sm">
                            Warranty machines arriving after 4 PM cannot be serviced same day
                        </p>
                        <p class="text-orange-300 text-xs mt-1">
                            සවස 4න් පසු පැමිණෙන warranty machine සඳහා එදිනම warranty ලබා ගැනීමට නොහැකි
                        </p>
                    </div>
                </div>
            </div>

            <!-- Courier Service -->
            <div class="bg-[#1a1a1c] border border-gray-800 rounded-xl p-8">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Courier Service</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="text-white font-medium mb-2">Send to (Sri Lanka branches for warranty / service):</h4>
                        <div class="text-gray-300 text-sm space-y-3">
                            <div>
                                <p><strong>Embilipitiya Branch</strong></p>
                                <p>No. 74, Main Street, Pallegama, Embilipitiya</p>
                                <p>+94 47 223 0429 / +94 74 184 7422</p>
                            </div>
                            <div>
                                <p><strong>Kandy Branch</strong></p>
                                <p>No. 9A, Danthure Road, Pilimathalawa, Kandy</p>
                                <p>{{ config('bank.whatsapp_payment_display') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg">
                        <p class="text-blue-400 text-sm mb-2">බිල්පත සහ warranty අයිතමය එවිය යුතුය</p>
                        <p class="text-blue-300 text-xs">Include bill and warranty item when sending items for warranty or service.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
