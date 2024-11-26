<?php

use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printed_design_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PrintedDesign::class)->unique()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('infill_percentage')->nullable();
            $table->unsignedInteger('print_speed')->nullable();
            $table->unsignedInteger('nozzle_size')->nullable();
            $table->boolean('uses_supports')->default(false);
            $table->enum('adhesion_type', ['skirt', 'brim', 'raft']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printed_design_settings');
    }
};
