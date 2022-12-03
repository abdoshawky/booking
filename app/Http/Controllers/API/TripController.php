<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function getTrips(): JsonResponse
    {
        $trips = Trip::with(['bus', 'stations', 'bookings'])->get();
        return response()->json(['trips' => TripResource::collection($trips)]);
    }

    public function bookTripSeat(Request $request, Trip $trip)
    {
        $trip->bookings()->create($request->all() + ['user_id' => auth()->id()]);
    }
}
