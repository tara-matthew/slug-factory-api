<?php

use App\PrintedDesignLists\Controllers\ShowPrintedDesignListController;
use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

covers(ShowPrintedDesignListController::class);

it('returns a specific list', function () {
    $user = User::factory()->createQuietly();

    $printedDesign = PrintedDesign::factory()->create();
    $list = PrintedDesignList::factory()->for($user)->create();

    $list->printedDesigns()->attach($printedDesign);

    $this
        ->actingAs($user)
        ->getJson(route('my.print-lists.show', ['printedDesignList' => $list]))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.id', $list->id)
            ->where('data.title', $list->title)
            ->where('data.printed_designs.0.id', $printedDesign->id)
            ->where('data.printed_designs.0.title', $printedDesign->title)
            ->where('data.printed_designs.0.description', $printedDesign->description)
        );
});
