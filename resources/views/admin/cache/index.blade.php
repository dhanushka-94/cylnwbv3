@extends('admin.layout')

@section('title', 'Cache Management')

@section('content')
<div class="space-y-8">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Cache Management</h1>
            <p class="text-gray-400">Clear application caches to ensure customers see the latest updates immediately</p>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-500/20 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Cache Information Card -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Cache Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-400 mb-1">Cache Driver</p>
                <p class="text-white font-medium">{{ ucfirst($cacheInfo['default_driver']) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Cache Keys</p>
                <p class="text-white font-medium">{{ $cacheInfo['cache_keys_count'] }}</p>
            </div>
        </div>
    </div>

    <!-- Cache Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Clear All Cache -->
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 hover:border-[#f59e0b]/50 transition-colors">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-red-500/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-white mb-2">Clear All Cache</h3>
            <p class="text-sm text-gray-400 mb-4">Clears all application, view, config, route, and product caches. Use this when you want to ensure customers see all latest updates.</p>
            <form action="{{ route('admin.cache.clear-all') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear ALL caches? This action cannot be undone.');">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Clear All Cache
                </button>
            </form>
        </div>

        <!-- Clear Application Cache -->
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 hover:border-[#f59e0b]/50 transition-colors">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-yellow-500/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-white mb-2">Clear Application Cache</h3>
            <p class="text-sm text-gray-400 mb-4">Clears only the application cache (database/file cache). Faster than clearing all caches.</p>
            <form action="{{ route('admin.cache.clear-application') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Clear Application Cache
                </button>
            </form>
        </div>

        <!-- Clear View Cache -->
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 hover:border-[#f59e0b]/50 transition-colors">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-blue-500/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-white mb-2">Clear View Cache</h3>
            <p class="text-sm text-gray-400 mb-4">Clears compiled Blade view templates. Use this when you've updated view files.</p>
            <form action="{{ route('admin.cache.clear-views') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Clear View Cache
                </button>
            </form>
        </div>

        <!-- Clear Product & Category Cache -->
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 hover:border-[#f59e0b]/50 transition-colors">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-green-500/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-white mb-2">Clear Product & Category Cache</h3>
            <p class="text-sm text-gray-400 mb-4">Clears cached product and category data. Use this when you've updated products or categories.</p>
            <form action="{{ route('admin.cache.clear-products') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Clear Product Cache
                </button>
            </form>
        </div>

        <!-- Warm Up Cache -->
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 hover:border-[#f59e0b]/50 transition-colors">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-purple-500/20 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-white mb-2">Warm Up Cache</h3>
            <p class="text-sm text-gray-400 mb-4">Pre-loads frequently accessed data into cache for better performance.</p>
            <form action="{{ route('admin.cache.warm-up') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Warm Up Cache
                </button>
            </form>
        </div>

    </div>

    <!-- Important Notes -->
    <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-yellow-400 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Important Notes
        </h3>
        <ul class="space-y-2 text-sm text-gray-300">
            <li class="flex items-start">
                <span class="text-yellow-400 mr-2">•</span>
                <span><strong>Clear All Cache</strong> is recommended when you've made significant updates and want customers to see changes immediately.</span>
            </li>
            <li class="flex items-start">
                <span class="text-yellow-400 mr-2">•</span>
                <span><strong>Clear Product & Category Cache</strong> should be used after updating products, prices, or categories.</span>
            </li>
            <li class="flex items-start">
                <span class="text-yellow-400 mr-2">•</span>
                <span>After clearing cache, the first page load may be slightly slower as caches are rebuilt.</span>
            </li>
            <li class="flex items-start">
                <span class="text-yellow-400 mr-2">•</span>
                <span>HTTP cache headers (browser cache) are set to 30 minutes for regular pages. Customers may need to do a hard refresh (Ctrl+F5) to see changes immediately.</span>
            </li>
        </ul>
    </div>

</div>
@endsection

