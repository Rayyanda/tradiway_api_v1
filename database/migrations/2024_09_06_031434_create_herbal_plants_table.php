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
        Schema::create('herbal_plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drink_id')->constrained('herbal_drinks')->cascadeOnDelete();
            $table->foreignId('plant_id')->constrained('plants')->cascadeOnDelete();
            $table->string('measurement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herbal_plants');
    }
};
