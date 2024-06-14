<?php

namespace Tests\Feature\PrintedDesigns;

use App\PrintedDesigns\Controllers\PrintedDesignController;
use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PrintedDesignTest extends TestCase
{
    // TODO add images into responses for test
    private FilamentBrand $brand;

    private FilamentColour $colour;

    public function setUp(): void
    {
        parent::setUp();
        $this->brand = FilamentBrand::factory()->create();
        $this->colour = FilamentColour::factory()->create();
    }

    #[Test]
    public function it_stores_a_print(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('prints.store'), [
            'title' => 'My title',
            'description' => 'My description',
            'user_id' => $user->id,
            'filament_brand_id' => $this->brand->id,
            'filament_colour_id' => $this->colour->id,
            'images' => [
                ['url' => 'test', 'is_cover_image' => true]
            ],
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'My title',
                    'description' => 'My description',
                    'user_id' => $user->id,
                    'filament_brand_id' => $this->brand->id,
                    'filament_colour_id' => $this->colour->id,
                    'images' => [
                        [
                            'url' => 'test',
                            'is_cover_image' => true,
                        ]
                    ]
                ],
            ]);
    }

    #[Test]
    public function store_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            PrintedDesignController::class,
            'store',
            StorePrintedDesignRequest::class
        );
    }
}
