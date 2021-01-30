<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google_recaptcha' => [
        'site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY', '6LcsEtwZAAAAAOmSuITiYYopAEDMOhZInS5SEH5J'),
        'secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY', '6LcsEtwZAAAAAOBHp2tcwMsRKg7Q1ekHHob7DYZH'),
    ],
    "blocknomis" => [
        'api_key' => env('BLOCKNOMIS_API_KEY', 'BqviSvjg91LN5xL5HMP7ltW68gCG4zdFUmpRhIsU50A'),
    ],
    "pusher" => [
        "set_01" => [],
        "set_02" => []

    ],

    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY', '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'),
        'api_key_2' => env('SENDGRID_API_KEY_2', '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'),
    ],
    'etherscan' => [
        'api_key' => env('ETHERSCAN_APIKEY', 'ICGZKFFZ4C5JF39C5VQGPDQH57CQYD138S'),
    ]

];
