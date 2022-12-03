<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'seat' => SeatResource::make($this->seat),
            'startStation' => StationResource::make($this->startStation),
            'endStation' => StationResource::make($this->endStation),
        ];
    }
}
