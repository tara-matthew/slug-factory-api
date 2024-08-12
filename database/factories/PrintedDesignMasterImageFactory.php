<?php

namespace Database\Factories;

use Domain\Images\Models\PrintedDesignMasterImage;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedDesignMasterImageFactory extends Factory
{
    protected $model = PrintedDesignMasterImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl,
            'printed_design_id' => PrintedDesign::factory(),
        ];
    }
}
