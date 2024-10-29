<?php

namespace Tests\Feature\PrintedDesigns;

use App\PrintedDesigns\Controllers\StorePrintedDesignController;
use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('stores a print', function () {
    $brand = FilamentBrand::factory()->create();
    $colour = FilamentColour::factory()->create();
    $material = FilamentMaterial::factory()->create();

    $user = User::factory()->create();

    Sanctum::actingAs($user);
    $this->postJson(route('prints.store', [
        'title' => 'My title',
        'description' => 'My description',
        'filament_brand_id' => $brand->id,
        'filament_colour_id' => $colour->id,
        'filament_material_id' => $material->id,
        'images' => [
            ['url' => 'test', 'is_cover_image' => true],
        ],
    ]))
        ->assertStatus(201)
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.user_id', $user->id)
            ->where('data.title', 'My title')
            ->where('data.description', 'My description')
            ->where('data.filament_brand.name', $brand->name)
            ->where('data.filament_colour.name', $colour->name)
            ->where('data.filament_material.name', $material->name)
            ->where('data.images.0.url', 'test')
            ->where('data.images.0.is_cover_image', true)
        );
});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        StorePrintedDesignController::class,
        '__invoke',
        StorePrintedDesignRequest::class
    );
});
