<?php

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printed_design_master_images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PrintedDesign::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('url');
            $table->boolean('is_cover_image')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printed_design_master_images');
    }
};
