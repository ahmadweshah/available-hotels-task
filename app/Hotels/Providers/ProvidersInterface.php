<?php
namespace App\Hotels\Providers;

interface ProvidersInterface
{
    /**
     * main method to fetch data from providers
     *
     * @param string $fromDate
     * @param string $toDate
     * @param string $city
     * @param int $adults
     * @param array $filters
     * @return array
     */
    public function availableHotels(string $fromDate, string $toDate, string $city, int $adults, array $filters) : array;
}
