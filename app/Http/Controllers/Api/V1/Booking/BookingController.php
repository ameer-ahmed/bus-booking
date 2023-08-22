<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Booking\BookingRequest;
use App\Http\Services\Api\V1\Booking\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected BookingService $booking;

    public function __construct(
        BookingService $booking,
    )
    {
        $this->booking = $booking;
    }

    public function reserve(BookingRequest $request) {
        return $this->booking->reserve($request);
    }
}
