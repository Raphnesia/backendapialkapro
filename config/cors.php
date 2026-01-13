<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',           // Development
<<<<<<< HEAD
        'https://alkapro.id',         // Production Frontend
=======
        'https://raphnesia.my.id',         // Production Frontend
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
        'https://*.vercel.app',            // Vercel preview
        'https://vercel.app',              // Vercel main
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];