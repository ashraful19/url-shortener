<?php
return [
    'google'=>[
        'apiKey' => env('GOOGLE_SAFE_BROWSING_API_KEY', 'AIzaSyDPfXNTJazyaPI6p44sCjT8B1xZL6TH-Tg'),
        'apiBaseUrl' => 'https://safebrowsing.googleapis.com/v4',
        'client' => [
            'clientId' => 'ashraful-safe-browsing',
            'clientVersion' => '1.0.0',
        ],
        'threatInfo' => [
            'threatTypes' => [
                'MALWARE',
                'SOCIAL_ENGINEERING',
                'UNWANTED_SOFTWARE',
                'POTENTIALLY_HARMFUL_APPLICATION',
                'THREAT_TYPE_UNSPECIFIED'
            ],
            'platformTypes' => ['ANY_PLATFORM'],
            'threatEntryTypes' => ['URL']
        ],
    ]
];
