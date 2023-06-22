<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('filament_brand_filament_colour', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filament_brand_id')->constrained('filament_brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('filament_colour_id')->constrained('filament_colours')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filament_brand_filament_colour');
    }
};
