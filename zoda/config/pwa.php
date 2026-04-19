<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Would you like the install button to appear on all pages?
      Set true/false
    |--------------------------------------------------------------------------
    */

    'install-button' => true,

    /*
    |--------------------------------------------------------------------------
    | PWA Manifest Configuration
    |--------------------------------------------------------------------------
    |  php artisan erag:update-manifest
    */

    'manifest' => [
        'name' => 'Readify.africa',
        'short_name' => 'LPT',
        'background_color' => '#6777ef',
        'display' => 'fullscreen',
        'description' => 'Earn free data with Readify.africa.',
        'theme_color' => '#6777ef',
        'icons' => [
            [
                'src' => '/images/icon-192.png', // Add 192x192 PNG to public/images/
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'maskable any', // For adaptive icons
            ],
            [
                'src' => '/images/icon-512.png', // 512x512 PNG
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'maskable any',
            ],
        ],
    ],

    'serviceWorker' => [
        'cache' => true, // Enables offline caching
        'themeColor' => '#3b82f6',
    ],

    /*
    |--------------------------------------------------------------------------
    | Debug Configuration
    |--------------------------------------------------------------------------
    | Toggles the application's debug mode based on the environment variable
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Livewire Integration
    |--------------------------------------------------------------------------
    | Set to true if you're using Livewire in your application to enable
    | Livewire-specific PWA optimizations or features.
    */

    'livewire-app' => false,
];
