<?php

namespace App\Repository\Eloquent;

use App\Models\Bus;
use App\Repository\BusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BusRepository extends Repository implements BusRepositoryInterface
{
    protected Model $model;

    public function __construct(Bus $model)
    {
        parent::__construct($model);
    }

}
