<?php

use App\PrintedDesignLists\Controllers\IndexMyPrintedDesignListsController;
use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Users\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

covers(IndexMyPrintedDesignListsController::class);

it('returns a list of printed design lists', function () {
    $user = User::factory()->createQuietly();

    $printedDesignLists = PrintedDesignList::factory()->for($user)->count(3)->create();
    $printedDesignListsNotBelongingToUser = PrintedDesignList::factory()->count(2)->create();

    Sanctum::actingAs($user);

    $this
        ->getJson(route('my.print-lists.index'))
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 3)
            ->has('data.0', fn (AssertableJson $json) => $json->where('id', $printedDesignLists->first()->id)
                ->where('title', $printedDesignLists->first()->title)
                ->etc()
            )
            ->etc()
        );
});
