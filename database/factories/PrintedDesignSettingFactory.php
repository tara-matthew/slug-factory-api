<?php

namespace Database\Factories;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\PrintedDesignSettings\Models\PrintedDesignSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedDesignSettingFactory extends Factory
{
    protected $model = PrintedDesignSetting::class;

    public function definition(): array
    {
        return [
            'printed_design_id' => PrintedDesign::factory(),
            'infill_percentage' => fake()->randomNumber(3),
            'print_speed' => fake()->randomNumber(3),
            'nozzle_size' => fake()->randomNumber(2),
            'uses_supports' => fake()->boolean(),
            'uses_raft' => fake()->boolean,
            'uses_brim' => fake()->boolean,
        ];
    }
}
