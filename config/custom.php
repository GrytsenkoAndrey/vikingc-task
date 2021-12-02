<?php

return [
    'api' => [
        'weather' => [
            'url'   => env('OPENWEATHERMAP_API_URL'),
            'key'   => env('OPENWEATHERMAP_API_KEY'),
            'city'  => env('OPENWEATHERMAP_CITY', 'Kyiv'),
            'units' => env('OPENWEATHERMAP_API_UNITS', 'metric')
        ],
        'rapidapi' => [
            'key'      => env('RAPIDAPI_KEY'),
            'hotels' => [
                'host'     => env('RAPIDAPI_HOTEL_HOST'),
                'url'      => env('RAPIDAPI_HOTEL_SEARCH_URL'),
                'locale'   => env('RAPIDAPI_LOCALE', 'en_US'),
                'currency' => env('RAPIDAPI_CURRENCY', 'USD')
            ],
            'covid' => [
                'url'  => env('RAPIDAPI_COVID_URL'),
                'host' => env('RAPIDAPI_COVID_HOST')
            ]
        ]
    ]
];
