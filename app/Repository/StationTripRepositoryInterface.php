<?php

namespace App\Repository;

interface StationTripRepositoryInterface extends RepositoryInterface {
    public function getMaxTakenSeats($trip_id, $pickup_station_id, $dropoff_station_id);

    public function updateTripData($trip_id, $pickup_station_id, $dropoff_station_id, $seats);
}
