<?php

namespace App\Support;

class AssetVersion
{
    public static function url(string $path): string
    {
        $normalizedPath = ltrim($path, '/');
        $fullPath = public_path($normalizedPath);
        $version = file_exists($fullPath) ? filemtime($fullPath) : config('app.version', '1');

        return asset($normalizedPath) . '?v=' . $version;
    }
}
