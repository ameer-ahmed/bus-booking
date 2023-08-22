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

    public function pickup() {
        return $this->belongsTo(StationTrip::class, 'pickup_station_id');
    }

    public function dropoff() {
        return $this->belongsTo(StationTrip::class, 'dropoff_station_id');
    }
}
