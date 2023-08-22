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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('trip_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('seats')->unsigned()->default(1);
            $table->foreignId('pickup_station_id')->constrained('station_trip')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dropoff_station_id')->constrained('station_trip')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
