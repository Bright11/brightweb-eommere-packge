<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

if (!function_exists('serveFile')) {
    function serveFile($path, $contentType, $cacheTime = 3600) {
        if (!File::exists($path)) {
            abort(404);
        }

        $cacheKey = 'file_' . md5($path);
        $file = Cache::remember($cacheKey, $cacheTime, function () use ($path) {
            return File::get($path);
        });

        return response($file)
            ->header('Content-Type', $contentType)
            ->header('Cache-Control', 'public, max-age=' . $cacheTime);
    }
}
