<?php

namespace App\Repository\Eloquent;

use App\Models\Booking;
use App\Repository\BookingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BookingRepository extends Repository implements BookingRepositoryInterface
{
    protected Model $model;

    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }

}
