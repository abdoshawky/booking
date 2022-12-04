<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeatResource;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Services\TripService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripController extends Controller
{
    private TripService $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    public function getTrips(): JsonResponse
    {
        $trips = Trip::with(['bus', 'stations'])->get();
        return response()->json(['trips' => TripResource::collection($trips)]);
    }

    public function getTripAvailableSeats(Request $request, Trip $trip): JsonResponse
    {
        $startStationId = $request->start_station_id;
        $endStationId = $request->end_station_id;

        $seats = $this->tripService->getAvailableSeats($trip, $startStationId, $endStationId);

        return response()->json(['seats' => SeatResource::collection($seats)]);
    }

    public function bookTripSeat(Request $request, Trip $trip)
    {
        $this->tripService->bookTripSeat(
            $trip,
            $request->seat_id,
            $request->start_station_id,
            $request->end_station_id
        );

        return response()->json(['msg' => 'booking created successfully']);
    }
}
