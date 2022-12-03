<?php

namespace App\Observers;

use App\Models\Bus;

class BusObserver
{
    public function created(Bus $bus): void
    {
        foreach (range(1, $bus->seatsCount) as $number) {
            $bus->seats()->create(['name' => $number]);
        }
    }
}
