<?php

namespace App\Http\Resources\V1\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pickup_station' => $this->pickup?->station?->name,
            'dropoff_station' => $this->dropoff?->station?->name,
            'trip_line' => $this->trip?->firstStation?->name . '-' . $this->trip?->lastStation?->name,
            'reserved_seats' => $this->seats,
        ];
    }
}
