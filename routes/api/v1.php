<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Booking\BookingController;
use App\Models\Trip;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'controller' => AuthController::class,
], function () {

    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

/*Route::get('test', function () {
    $trip = Trip::find(1);
    return Trip::query()->whereHas('itineraries', function ($query) use ($pickup_station_id, $dropoff_station_id, $seats) {
        $query->where('station_id', $pickup_station_id);
    });
});*/

Route::group(['middleware' => 'auth:api'], function () {

    Route::group([
        'prefix' => 'booking',
        'controller' => BookingController::class,
    ], function () {
        Route::post('search', 'search');
        Route::post('reserve', 'reserve');

    });

});
