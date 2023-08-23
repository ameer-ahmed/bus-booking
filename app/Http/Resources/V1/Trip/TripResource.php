<?php

namespace App\Http\Resources\V1\Trip;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'trip_line' => $this->firstStation->name . '-' . $this->lastStation->name,
            'bus_seats' => $this->bus->seats
        ];
    }
}
