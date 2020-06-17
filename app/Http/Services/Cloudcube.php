<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class Cloudcube
{
    /**
     * @param string $dir
     * @return array
     */
    public static function files($dir = '/public'): array
    {
        $bucket_path = \Config::get('filesystems.disks.s3.bucket_path');
        return Storage::disk('s3')->files($bucket_path. $dir);
    }
}
