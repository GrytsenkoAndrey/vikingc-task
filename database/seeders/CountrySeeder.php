<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();

        $dataCsv = fopen(public_path('/data.csv'), 'rb');
        $arr = [];

        while ($csvLine = fgetcsv(stream: $dataCsv, separator:',')) {
            if ($csvLine[0] !== 'Country' && $csvLine[1] !== 'City' && $csvLine[2] !== 'Date') {
                $arr[] = [
                    'title'      => $csvLine[0],
                    'capital'    => $csvLine[1],
                    'created_at' => $csvLine[2]
                ];
            }
        }

        Country::insert($arr);
    }
}
