<?php

namespace App\Http\Services\Api\V1\Booking;

use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\Booking\BookingRequest;
use App\Http\Resources\V1\Booking\BookingResource;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Traits\Responser;
use App\Repository\BookingRepositoryInterface;
use App\Repository\StationTripRepositoryInterface;
use App\Repository\TripRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingService
{
    use Responser;

    protected UserRepositoryInterface $userRepository;
    protected BookingRepositoryInterface $bookingRepository;
    protected StationTripRepositoryInterface $stationTripRepository;
    protected TripRepositoryInterface $tripRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        BookingRepositoryInterface $bookingRepository,
        StationTripRepositoryInterface $stationTripRepository,
        TripRepositoryInterface $tripRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
        $this->stationTripRepository = $stationTripRepository;
        $this->tripRepository = $tripRepository;
    }

    private function busSeats($trip_id) {
        $trip = $this->tripRepository->getById($trip_id, ['id', 'bus_id'], ['bus']);
        return $trip->bus?->seats;
    }

    public function reserve(BookingRequest $request) {
        $data = $request->validated();
        $max_taken_seats = $this->stationTripRepository->getMaxTakenSeats($data['trip_id'], $data['pickup_station_id'], $data['dropoff_station_id']);

        // Check if the max taken seats plus the requested seats can cover the maximum bus seats
        if ($max_taken_seats + $data['seats'] <= $this->busSeats($data['trip_id'])) {
            DB::beginTransaction();
            try {
                $booking = $this->bookingRepository->create([
                    'user_id' => auth('api')->id(),
                    'seats' => $data['seats'],
                    'trip_id' => $data['trip_id'],
                    'pickup_station_id' => $data['pickup_station_id'],
                    'dropoff_station_id' => $data['dropoff_station_id'],
                ]);

                // Prepare the trip data to be ready for the next booking depending on remain seats
                $this->stationTripRepository->updateTripData($data['trip_id'], $data['pickup_station_id'], $data['dropoff_station_id'], $data['seats']);

                DB::commit();

                return $this->responseSuccess(message: 'Your trip is booked successfully.', data: new BookingResource($booking));
            } catch (Exception $e) {
                DB::rollBack();
                return $e;
                return $this->responseFail(message: 'Something went wrong while booking this reservation');
            }
        } else {
            return $this->responseFail(message: 'The seats are not enough');
        }
    }


}
