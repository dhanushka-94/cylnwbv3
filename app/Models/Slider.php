<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'link_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the full URL for the slider image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }
        
        // Check if file exists
        if (!Storage::disk('public')->exists($this->image_path)) {
            return null;
        }
        
        // Use asset() for more reliable URL generation
        // This works better with both local and production environments
        return asset('storage/' . $this->image_path);
    }
    
    /**
     * Check if image exists
     */
    public function hasImage()
    {
        return $this->image_path && Storage::disk('public')->exists($this->image_path);
    }

    /**
     * Scope to get only active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order sliders by order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }
}
