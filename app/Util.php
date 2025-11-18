<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

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

    public static function formatNumberShort($number, $precision = 1)
    {
        if ($number < 900) {
            // 0 - 900
            $n_format = number_format($number, $precision);
            $suffix = '';
        } elseif ($number < 900000) {
            // 0.9k - 850k
            $n_format = number_format($number / 1000, $precision);
            $suffix = 'K';
        } elseif ($number < 900000000) {
            // 0.9m - 850m
            $n_format = number_format($number / 1000000, $precision);
            $suffix = 'M';
        } elseif ($number < 900000000000) {
            // 0.9b - 850b
            $n_format = number_format($number / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($number / 1000000000000, $precision);
            $suffix = 'T';
        }

        // Remove unnecessary zeros
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }

    public static function sendSMSMessage(string|array $phone, string $message): bool
    {
        try {
            $response = Http::withQueryParameters([
                'key' => config('app.mnotify_key'),
            ])->post(config('app.mnotify_base_url') . '/api/sms/quick', [
                'recipient' => is_array($phone) ? $phone : [$phone],
                'sender' => 'Tailorinhub',
                'message' => $message,
            ]);

            return $response->ok();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
