<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Url;
use Illuminate\Validation\ValidationException;

class UrlService
{
    private $maxCodeGenerateAttempt;
    private $shortCodeLength;

    public function __construct()
    {
        $this->maxCodeGenerateAttempt = config('url-shortening.maxCodeGenerateAttempt', 10);
        $this->shortCodeLength = config('url-shortening.shortCodeLength', 6);
    }

    public function getUrlIfExists($longUrl): ?Url
    {
        $record = Url::where('long_url', $this->formateUrl($longUrl))->whereNotNull('short_code')->first();
        return $record;
    }

    public function createShortUrl($longUrl): ?Url
    {
        $record = Url::create([
            'long_url' => $this->formateUrl($longUrl),
            'short_code' => $this->generateUniqueCode()
        ]);
        return $record;
    }

    private function generateUniqueCode(): string
    {
        $maxAttempts = $this->maxCodeGenerateAttempt;
        while ($maxAttempts-- > 0) {
            $code = Str::random($this->shortCodeLength);

            if (!Url::whereShortCode($code)->exists()) {
                return $code;
            }
        }

        throw ValidationException::withMessages([
            'short_code' => 'A unique short code cannot be generated. Please try again.',
        ]);
    }

    public function formateUrl($rawUrl): string
    {
        return rtrim(trim($rawUrl), '/');
    }
}
