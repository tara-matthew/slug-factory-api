<?php

namespace Tests\Feature\PrintedDesigns;

use App\PrintedDesigns\Controllers\ShowPrintedDesignController;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);
covers(ShowPrintedDesignController::class);

it('returns a specific print', function () {
    $user = User::factory()->create();

    $print = PrintedDesign::factory()->hasMasterImages()->hasPrintedDesignSetting()->for($user)->create();
    Sanctum::actingAs(User::factory()->create());

    $this->getJson(route('prints.show', ['printedDesign' => $print]))
        ->assertStatus(200)
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.id', $print->id)
            ->where('data.user_id', $user->id)
            ->where('data.title', $print->title)
            ->where('data.images.0.url', $print->masterImages[0]->url)
            ->where('data.images.0.blurhash', $print->masterImages[0]->blurhash)
            ->where('data.description', $print->description)
            ->where('data.filament_brand.name', $print->filamentBrand->name)
            ->where('data.filament_colour.name', $print->filamentColour->name)
            ->where('data.filament_material.name', $print->filamentMaterial->name)
            ->where('data.favourited_count', 0)
            ->where('data.is_favourite', false)
            ->where('data.settings.infill_percentage', $print->printedDesignSetting->infill_percentage)
            ->where('data.settings.print_speed', $print->printedDesignSetting->print_speed)
            ->where('data.settings.nozzle_size', $print->printedDesignSetting->nozzle_size)
            ->where('data.settings.uses_supports', $print->printedDesignSetting->uses_supports)
            ->where('data.settings.adhesion_type', $print->printedDesignSetting->adhesion_type)
        );
});
