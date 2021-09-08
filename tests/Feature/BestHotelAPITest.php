<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BestHotelAPITest extends TestCase
{
    /**
     * A feature test to testing available hotels providers.
     *
     * @return void
     */
    public function test_api_cant_get_when_no_params()
    {
        $response = $this->get(route('availableHotels'));

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['from_date', 'to_date', 'city', 'adults']);
    }

    public function test_api_can_get()
    {
        $params = array(
            'from_date' => "2021-09-05T10:44:55+03:00",
            'to_date' => "2021-09-05T10:00:00+03:00",
            'city' => 'AMMAN',
            'adults' => 2
        );
        $uri = route('availableHotels') . '?' . http_build_query($params);

        $response = $this->get($uri);

        $response->assertStatus(200);

    }

    public function test_api_send_valid_provider()
    {
        $params = array(
            'from_date' => "2021-09-05T10:44:55+03:00",
            'to_date' => "2021-09-05T10:00:00+03:00",
            'city' => 'AMMAN',
            'adults' => 2,
            'api_providers' => ['best_hotel']
        );
        $uri = route('availableHotels') . '?' . http_build_query($params);

        $response = $this->get($uri);

        $response->assertStatus(200);

    }

    public function test_api_send_invalid_provider()
    {
        $params = array(
            'from_date' => "2021-09-05T10:44:55+03:00",
            'to_date' => "2021-09-05T10:00:00+03:00",
            'city' => 'AMMAN',
            'adults' => 2,
            'api_providers' => ['booking']
        );
        $uri = route('availableHotels') . '?' . http_build_query($params);

        $response = $this->get($uri);

        $response->assertStatus(422);

    }
}
