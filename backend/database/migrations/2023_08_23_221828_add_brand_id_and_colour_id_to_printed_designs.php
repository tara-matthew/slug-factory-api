<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('printed_designs', function (Blueprint $table) {
            $table->foreignId('filament_brand_id')
                ->after('user_id')
                ->constrained('filament_brands')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('filament_colour_id')
                ->after('filament_brand_id')
                ->constrained('filament_colours')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('printed_designs', function (Blueprint $table) {
            //
        });
    }
};
