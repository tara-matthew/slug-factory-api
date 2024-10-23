<?php

use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printer_filaments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FilamentBrand::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(FilamentColour::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(FilamentMaterial::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image_url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printer_filaments');
    }
};
