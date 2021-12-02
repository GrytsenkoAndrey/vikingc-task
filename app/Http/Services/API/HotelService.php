<?php
declare(strict_types=1);

namespace App\Http\Services\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HotelService
{
    /**
     * Get hotels by City
     * @param string $city_name
     * @return array|string[]
     */
    public function getData(string $city_name): array
    {
        if (empty(trim($city_name))) {
            $message = __METHOD__ . '; line: ' . __LINE__ . ' an empty given parameter';
            Log::warning($message);

            return ['error' => $message];
        }

        $response = Http::withHeaders([
            'x-rapidapi-host' => config('custom.api.rapidapi.hotels.host'),
            'x-rapidapi-key'  => config('custom.api.rapidapi.key')
        ])->get(config('custom.api.rapidapi.hotels.url'), [
            'query' => $city_name,
            'locale' => config('custom.api.rapidapi.hotels.locale'),
            'currency' => config('custom.api.rapidapi.hotels.currency')
        ]);

        $result = json_decode($response->body(), true);
        if (! array_key_exists('suggestions', $result)) {
            $message = __METHOD__ . '; line: ' . __LINE__ . ' wrong response';
            Log::warning($message);

            return ['error' => $message];
        }

        return $this->getHotelInfoFromResponseSuggestions($result['suggestions']);
    }

    private function getHotelInfoFromResponseSuggestions(array $suggestions): array
    {
        foreach ($suggestions as $item) {
            if ($item['group'] === 'HOTEL_GROUP') {
                return $item['entities'];
            }
        }

        return [];
    }
}
