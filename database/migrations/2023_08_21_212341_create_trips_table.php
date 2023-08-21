<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('first_station_id')->constrained('stations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('last_station_id')->constrained('stations')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
