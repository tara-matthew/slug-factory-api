<?php

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;

it('adds a printed design to a list', function () {
    $user = User::factory()->create();
    $printedDesignList = PrintedDesignList::factory()->create();
    $printedDesign = PrintedDesign::factory()->create();

    $this
        ->actingAs($user)
        ->postJson(route('my.printed-design-lists.printed-designs.store', [
            'printedDesignList' => $printedDesignList->id,
            'printed_design_id' => $printedDesign->id,
        ]))->assertOk();

    $this->assertDatabaseHas(
        'printed_design_printed_design_list',
        [
            'printed_design_id' => $printedDesign->id,
            'printed_design_list_id' => $printedDesignList->id,
        ]);
});

it('does not allow a user to add to a list which is not theirs')->todo();
it('does not allow duplicates')->todo();
