<?php

use App\PrintedDesigns\Controllers\LatestPrintedDesignsController;
use Carbon\Carbon;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);
covers(LatestPrintedDesignsController::class);

it('returns the latest printed designs with the most recently added first', function () {
    // TODO read the number to be returned from a config and use that here/as part of the assertion

    Carbon::setTestNow(Carbon::parse('2024-10-24 12:00:00'));

    foreach (range(1, 15) as $i) {
        PrintedDesign::factory()->create([
            'created_at' => now()->addMinutes($i),
        ]);
    }

    $finalPrint = PrintedDesign::query()->latest()->first();

    Sanctum::actingAs(
        User::factory()->create()
    );

    $response = $this->getJson(route('prints.latest.index'));

    $response->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 10)
            ->has('data.0', fn (AssertableJson $json) => $json->where('id', $finalPrint->id)
                ->where('user_id', $finalPrint->user_id)
                ->where('title', $finalPrint->title)
                ->where('description', $finalPrint->description)
                ->where('filament_brand.name', $finalPrint->filamentBrand->name)
                ->where('filament_colour.name', $finalPrint->filamentColour->name)
                ->where('filament_material.name', $finalPrint->filamentMaterial->name)
                ->where('is_favourite', false)
                ->etc()
            )
        );
});
