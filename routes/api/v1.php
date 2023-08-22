<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Booking\BookingController;
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

Route::group(['middleware' => 'auth:api'], function () {

    Route::group([
        'prefix' => 'booking',
        'controller' => BookingController::class,
    ], function () {

        Route::post('reserve', 'reserve');

    });

});
