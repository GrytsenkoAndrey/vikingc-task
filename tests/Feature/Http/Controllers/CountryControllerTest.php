<?php

namespace Feature\Http\Controllers;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group pages
     */
    public function test_index()
    {
        Country::factory(5)->create();
        $last = Country::latest()->first();

        $response = $this->get(route('country.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Countries');
        $response->assertSee($last->title);
        $response->assertSee($last->capital);
    }
}
