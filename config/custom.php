<?php

return [
    'api' => [
        'hotels' => [
            'host'     => env('RAPIDAPI_HOTEL_HOST'),
            'key'      => env('RAPIDAPI_HOTEL_KEY'),
            'url'      => env('RAPIDAPI_LOCATIONS_SEARCH_URL'),
            'locale'   => env('RAPIDAPI_LOCALE', 'en_US'),
            'currency' => env('RAPIDAPI_CURRENCY', 'USD')
        ],
        'weather' => [
            'url'   => env('OPENWEATHERMAP_API_URL'),
            'key'   => env('OPENWEATHERMAP_API_KEY'),
            'city'  => env('OPENWEATHERMAP_CITY', 'Kyiv'),
            'units' => env('OPENWEATHERMAP_API_UNITS', 'metric')
        ]
    ]
];
