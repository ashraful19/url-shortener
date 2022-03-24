<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Facades\App\Services\UrlService; //it is a service class with realtime facade implementation
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function shorten(UrlShortenRequest $request){
        $url = UrlService::getUrlIfExists($request->input('long_url'));
        if(!$url){
            $url = UrlService::createShortUrl($request->input('long_url'));
        }
        return new UrlResource($url);
    }
}
