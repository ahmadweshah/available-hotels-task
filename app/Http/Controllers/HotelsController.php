<?php
namespace App\Http\Controllers;

use App\Exceptions\InvalidHotelProviderException;
use App\Hotels\Providers\BestHotel;
use App\Http\Requests\AvailableHotelsRequest ;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    /**
     * @throws InvalidHotelProviderException
     */
    public function availableHotels(AvailableHotelsRequest $request): \Illuminate\Http\JsonResponse
    {
        $apiProviders = $request->get('api_providers') ?? [config('hotels.default_provider')];

        $response = hotels()
            ->search(
                $request->get('from_date'),
                $request->get('to_date'),
                $request->get('city'),
                $request->get('adults'),
                $apiProviders,
                $request->get('search') ?? [],
            );

        return response()->json($response, 200);

    }
}
