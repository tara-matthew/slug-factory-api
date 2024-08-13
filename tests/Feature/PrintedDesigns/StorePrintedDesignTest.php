<?php

namespace Tests\Feature\PrintedDesigns;

use App\PrintedDesigns\Controllers\StorePrintedDesignController;
use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StorePrintedDesignTest extends TestCase
{
    // TODO add images into responses for test
    private FilamentBrand $brand;

    private FilamentColour $colour;

    public function setUp(): void
    {
        parent::setUp();
        $this->brand = FilamentBrand::factory()->create();
        $this->colour = FilamentColour::factory()->create();
        $this->material = FilamentMaterial::factory()->create();
    }

    #[Test]
    public function it_stores_a_print(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('prints.store', [
            'title' => 'My title',
            'description' => 'My description',
            'filament_brand_id' => $this->brand->id,
            'filament_colour_id' => $this->colour->id,
            'filament_material_id' => $this->material->id,
            'images' => [
                ['url' => 'test', 'is_cover_image' => true],
            ],
        ]));

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'My title',
                    'description' => 'My description',
                    'user_id' => $user->id,
                    'filament_brand_id' => $this->brand->id,
                    'filament_colour_id' => $this->colour->id,
                    'filament_material_id' => $this->material->id,
                    'images' => [
                        [
                            'url' => 'test',
                            'is_cover_image' => true,
                        ],
                    ],
                ],
            ]);
    }

    #[Test]
    public function store_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            StorePrintedDesignController::class,
            '__invoke',
            StorePrintedDesignRequest::class
        );
    }
}
