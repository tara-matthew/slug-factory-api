<?php

use App\PrintedDesigns\Controllers\IndexMyPrintedDesignsController;
use Carbon\Carbon;
use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

//covers(IndexMyPrintedDesignsController::class);

it('returns a list of prints', function () {
    $user = User::factory()->create();
    Carbon::setTestNow(Carbon::parse('2024-10-24 12:00:00'));

    Sanctum::actingAs($user);
    $prints = PrintedDesign::factory(2)
        ->hasMasterImages()
        ->hasPrintedDesignSetting()
        ->for($user)
        ->create();

    // Make a favourite for the first print and the current user
    Favourite::factory()->for(
        $prints->first(), 'favouritable'
    )->for($user)->create();

    $this->getJson(route('my.prints.index'))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.0.id', $prints[0]->id)
            ->where('data.0.user_id', $user->id)
            ->where('data.0.title', $prints[0]->title)
            ->where('data.0.images.0.url', $prints[0]->masterImages[0]->url)
            ->where('data.0.images.0.blurhash', $prints[0]->masterImages[0]->blurhash)
            ->where('data.0.description', $prints[0]->description)
            ->where('data.0.filament_brand.name', $prints[0]->filamentBrand->name)
            ->where('data.0.filament_colour.name', $prints[0]->filamentColour->name)
            ->where('data.0.filament_material.name', $prints[0]->filamentMaterial->name)
            ->where('data.0.created_at', $prints[0]->created_at->toISOString())
            ->where('data.0.settings.infill_percentage', $prints[0]->printedDesignSetting->infill_percentage)
            ->where('data.0.settings.print_speed', $prints[0]->printedDesignSetting->print_speed)
            ->where('data.0.settings.nozzle_size', $prints[0]->printedDesignSetting->nozzle_size)
            ->where('data.0.settings.uses_supports', $prints[0]->printedDesignSetting->uses_supports)
            ->where('data.0.settings.adhesion_type', $prints[0]->printedDesignSetting->adhesion_type)
            ->where('data.1.id', $prints[1]->id)
            ->where('data.1.user_id', $user->id)
            ->where('data.1.title', $prints[1]->title)
            ->where('data.1.images.0.url', $prints[1]->masterImages[0]->url)
            ->where('data.1.images.0.blurhash', $prints[1]->masterImages[0]->blurhash)
            ->where('data.1.description', $prints[1]->description)
            ->where('data.1.filament_brand.name', $prints[1]->filamentBrand->name)
            ->where('data.1.filament_colour.name', $prints[1]->filamentColour->name)
            ->where('data.1.filament_material.name', $prints[1]->filamentMaterial->name)
            ->where('data.1.created_at', $prints[1]->created_at->toISOString())
            ->where('data.1.settings.infill_percentage', $prints[1]->printedDesignSetting->infill_percentage)
            ->where('data.1.settings.print_speed', $prints[1]->printedDesignSetting->print_speed)
            ->where('data.1.settings.nozzle_size', $prints[1]->printedDesignSetting->nozzle_size)
            ->where('data.1.settings.uses_supports', $prints[1]->printedDesignSetting->uses_supports)
            ->where('data.1.settings.adhesion_type', $prints[1]->printedDesignSetting->adhesion_type)
            ->etc());
});

it('returns an empty collection of prints when no records exist', function () {
    Sanctum::actingAs(User::factory()->create());

    $this->getJson(route('my.prints.index'))
        ->assertOk()
        ->assertJsonCount(0, 'data')
        ->assertJsonStructure([
            'data' => [],
        ]);
});

it('only returns prints belonging to the authenticated user')->todo();
