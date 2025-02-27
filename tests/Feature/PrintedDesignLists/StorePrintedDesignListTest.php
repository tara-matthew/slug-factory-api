<?php

use App\PrintedDesignLists\Controllers\StorePrintedDesignListController;
use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use Domain\Users\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

it('stores a printed design list', function () {
    $user = User::factory()->createQuietly();

    $this
        ->actingAs($user)
        ->postJson(route('my.print-lists.store', [
            'title' => 'New list',
            'image_url' => 'https://picsum.photos/640/480?random=47375',
        ]))->assertCreated()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.title', 'New list')
            ->where('data.user.id', $user->id));

    $this->assertDatabaseHas(
        'printed_design_lists',
        [
            'title' => 'New list',
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
