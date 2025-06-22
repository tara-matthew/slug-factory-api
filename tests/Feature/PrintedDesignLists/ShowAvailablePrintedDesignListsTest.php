<?php

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('shows available printed design lists for a print', function () {
    $listCountContainingPrint = 3;
    $listCountNotContainingPrint = 1;
    $listCountNotContainingPrintIndex = 3;

    $user = User::factory()->createQuietly();

    $printedDesign = PrintedDesign::factory()->create();

    $printedDesignLists = PrintedDesignList::factory()
        ->for($user)
        ->count($listCountContainingPrint)
        ->create();

    $printedDesignListNotContainingPrint = PrintedDesignList::factory()->for($user)->create();

    $printedDesignLists->each(function ($list) use ($printedDesign) {
        $list->printedDesigns()->attach($printedDesign);
    });

    $this->actingAs($user)
        ->getJson(route('my.print-lists.prints.available.show', ['printedDesign' => $printedDesign]))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', $listCountContainingPrint + $listCountNotContainingPrint)
            ->has('data.0', fn (AssertableJson $json) => $json->where('id', $printedDesignLists->first()->id)
                ->where('title', $printedDesignLists->first()->title)
                ->where('count', 1)
                ->where('contains_item', true)
                ->etc()
            )
            ->has("data.$listCountNotContainingPrintIndex", fn (AssertableJson $json) => $json->where('id', $printedDesignListNotContainingPrint->id)
                ->where('contains_item', false)
                ->etc()
            )
            ->etc());
});
