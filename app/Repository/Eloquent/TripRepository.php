<?php

namespace App\Repository\Eloquent;

use App\Models\Trip;
use App\Repository\TripRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TripRepository extends Repository implements TripRepositoryInterface
{
    protected Model $model;

    public function __construct(Trip $model)
    {
        parent::__construct($model);
    }

    public function search($pickup_station_id, $dropoff_station_id) {
        return $this->model::query()
            ->join('station_trip as st1', 'trips.id', '=', 'st1.trip_id')
            ->join('station_trip as st2', 'trips.id', '=', 'st2.trip_id')
            ->where('st1.station_id', $pickup_station_id)
            ->where('st2.station_id', $dropoff_station_id)
            ->where('st2.id', '>', function ($query) use ($pickup_station_id) {
                $query->select(DB::raw('MIN(st.id)'))
                    ->from('station_trip as st')
                    ->whereRaw('st.trip_id = trips.id')
                    ->where('st.station_id', $pickup_station_id);
            })
            ->get();
    }

}
