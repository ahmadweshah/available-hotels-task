<?php

use App\Helpers\Hotels;

if(! function_exists('hotels')){
    /**
     *
     * @return Hotels
     */
    function hotels(): Hotels
    {
        return new Hotels;
    }
}

