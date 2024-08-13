<?php

use Domain\Filaments\Materials\Models\FilamentMaterial;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('printed_designs', function (Blueprint $table) {
            $table->foreignIdFor(FilamentMaterial::class)->after('filament_colour_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('printed_designs', function (Blueprint $table) {
            $table->dropForeign(['filament_colour_id']);
        });
    }
};
