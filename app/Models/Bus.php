<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public int $seatsCount = 12;

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
