<?php

namespace App\Repository\Eloquent;

use App\Models\StationTrip;
use App\Repository\StationTripRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class StationTripRepository extends Repository implements StationTripRepositoryInterface
{
    protected Model $model;

    public function __construct(StationTrip $model)
    {
        parent::__construct($model);
    }

    // Max taken seats during the requested pickup and dropoff stations
    public function getMaxTakenSeats($trip_id, $pickup_station_id, $dropoff_station_id) {
        return $this->model::query()
            ->where('trip_id', $trip_id)
            ->where('id', '>=', $pickup_station_id)
            ->where('id', '<=', $dropoff_station_id)
            ->max('sits');
    }

    // Prepare the trip data to be ready for the next booking depending on remain seats
    public function updateTripData($trip_id, $pickup_station_id, $dropoff_station_id, $seats) {
        $this->model::query()
            ->where('trip_id', $trip_id)
            ->where('id', '>=', $pickup_station_id)
            ->where('id', '<=', $dropoff_station_id)
            ->increment('sits', $seats);

        $this->model::query()
            ->where('trip_id', $trip_id)
            ->where('id', $pickup_station_id)
            ->increment('enters', $seats);

        $this->model::query()
            ->where('trip_id', $trip_id)
            ->where('id', $dropoff_station_id)
            ->increment('leaves', $seats);
    }

}
