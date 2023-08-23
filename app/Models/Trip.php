<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['bus_id', 'first_station_id', 'last_station_id'];
    public $timestamps = false;

    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function firstStation() {
        return $this->belongsTo(Station::class, 'first_station_id');
    }

    public function lastStation() {
        return $this->belongsTo(Station::class, 'last_station_id');
    }

    public function stations() {
        return $this->belongsToMany(Station::class);
    }

    public function itineraries() {
        return $this->hasMany(StationTrip::class);
    }
}
