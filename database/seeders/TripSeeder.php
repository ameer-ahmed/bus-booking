<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cairo_asyut_trip = Trip::query()->create([
            'bus_id' => 1,
            'first_station_id' => 1,
            'last_station_id' => 5,
        ]);

        $cairo_asyut_stations = [ // Dummy IDs
            1, // Cairo
            3, // AlFyyum
            4, // AlMinya
            5, // Asyut
        ];

        $cairo_asyut_trip->stations()->attach($cairo_asyut_stations);

        #==============================================================================================================#

        $giza_alminya_trip = Trip::query()->create([
            'bus_id' => 2,
            'first_station_id' => 2,
            'last_station_id' => 4,
        ]);

        $giza_alminya_stations = [ // Dummy IDs
            2, // Giza
            3, // AlFyyum
            4, // AlMinya
        ];

        $giza_alminya_trip->stations()->attach($giza_alminya_stations);
    }
}
