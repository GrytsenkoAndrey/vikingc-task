<?php

namespace App\Http\Services\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CovidService
{
    /**
     * Covid statistic by City and Date
     * @param string $cityId
     * @param string $date
     */
    public function getData(string $city_name, string $date): array
    {
        if (empty(trim($city_name)) || empty(trim($date))) {
            $message = __METHOD__ . '; line: ' . __LINE__ . ' an empty given parameter';
            Log::warning($message);

            return ['error' => $message];
        }

        $response = Http::withHeaders([
            'x-rapidapi-host' => config('custom.api.rapidapi.covid.host'),
            'x-rapidapi-key'  => config('custom.api.rapidapi.key')
        ])->get(config('custom.api.rapidapi.covid.url'), [
            'name' => $city_name,
            'date' => $date
        ]);

        $result = json_decode($response->body(), true);
        $result = array_shift($result);
        if (! array_key_exists('provinces', $result)) {
            $message = __METHOD__ . '; line: ' . __LINE__ . ' wrong response';
            Log::warning($message);

            return ['error' => $message];
        }

        return $this->getCovidStatisticFromResponseProvinces($result['provinces']);
    }

    private function getCovidStatisticFromResponseProvinces(array $provinces): array
    {
        return array_shift($provinces);
    }
}
