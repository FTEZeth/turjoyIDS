<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model{

    use HasFactory;
    protected $fillable = [
        'origin',
        'destination',
        'seat_quantity',
        'base_rate',
    ];

    public function reservations(){

        return $this->hasMany(Reservation::class);
    }
}
