<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'seat_amount',
        'id_route',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'id_route');
    }
}
