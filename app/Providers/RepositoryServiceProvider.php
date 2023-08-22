<?php

namespace App\Providers;

use App\Repository\BookingRepositoryInterface;
use App\Repository\BusRepositoryInterface;
use App\Repository\Eloquent\BookingRepository;
use App\Repository\Eloquent\BusRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\StationTripRepository;
use App\Repository\Eloquent\TripRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\RepositoryInterface;
use App\Repository\StationTripRepositoryInterface;
use App\Repository\TripRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(BusRepositoryInterface::class, BusRepository::class);
        $this->app->bind(StationTripRepositoryInterface::class, StationTripRepository::class);
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
