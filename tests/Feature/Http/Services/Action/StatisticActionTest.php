<?php

namespace Feature\Http\Services\Action;

use App\Http\Services\Action\StatisticAction;
use App\Http\Services\API\CovidService;
use App\Http\Services\API\HotelService;
use App\Http\Services\API\OpenweatherService;
use App\Models\Country;
use App\Models\Statistic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatisticActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group services
     */
    public function test_get_success()
    {
        $quantity = 2;
        Country::factory($quantity)->create();
        (new StatisticAction())->get(new CovidService(), new HotelService(), new OpenweatherService());

        $this->assertEquals($quantity, Country::count());
        $this->assertEquals($quantity, Statistic::count());
    }
}
