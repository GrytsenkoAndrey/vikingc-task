<?php

namespace App\Http\Services\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenweatherService
{
    /**
     * Weather Forecast for current day by City name
     * @param string $cityId
     * @return array
     */
    public function getData(string $city_name): array
    {
        if (empty(trim($city_name))) {
            $message = __METHOD__ . '; line: ' . __LINE__ . ' an empty given parameter';
            Log::warning($message);

            return ['error' => $message];
        }

        $response = json_decode(Http::get(config('custom.api.weather.url'), [
            'q' => $city_name,
            'appid' => config('custom.api.weather.key'),
            'units' => config('custom.api.weather.units')
        ]), true);

        if (! array_key_exists('weather', $response) || ! array_key_exists('main', $response)) {
            $message = __METHOD__ . '; line: ' . __LINE__ . ' wrong response';
            Log::warning($message);

            return ['error' => $message];
        }

        return $response;
    }
}
