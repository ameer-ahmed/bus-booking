<?php

namespace App\Repository;

interface TripRepositoryInterface extends RepositoryInterface {

    public function search($pickup_station_id, $dropoff_station_id);

}
