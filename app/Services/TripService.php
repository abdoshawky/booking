<?php

namespace App\Services;

use App\Models\Trip;
use App\Models\TripStation;
use Illuminate\Database\Eloquent\Collection;

class TripService
{

    public function getInBetweenStations(Trip $trip, $startStationId, $endStationId): Collection
    {
        $startStation = TripStation::query()
            ->where('trip_id', $trip->id)
            ->where('station_id', $startStationId)
            ->first();
        $endStation = TripStation::query()
            ->where('trip_id', $trip->id)
            ->where('station_id', $endStationId)
            ->first();

        return $trip->stations()->whereBetween('order', [$startStation->order, $endStation->order - 1])->get();
    }

    public function getAvailableSeats(Trip $trip, $startStationId, $endStationId): Collection
    {
        // get all bookings for these stations
        $stations = $this->getInBetweenStations($trip, $startStationId, $endStationId);
        $bookedSeatsIds = $trip->bookings()
            ->whereIn('station_id', $stations->pluck('id')->toArray())
            ->pluck('seat_id')
            ->unique()
            ->toArray();

        return $trip->bus->seats()->whereNotIn('id', $bookedSeatsIds)->get();
    }

    public function isSeatAvailable(Trip $trip, $seatId, $startStationId, $endStationId): bool
    {
        $availableSeats = $this->getAvailableSeats($trip, $startStationId, $endStationId);
        return in_array($seatId, $availableSeats->pluck('id')->toArray());
    }

    /**
     * @throws \Exception
     */
    public function bookTripSeat(Trip $trip, $seatId, $startStationId, $endStationId): void
    {
        if (!$this->isSeatAvailable($trip, $seatId, $startStationId, $endStationId)) {
            throw new \Exception('Seat not available');
        }

        $stations = $this->getInBetweenStations(
            $trip,
            $startStationId,
            $endStationId
        );
        foreach ($stations as $station) {
            $trip->bookings()->create(
                [
                    'user_id' => auth()->id(),
                    'seat_id' => $seatId,
                    'station_id' => $station->id,
                    'is_end_station' => false
                ]
            );
        }

        // insert end station
        $trip->bookings()->create(
            [
                'user_id' => auth()->id(),
                'seat_id' => $seatId,
                'station_id' => $endStationId,
                'is_end_station' => true
            ]
        );
    }

}
