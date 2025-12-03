<?php

if (!function_exists('asset_versioned')) {
    /**
     * Generate a versioned asset URL
     * 
     * @param string $path
     * @return string
     */
    function asset_versioned($path)
    {
        $version = config('assets.version', time());
        $assetUrl = asset($path);
        
        // Add version parameter
        $separator = strpos($assetUrl, '?') !== false ? '&' : '?';
        return $assetUrl . $separator . 'v=' . $version;
    }
}

