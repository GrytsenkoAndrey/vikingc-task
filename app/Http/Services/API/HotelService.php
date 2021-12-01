<?php
declare(strict_types=1);

namespace App\Http\Services\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HotelService
{
    public function getHotels(string $city_name)
    {
        if (empty(trim($city_name))) {
            Log::warning(__METHOD__ . '; line: ' . __LINE__ . ' an empty given parameter');

            return 'Error';
        }

        $response = Http::withHeaders([
            'x-rapidapi-host' => config('custom.api.hotels.host'),
            'x-rapidapi-key'  => config('custom.api.hotels.key')
        ])->get(config('custom.api.hotels.url'), [
            'query' => $city_name,
            'locale' => config('custom.api.hotels.locale'),
            'currency' => config('custom.api.hotels.currency')
        ]);

        return $response;
    }
}
