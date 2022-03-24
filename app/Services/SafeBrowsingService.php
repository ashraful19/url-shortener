<?php

namespace App\Services;

use Facades\App\Services\UrlService;
use Illuminate\Support\Facades\Http;

class SafeBrowsingService
{
    protected $apiBaseUrl;
    protected $apiKey;
    protected $clientId;
    protected $clientVersion;
    protected $threatTypes;
    protected $platformTypes;
    protected $entryTypes;

    public function __construct()
    {
        $this->apiBaseUrl = config('safe-browsing.google.apiBaseUrl');
        $this->apiKey = config('safe-browsing.google.apiKey');
        $this->clientId = config('safe-browsing.google.client.clientId');
        $this->clientVersion = config('safe-browsing.google.client.clientVersion');
        $this->threatTypes = config('safe-browsing.google.threatInfo.threatTypes');
        $this->platformTypes = config('safe-browsing.google.threatInfo.platformTypes');
        $this->entryTypes = config('safe-browsing.google.threatInfo.threatEntryTypes');
    }

    public function isSafe($url): bool
    {
        $response = $this->getApiResponse($url);
        if ($response && !empty($response['matches'])) {
            return false;
        }

        return true;
    }

    private function getApiResponse($url): array
    {
        $apiCallUrl = $this->apiBaseUrl."/threatMatches:find?key=".$this->apiKey;
        $apiCallData = [
            'client' => [
                'clientId' => $this->clientId,
                'clientVersion' => $this->clientVersion,
            ],
            'threatInfo' => [
                'threatTypes' => $this->threatTypes,
                'platformTypes' => $this->platformTypes,
                'threatEntryTypes' => $this->entryTypes,
                'threatEntries' => [
                    [
                        'url' => UrlService::formateUrl($url),
                    ],
                    [
                        'url' => UrlService::formateUrl($url).'/', //because google sometimes give different result for same url with and without trailing slash
                    ],
                ],
            ],
        ];
        $response = Http::post($apiCallUrl, $apiCallData);
        if ($response->failed()) {
            throw new \Exception($response->json('error.message'));
        }

        return $response->json();
    }
}
