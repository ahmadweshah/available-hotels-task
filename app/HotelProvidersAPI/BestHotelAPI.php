<?php
namespace App\HotelProvidersAPI;

class BestHotelAPI
{

    /**
     * call bestHotel api to get available hotels
     *
     * @param string $fromDate
     * @param string $toDate
     * @param string $city
     * @param int $adults
     * @param array $filters
     * @return array|mixed
     */
    public function getAvailableHotels(string $fromDate, string $toDate, string $city, int $adults, array $filters = array()) {

        $data = $this->fetchData();

        if(! empty($filters)) {
            $data = $this->filter($filters, $data);
        }

        return $data;
    }

    /**
     *  Mock method to fetch data
     *
     * @return mixed
     */
    protected function fetchData() {
        return  json_decode(file_get_contents(storage_path() . DIRECTORY_SEPARATOR . 'app/bestHotelData.json'), true);
    }

    /**
     * filtration method on returned data from the API
     *
     * @param array $filters
     * @param array $data
     * @return array
     */
    protected function filter(array $filters, array $data): array
    {
        return collect($data)->filter(function($item) use ($filters) {
            if(isset($filters['name'])) {
                if(str_contains(strtolower($item['name']), strtolower($filters['name']))) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        })->toArray();
    }
}
