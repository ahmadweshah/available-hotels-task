<?php

namespace App\Helpers;

use App\Hotels\Providers\BestHotel;
use App\Mediator\HotelsMediator;
use App\Exceptions\InvalidHotelProviderException;

class Hotels
{

    /**
     * @var HotelsMediator
     */
    protected HotelsMediator $hotelMediator;

    public function __construct()
    {
        $this->hotelMediator = app(HotelsMediator::class);
    }

    /**
     * fetch apis to get the desired output
     *
     * @param string $fromDate
     * @param string $toDate
     * @param string $city
     * @param int $adults
     * @param array $apiProviders
     *
     * @return array
     * @throws InvalidHotelProviderException
     */
    public function search(string $fromDate, string $toDate, string $city, int $adults, array $apiProviders, array $filters): array {

        $response = [];
        $this->checkApiProvidersAreValid($apiProviders);

        foreach($apiProviders as $provider) {
            $apiResp = $this->hotelMediator
                ->driver($provider)
                ->availableHotels(
                    $fromDate,
                    $toDate,
                    $city,
                    $adults,
                    $filters);

            $response = array_merge($apiResp, $response);
        }

        $rateColumn = array_column($response, "rate");

        array_multisort($rateColumn, SORT_DESC, $response);

        return $response;

    }

    /**
     * check if the provider is supported
     *
     * @param array $apiProviders
     *
     * @throws InvalidHotelProviderException
     */
    protected function checkApiProvidersAreValid(array $apiProviders): void
    {
        $invalidProviders = collect($apiProviders)->diff(config('hotels.available_providers'))->toArray();

        if(!empty($invalidProviders)) {

            $invalidProvidersImploded = implode(",", $invalidProviders);

            throw new InvalidHotelProviderException("Invalid Providers $invalidProvidersImploded", 400);
        }
    }
}
