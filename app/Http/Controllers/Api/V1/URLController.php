<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortenUrlRequest;
use App\Http\Resources\UrlResource;
use App\Services\URLShortenerService;
use Illuminate\Http\Request;

class URLController extends Controller
{
    private URLShortenerService $urlShortenerService;

    public function __construct(URLShortenerService $urlShortenerService){
        $this->urlShortenerService = $urlShortenerService;
    }

    public function shorten(ShortenUrlRequest $request){
        $shortUrl = $this->urlShortenerService->shorten($request->long_url, $request->user()->id);
        return response()->json([
            'short_url' => url($shortUrl)
        ], 201);
    }

    public function index(Request $request){
        $urls = $request->user()->urls;
        return UrlResource::collection($urls);
    }

    public function redirect($shortUrl){
        $longUrl = $this->urlShortenerService->incrementVisitCount($shortUrl);
        return redirect($longUrl);
    }
}
