<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Get a properly formatted URL for a file stored in the public disk
     *
     * @param string|null $path
     * @return string|null
     */
    public static function getFileUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // Remove any /storage/ prefix if it exists
        $cleanPath = str_replace('/storage/', '', $path);

        // Also handle Windows path issues by normalizing slashes
        $cleanPath = str_replace('\\', '/', $cleanPath);

        // Generate the public URL
        return url('storage/' . $cleanPath);
    }
}
