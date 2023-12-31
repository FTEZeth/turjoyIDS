<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    use HasFactory;
    protected $fillable = [
        'code',
        'seat_amount',
        'total',
        'date',
        'route_id',
        //'pdf',
        //'payment_method',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
