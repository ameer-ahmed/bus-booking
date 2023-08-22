<?php

namespace App\Repository\Eloquent;

use App\Models\Trip;
use App\Repository\TripRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TripRepository extends Repository implements TripRepositoryInterface
{
    protected Model $model;

    public function __construct(Trip $model)
    {
        parent::__construct($model);
    }

}
