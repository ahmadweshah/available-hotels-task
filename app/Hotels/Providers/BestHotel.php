<?php

namespace App\Hotels\Providers;

use App\Hotels\Providers\ProvidersInterface;
use App\HotelProvidersAPI\BestHotelAPI;

class BestHotel implements ProvidersInterface
{
    /**
     * get available hotels from BestHotel provider
     *
     * @param string $fromDate
     * @param string $toDate
     * @param string $city
     * @param int $adults
     * @param array $filters
     * @return array
     */
    public function availableHotels(string $fromDate, string $toDate, string $city, int $adults, array $filters): array
    {
        $api = new BestHotelAPI();

        return $api->getAvailableHotels($fromDate, $toDate, $city, $adults, $filters);
    }
}
