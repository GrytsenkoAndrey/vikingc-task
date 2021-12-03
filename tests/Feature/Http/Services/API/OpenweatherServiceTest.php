<?php

namespace Feature\Http\Services\API;

use App\Http\Services\API\OpenweatherService;
use Tests\TestCase;

class OpenweatherServiceTest extends TestCase
{
    /**
     * @group services
     */
    public function test_get_data_empty_city_name_fail()
    {
        $result = (new OpenweatherService())->getData('');

        $this->assertArrayHasKey('error', $result);
    }

    /**
     * @group services
     */
    public function test_get_data_success()
    {
        $result = (new OpenweatherService())->getData('Copenhagen');

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}
