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

        return view('home', compact('promotionProducts', 'categories', 'latestProducts', 'sliders'));
    }
}
