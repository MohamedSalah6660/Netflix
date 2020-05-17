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

'facebook' => [
    'client_id' => '288422148984125',
    'client_secret' => 'f2925991dc9ba5dcbf9fdcfdb2002fca',
    'redirect' => 'http://localhost:8000/callback/facebook'
    ],

    'google' => [
    'client_id' => '496370166236-j8ceoavdpgvnt9o9n5pgf4m0emmnqcsp.apps.googleusercontent.com',
    'client_secret' => 't5rRpzmK-YrYoDY1TvytdSh7',
    'redirect' => 'http://localhost:8000/callback/google'
    ],
];
