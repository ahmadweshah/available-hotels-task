<?php

namespace App\Hotels\Providers;

use App\Hotels\Providers\ProvidersInterface;

class CrazyHotel implements ProvidersInterface
{
    /**
     * This provider is not ready yet
     *
     * @param string $fromDate
     * @param string $toDate
     * @param string $city
     * @param int $adults
     * @param array $filters
     * @return array
     * @throws \Exception
     */
    public function availableHotels(string $fromDate, string $toDate, string $city, int $adults, array $filters): array
    {
        throw new \Exception("This provider isn't ready yet");
    }
}
