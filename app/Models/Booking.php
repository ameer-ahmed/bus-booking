<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'trip_id', 'pickup_station_id', 'dropoff_station_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function pickupStation() {
        return $this->belongsTo(Station::class, 'pickup_station_id');
    }

    public function dropoffStation() {
        return $this->belongsTo(Station::class, 'dropoff_station_id');
    }
}
