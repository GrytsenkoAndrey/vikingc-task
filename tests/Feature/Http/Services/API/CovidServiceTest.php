<?php

namespace Feature\Http\Services\API;

use App\Http\Services\API\CovidService;
use Tests\TestCase;

class CovidServiceTest extends TestCase
{
    /**
     * @group services
     */
    public function test_get_data_empty_date_fail()
    {
        $result = (new CovidService())->getData('Praga', '');

        $this->assertArrayHasKey('error', $result);
    }

    /**
     * @group services
     */
    public function test_get_data_empty_country_name_fail()
    {
        $result = (new CovidService())->getData('', '2020-01-12');

        $this->assertArrayHasKey('error', $result);
    }

    /**
     * @group services
     */
    public function test_get_data_success()
    {
        $result = (new CovidService())->getData('Denmark', '2020-11-20');

        $this->assertArrayHasKey('province', $result);
    }
}
