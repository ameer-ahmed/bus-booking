<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationTrip extends Model
{
    protected $table = 'station_trip';
    protected $fillable = ['station_id', 'trip_id'];
    public $timestamps = false;

    public function station() {
        return $this->belongsTo(Station::class);
    }
}
