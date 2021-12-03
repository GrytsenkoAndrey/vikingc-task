<?php

namespace Feature\Http\Services;

use App\Http\Services\Action\StatisticAction;
use App\Http\Services\API\CovidService;
use App\Http\Services\API\HotelService;
use App\Http\Services\API\OpenweatherService;
use App\Http\Services\CountryService;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group services
     */
    public function test_statistics_empty_parameters()
    {
        $collection = (new CountryService())->statistics(null, null, null);

        $this->assertEmpty($collection);
    }

    /**
     * @group services
     */
    public function test_statistics_filter()
    {
        $capital = 'Beijing';
        $country = 'China';
        $date = '2020-11-20';

        Country::insert([
            'capital' => $capital,
            'title'   => $country,
            'created_at' => $date
        ]);
        (new StatisticAction())->get(new CovidService(), new HotelService(), new OpenweatherService());

        $coll1 = (new CountryService())->statistics($capital, null, null);

        $this->assertCount(1, $coll1);
        $this->assertNotEmpty($coll1->first()->statistic);

        $coll2 = (new CountryService())->statistics(null, $country, null);

        $this->assertCount(1, $coll2);
        $this->assertNotEmpty($coll2->first()->statistic);

        $coll3 = (new CountryService())->statistics(null, null, $date);

        $this->assertCount(1, $coll3);
        $this->assertNotEmpty($coll3->first()->statistic);
    }
}
