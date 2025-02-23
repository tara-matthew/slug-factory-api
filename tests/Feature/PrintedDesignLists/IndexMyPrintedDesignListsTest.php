<?php

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\Users\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

covers(\App\Http\Controllers\IndexMyPrintedDesignListsController::class);

it ('returns a list of printed design lists', function() {
    $user = User::factory()->create();

    $printedDesignLists = PrintedDesignList::factory()->for($user)->count(3)->create();
    Sanctum::actingAs($user);

        $this
            ->getJson(route('my.print-lists.index'))
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json->has('data', 3)
                ->has('data.0', fn (AssertableJson $json) => $json->where('id', $printedDesignLists->first()->id)
                    ->where('name', $printedDesignLists->first()->name)
                    ->etc()
                )
                ->etc()
            );
});
