<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use App\Services\PerformanceCacheService;

class CacheController extends Controller
{
    /**
     * Show cache management page
     */
    public function index()
    {
        $cacheInfo = [
            'default_driver' => config('cache.default'),
            'cache_keys_count' => $this->getCacheKeysCount(),
        ];

        return view('admin.cache.index', compact('cacheInfo'));
    }

    /**
     * Clear all application cache
     */
    public function clearAll(Request $request)
    {
        try {
            // Clear Laravel application cache
            Artisan::call('cache:clear');
            
            // Clear view cache
            Artisan::call('view:clear');
            
            // Clear config cache
            Artisan::call('config:clear');
            
            // Clear route cache
            Artisan::call('route:clear');
            
            // Clear compiled classes
            Artisan::call('clear-compiled');
            
            // Clear performance cache service caches
            PerformanceCacheService::clearCategoryCaches();
            PerformanceCacheService::clearProductCaches();
            
            // Clear all cache using facade
            Cache::flush();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'All caches cleared successfully!'
                ]);
            }

            return redirect()->route('admin.cache.index')
                ->with('success', 'All caches cleared successfully!');
                
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error clearing cache: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.cache.index')
                ->with('error', 'Error clearing cache: ' . $e->getMessage());
        }
    }

    /**
     * Clear application cache only
     */
    public function clearApplication(Request $request)
    {
        try {
            Artisan::call('cache:clear');
            Cache::flush();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Application cache cleared successfully!'
                ]);
            }

            return redirect()->route('admin.cache.index')
                ->with('success', 'Application cache cleared successfully!');
                
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error clearing cache: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.cache.index')
                ->with('error', 'Error clearing cache: ' . $e->getMessage());
        }
    }

    /**
     * Clear view cache
     */
    public function clearViews(Request $request)
    {
        try {
            Artisan::call('view:clear');

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'View cache cleared successfully!'
                ]);
            }

            return redirect()->route('admin.cache.index')
                ->with('success', 'View cache cleared successfully!');
                
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error clearing view cache: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.cache.index')
                ->with('error', 'Error clearing view cache: ' . $e->getMessage());
        }
    }

    /**
     * Clear product and category caches
     */
    public function clearProductCaches(Request $request)
    {
        try {
            PerformanceCacheService::clearProductCaches();
            PerformanceCacheService::clearCategoryCaches();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product and category caches cleared successfully!'
                ]);
            }

            return redirect()->route('admin.cache.index')
                ->with('success', 'Product and category caches cleared successfully!');
                
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error clearing product caches: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.cache.index')
                ->with('error', 'Error clearing product caches: ' . $e->getMessage());
        }
    }

    /**
     * Warm up caches
     */
    public function warmUp(Request $request)
    {
        try {
            PerformanceCacheService::warmUpCaches();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Caches warmed up successfully!'
                ]);
            }

            return redirect()->route('admin.cache.index')
                ->with('success', 'Caches warmed up successfully!');
                
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error warming up caches: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.cache.index')
                ->with('error', 'Error warming up caches: ' . $e->getMessage());
        }
    }

    /**
     * Get approximate cache keys count
     */
    private function getCacheKeysCount()
    {
        try {
            $driver = config('cache.default');
            
            if ($driver === 'database') {
                return \DB::table('cache')->count();
            } elseif ($driver === 'file') {
                $cachePath = storage_path('framework/cache/data');
                if (is_dir($cachePath)) {
                    return count(glob($cachePath . '/*'));
                }
            }
            
            return 'N/A';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }
}

