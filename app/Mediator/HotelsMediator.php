<?php

namespace App\Mediator;

use Illuminate\Support\Manager;
use App\Hotels\Providers\BestHotel;
use App\Hotels\Providers\CrazyHotel;

class HotelsMediator extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return config('hotels.default_driver');
    }

    /**
     * return instance of BestHotel
     *
     * @return BestHotel
     */
    public function createBestHotelDriver(): BestHotel
    {
        return new BestHotel;
    }

    /**
     * return instance of Airbnb
     *
     * @return CrazyHotel
     */
    public function createCrazyDriver(): CrazyHotel
    {
        return new CrazyHotel;
    }

}
