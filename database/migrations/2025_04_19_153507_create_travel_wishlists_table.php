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
        Schema::create('travel_wishlists', function (Blueprint $table) {
            $table->id();
            $table->string('place_name');
            $table->string('location');
            $table->enum('travel_type', ['Liburan', 'Petualangan', 'Wisata Budaya', 'Kuliner', 'Alam']);
            $table->unsignedTinyInteger('priority_level'); // 1–5
            $table->unsignedBigInteger('estimated_cost');  // Minimal 100000 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_wishlists');
    }
};
