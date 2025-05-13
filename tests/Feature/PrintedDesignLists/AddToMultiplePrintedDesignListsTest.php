<?php

use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;

it('adds a printed design to lists', function () {
    $user = User::factory()->create();
    $printedDesignLists = PrintedDesignList::factory(2)->create();
    $printedDesign = PrintedDesign::factory()->create();

    $response = $this
        ->actingAs($user)
        ->postJson(route('my.prints.print-lists.store', [
            'printed_design_list_ids' => [$printedDesignLists[0]->id, $printedDesignLists[1]->id],
            'printedDesign' => $printedDesign->id,
        ]))->assertOk();

    foreach ($printedDesignLists as $printedDesignList) {
        $this->assertDatabaseHas(
            'printed_design_printed_design_list',
            [
                'printed_design_id' => $printedDesign->id,
                'printed_design_list_id' => $printedDesignList->id,
            ]);
    }

    // TODO remove loadMissing when eager loading is sorted on PrintedDesign
    $this->assertJsonResponseContent(PrintedDesignResource::make($printedDesign->loadMissing('printedDesignSetting')), $response);
});
