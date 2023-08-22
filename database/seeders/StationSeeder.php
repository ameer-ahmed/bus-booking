<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::query()->insert([
            ['name' => 'Cairo'],
            ['name' => 'Giza'],
            ['name' => 'AlFayyum'],
            ['name' => 'AlMinya'],
            ['name' => 'Asyut'],
        ]);
    }
}
