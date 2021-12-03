<?php

namespace App\Http\Services\Action;

use App\Http\Services\API\{CovidService, HotelService, OpenweatherService};
use App\Models\Country;
use Illuminate\Support\Facades\Log;

class StatisticAction
{
    public function get(
        CovidService $covidService,
        HotelService $hotelService,
        OpenweatherService $weatherService
    ): void
    {
        # get countries
        $countries = Country::all();
        # combine data
        $stat = [];
        foreach ($countries as $country) {
            try {
                $stat['covid'] = json_encode($covidService->getData($country->title, $country->created_at->format('Y-m-d')));
            } catch (\Exception $e) {
                Log::error('Class ' . $covidService::class . ': ' . $e->getMessage());
            }

            try {
                $stat['weather'] = json_encode($weatherService->getData($country->capital));
            } catch (\Exception $e) {
                Log::error('Class ' . $covidService::class . ': ' . $e->getMessage());
            }

            try {
                $stat['hotels'] = json_encode($hotelService->getData($country->capital));
            } catch (\Exception $e) {
                Log::error('Class ' . $covidService::class . ': ' . $e->getMessage());
            }

            $country->statistic()->updateOrCreate(['country_id' => $country->id], $stat);
        }
    }
}
