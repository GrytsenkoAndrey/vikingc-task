<?php

namespace App\Exports;

use App\Http\Services\CountryService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatisticExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = [];

        foreach ((new CountryService())->statistics(request()->capital, request()->country, request()->date) as $country) {
            $collection[] = [
                'id'      => $country->id,
                'country' => $country->title,
                'capital' => $country->capital,
                'hotels'  => $country->statistic->hotels,
                'weather' => $country->statistic->weather,
                'covid'   => $country->statistic->covid
            ];
        }

        return collect($collection);
    }

    public function headings(): array
    {
        return [
            '#',
            'Country',
            'Capital',
            'Hotels',
            'Weather',
            'COVID'
        ];
    }
}
