<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'bus' => BusResource::make($this->bus),
            'stations' => StationResource::collection($this->stations),
            'bookings' => BookingResource::collection($this->bookings)
        ];
    }
}
