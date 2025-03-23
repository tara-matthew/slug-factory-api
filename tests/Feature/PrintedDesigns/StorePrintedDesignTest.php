<?php

namespace Tests\Feature\PrintedDesigns;

use App\PrintedDesigns\Controllers\StorePrintedDesignController;
use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\Filaments\Materials\Models\FilamentMaterial;
use Domain\PrintedDesigns\Actions\StorePrintedDesignSettingsAction;
use Domain\PrintedDesigns\Enums\AdhesionOption;
use Domain\PrintedDesigns\Events\PrintedDesignUploaded;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use RuntimeException;

uses(RefreshDatabase::class);
// TODO use proper images, as may be getting false positives

it('stores a print', function () {
    Event::fake();

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
            ['image' => 'test', 'is_cover_image' => true],
        ],
        'adhesion_type' => AdhesionOption::Raft->value,
    ]))
        ->assertCreated()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.user_id', $user->id)
            ->where('data.title', 'My title')
            ->where('data.description', 'My description')
            ->where('data.filament_brand.name', $brand->name)
            ->where('data.filament_colour.name', $colour->name)
            ->where('data.filament_material.name', $material->name)
            ->where('data.settings.adhesion_type', AdhesionOption::Raft->value)
        );

    Event::assertDispatched(PrintedDesignUploaded::class);
});

it('rolls back all changes if any part fails', function () {
    Event::fake();

    $brand = FilamentBrand::factory()->create();
    $colour = FilamentColour::factory()->create();
    $material = FilamentMaterial::factory()->create();
    $user = User::factory()->create();

    $this->mock(StorePrintedDesignSettingsAction::class)
        ->shouldReceive('execute')
        ->andThrow(new RuntimeException('Failed to save settings'));

    Sanctum::actingAs($user);

    $response = $this->postJson(route('prints.store'), [
        'title' => 'My title',
        'description' => 'My description',
        'filament_brand_id' => $brand->id,
        'filament_colour_id' => $colour->id,
        'filament_material_id' => $material->id,
        'images' => [
            ['image' => 'test', 'is_cover_image' => true],
        ],
        'adhesion_type' => AdhesionOption::Raft->value,
    ]);

    $response
        ->assertStatus(500);

    $this->assertDatabaseCount('printed_designs', 0);
    $this->assertDatabaseCount('printed_design_settings', 0);
    $this->assertDatabaseCount('printed_design_master_images', 0);

    Event::assertNotDispatched(PrintedDesignUploaded::class);
});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        StorePrintedDesignController::class,
        '__invoke',
        StorePrintedDesignRequest::class
    );
});
