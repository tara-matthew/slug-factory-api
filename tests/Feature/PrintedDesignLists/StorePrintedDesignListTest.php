<?php

use App\PrintedDesignLists\Controllers\StorePrintedDesignListController;
use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use App\PrintedDesignLists\Resources\PrintedDesignListResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

it('stores a printed design list', function () {
    $user = User::factory()->create();

    $this
        ->actingAs($user)
        ->postJson(route('my.print-lists.store', [
            'name' => 'New list',
        ]))->assertCreated()
        ->assertJson(fn (AssertableJson $json) => $json
        ->where('data.name', 'New list')
        ->where('data.user.id', $user->id));

    $this->assertDatabaseHas(
        'printed_design_lists',
        [
            'name' => "New list",
            'user_id' => $user->id,
        ]);

});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        StorePrintedDesignListController::class,
        '__invoke',
        StorePrintedDesignListRequest::class
    );
});

it('does not allow a user to add to a list for someone else')->todo();
it('does not allow duplicates')->todo();
