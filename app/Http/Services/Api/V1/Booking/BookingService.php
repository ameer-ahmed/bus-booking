<?php

namespace App\Http\Services\Api\V1\Booking;

use App\Http\Requests\Api\V1\Booking\BookingRequest;
use App\Http\Requests\Api\V1\Search\SearchRequest;
use App\Http\Resources\V1\Booking\BookingResource;
use App\Http\Resources\V1\Trip\TripResource;
use App\Http\Traits\Responser;
use Exception;
use Illuminate\Support\Facades\DB;

class BookingService
{
    use Responser;

    protected BookingHelperService $bookingHelper;

    public function __construct(
        BookingHelperService $bookingHelper,
    )
    {
        $this->bookingHelper = $bookingHelper;
    }

    public function search(SearchRequest $request) {
        $data = $request->validated();

        $results = $this->bookingHelper->search($data);

        if ($results->count() > 0) {
            return $this->responseSuccess(message: $results->count() . ' result(s) found.', data: TripResource::collection($results));
        } else {
            return $this->responseFail(message: 'No result matches your request found.');
        }
    }

    public function reserve(BookingRequest $request)
    {
        $data = $request->validated();

        if ($this->bookingHelper->isReservable($data['trip_id'], $data['pickup_station_trip_id'], $data['dropoff_station_trip_id'], $data['seats'])) {
            DB::beginTransaction();

            try {
                $booking = $this->bookingHelper->reserve($data);

                DB::commit();

                return $this->responseSuccess(message: 'Your trip is booked successfully.', data: new BookingResource($booking));
            } catch (Exception $e) {
                DB::rollBack();

                return $this->responseFail(message: 'Something went wrong while booking this reservation.');
            }
        } else {
            return $this->responseFail(message: 'The seats are not enough.');
        }
    }
}
