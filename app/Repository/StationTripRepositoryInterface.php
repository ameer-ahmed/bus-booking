<?php

namespace App\Repository;

interface StationTripRepositoryInterface extends RepositoryInterface {
    public function getMaxTakenSeats($trip_id, $pickup_station_id, $dropoff_station_id);

    public function updateTripData($trip_id, $pickup_station_id, $dropoff_station_id, $seats);

    public function getId($trip_id, $station_id);
}
