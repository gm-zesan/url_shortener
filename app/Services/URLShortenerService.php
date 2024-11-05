<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;

class URLShortenerService
{
    public function shorten($longUrl, $userId)
    {
        $existingUrl = Url::where('long_url', $longUrl)->where('user_id', $userId)->first();
        if ($existingUrl) {
            return $existingUrl->short_url;
        }
        do {
            $shortUrl = Str::random(6);
        } while (Url::where('short_url', $shortUrl)->exists());

        $url = Url::create([
            'user_id' => $userId,
            'long_url' => $longUrl,
            'short_url' => $shortUrl,
        ]);
        return $shortUrl;
    }

    public function incrementVisitCount($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->firstOrFail();
        $url->increment('visit_count');
        return $url->long_url;
    }
}