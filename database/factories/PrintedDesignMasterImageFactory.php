<?php

namespace Database\Factories;

use Domain\Images\Models\PrintedDesignMasterImage;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintedDesignMasterImageFactory extends Factory
{
    protected $model = PrintedDesignMasterImage::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl,
            'blurhash' => $this->faker->sha256,
            'printed_design_id' => PrintedDesign::factory(),
        ];
    }
}
