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
        $cairo_fayyum_trip = Trip::query()->create([
            'bus_id' => 1,
            'first_station_id' => 1,
            'last_station_id' => 5,
        ]);

        $stations = [ // Dummy IDs
            1, // Cairo
            3, // AlFyyum
            4, // AlMinya
            5, // Asyut
        ];

        $cairo_fayyum_trip->stations()->attach($stations);


    }
}
