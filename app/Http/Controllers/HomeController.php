<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmaProduct;
use App\Models\SmaCategory;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        // Get promotion products directly (bypassing cache for debugging)
        $promotionProducts = SmaProduct::active()
            ->select(['id', 'name', 'price', 'promo_price', 'quantity', 'category_id', 'subcategory_id', 'product_status', 'image', 'promotion'])
            ->where('promotion', 1)
            ->where('promo_price', '>', 0)
            ->where('quantity', '>', 0)
            ->with([
                'category:id,name,slug',
                'subcategory:id,name,slug',
                'photos:id,product_id,photo',
                'status:id,status_name'
            ])
            ->where(function($q) {
                $q->whereNull('start_date')
                  ->orWhereNull('end_date')
                  ->orWhere(function($dateQuery) {
                      $dateQuery->where('start_date', '<=', now())
                               ->where('end_date', '>=', now());
                  });
            })
            ->orderBy('id', 'DESC')
            ->orderByRaw('((price - promo_price) / price) DESC')
            ->orderByRaw("
                CASE 
                    WHEN quantity > 10 THEN 1 
                    WHEN quantity > 0 THEN 2 
                    ELSE 3 
                END ASC
            ")
            ->take(8)
            ->get();

        // Get cached categories (limited to 6 for homepage)
        $categories = \App\Services\PerformanceCacheService::getNavigationCategories()->take(6);

        // Get cached latest products
        $latestProducts = \App\Services\PerformanceCacheService::getLatestProducts(4);

        // Get active sliders ordered by display order
        $sliders = Slider::active()->ordered()->get();

        // Get all happy customer images from the folder
        $happyCustomerImages = [];
        $customerImagesPath = public_path('images/happy-customers');
        
        if (is_dir($customerImagesPath)) {
            $files = scandir($customerImagesPath);
            foreach ($files as $file) {
                // Only include .jpg and .jpeg files, exclude duplicates (prefer .jpg over .jpeg)
                if (preg_match('/\.(jpg|jpeg)$/i', $file)) {
                    // Skip .jpeg files if .jpg version exists
                    $baseName = pathinfo($file, PATHINFO_FILENAME);
                    $jpgFile = $baseName . '.jpg';
                    $jpegFile = $baseName . '.jpeg';
                    
                    // Only add if it's a .jpg file, or if it's a .jpeg and no .jpg exists
                    if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'jpg' || 
                        (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'jpeg' && !in_array($jpgFile, $files))) {
                        $happyCustomerImages[] = 'images/happy-customers/' . $file;
                    }
                }
            }
            
            // Sort images naturally (so hc00 (1).jpg comes before hc00 (10).jpg)
            natsort($happyCustomerImages);
            $happyCustomerImages = array_values($happyCustomerImages);
        }

        return view('home', compact('promotionProducts', 'categories', 'latestProducts', 'sliders', 'happyCustomerImages'));
    }
}
