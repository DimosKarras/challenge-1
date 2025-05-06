<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UrlShortener extends Model
{
    protected $fillable = ['original_url', 'short_code'];

    /**
     * Generate unique code for URL shortener.
     * @return string
     */
    public static function generateUniqueCode(): string
    {
        do {
            $uniqueCode = Str::random(8);
        } while (self::query()->where('short_code', $uniqueCode)->exists());

        return $uniqueCode;
    }
}
