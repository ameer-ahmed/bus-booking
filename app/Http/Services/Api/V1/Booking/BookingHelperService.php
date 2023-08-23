<?php


namespace App\Http\Services\Api\V1\Booking;

use App\Http\Traits\Responser;
use App\Repository\BookingRepositoryInterface;
use App\Repository\StationTripRepositoryInterface;
use App\Repository\TripRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class BookingHelperService
{
    use Responser;

    protected UserRepositoryInterface $userRepository;
    protected BookingRepositoryInterface $bookingRepository;
    protected StationTripRepositoryInterface $stationTripRepository;
    protected TripRepositoryInterface $tripRepository;

    public function __construct(
        UserRepositoryInterface        $userRepository,
        BookingRepositoryInterface     $bookingRepository,
        StationTripRepositoryInterface $stationTripRepository,
        TripRepositoryInterface        $tripRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
        $this->stationTripRepository = $stationTripRepository;
        $this->tripRepository = $tripRepository;
    }

    // Get trip bus seats
    private function busSeats($trip_id)
    {
        $trip = $this->tripRepository->getById($trip_id, ['id', 'bus_id'], ['bus']);
        return $trip->bus?->seats;
    }

    // Check if the requested booking can be reserved
    public function isReservable($trip_id, $pickup_station_id, $dropoff_station_id, $seats) {
        $max_taken_seats = $this->stationTripRepository->getMaxTakenSeats($trip_id, $pickup_station_id, $dropoff_station_id);

        // Check if the max taken seats plus the requested seats can cover the maximum bus seats
        return $max_taken_seats + $seats <= $this->busSeats($trip_id);
    }

    public function search($data) {
        $results = $this->tripRepository->search($data['pickup_station_id'], $data['dropoff_station_id']);

        return $results->filter(function ($result) use ($data) {
            $pickup_station_trip_id = $this->stationTripRepository->getId($result->trip_id, $data['pickup_station_id']);
            $dropoff_station_trip_id = $this->stationTripRepository->getId($result->trip_id, $data['dropoff_station_id']);

            return $this->isReservable($result->trip_id, $pickup_station_trip_id, $dropoff_station_trip_id, $data['seats']);
        });
    }

    public function reserve($data) {
        $booking = $this->bookingRepository->create([
            'user_id' => auth('api')->id(),
            'seats' => $data['seats'],
            'trip_id' => $data['trip_id'],
            'pickup_station_id' => $data['pickup_station_trip_id'],
            'dropoff_station_id' => $data['dropoff_station_trip_id'],
        ]);

        // Prepare the trip data to be ready for the next booking depending on the remaining seats
        $this->stationTripRepository->updateTripData($data['trip_id'], $data['pickup_station_trip_id'], $data['dropoff_station_trip_id'], $data['seats']);

        return $booking;
    }
}
