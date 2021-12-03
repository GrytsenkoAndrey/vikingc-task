<?php

namespace Feature\Http\Services\API;

use App\Http\Services\API\HotelService;
use Tests\TestCase;

class HotelServiceTest extends TestCase
{
    /**
     * @group services
     */
    public function test_get_data_empty_city_name_fail()
    {
        $result = (new HotelService())->getData('');

        $this->assertArrayHasKey('error', $result);
    }

    /**
     * @group services
     */
    public function test_get_data_success()
    {
        $result = (new HotelService())->getData('Copenhagen');

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}
