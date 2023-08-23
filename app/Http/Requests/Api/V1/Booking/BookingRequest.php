<?php

namespace App\Http\Requests\Api\V1\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => ['required', Rule::exists('trips', 'id')],
            'seats' => ['required', 'integer', 'gte:1'],
            'pickup_station_trip_id' => ['required', 'integer', Rule::exists('station_trip', 'id')->where('trip_id', $this->input('trip_id'))],
            'dropoff_station_trip_id' => ['required', 'integer', Rule::exists('station_trip', 'id')->where('trip_id', $this->input('trip_id')), 'gt:pickup_station_trip_id'],
        ];
    }
}
