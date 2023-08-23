<?php

namespace App\Http\Requests\Api\V1\Search;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
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
            'seats' => ['required', 'integer', 'gte:1'],
            'pickup_station_id' => ['required', 'integer', Rule::exists('stations', 'id')],
            'dropoff_station_id' => ['required', 'integer', Rule::exists('stations', 'id'), 'different:pickup_station_id'],
        ];
    }
}
