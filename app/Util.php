<?php

namespace App;

use Illuminate\Support\Facades\Crypt;

trait Util
{
    public static function uploadSingleImage($file, $directory = 'images'): string
    {
        if (config('app.env') == 'local') {
            return 'storage/' . $file->store(path: $directory);
        } else {
            return 'storage/app/public/' . $file->store(path: $directory);
        }
    }

    public static function uploadMultipleImages($files, $directory = 'images'): string
    {
        $paths = [];
        foreach ($files as $file) {
            if (config('app.env') == 'local') {
                $paths[] = 'storage/' . $file->store(path: $directory);
            } else {
                $paths[] = 'storage/app/public/' . $file->store(path: $directory);

            }
        }
        return implode('|', $paths);
    }

    public static function extractOriginalFilePath(string $filePath): string
    {
        if (config('app.env') == 'local') {
            return str_replace('storage/', '', $filePath);
        } else {
            return str_replace('storage/app/public/', '', $filePath);
        }
    }

    public static function encrypt(int | string $id): string
    {
        return Crypt::encryptString($id);
    }

    public static function decrypt(string $id): string
    {
        return Crypt::decryptString($id);
    }
}
