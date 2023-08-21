<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function trips() {
        return $this->belongsToMany(Trip::class);
    }

}
