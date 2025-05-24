<?php

use App\PrintedDesignLists\Controllers\UpdatePrintedDesignPrintedDesignListsController;
use App\PrintedDesignLists\Models\PrintedDesignList;
use App\PrintedDesignLists\Requests\UpdatePrintedDesignPrintedDesignListsRequest;
use App\PrintedDesigns\Resources\PrintedDesignResource;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('adds a printed design to lists', function () {
    $user = User::factory()->create();
    $printedDesignLists = PrintedDesignList::factory(2)->create();
    $printedDesign = PrintedDesign::factory()->create();

    $response = $this
        ->actingAs($user)
        ->postJson(route('my.prints.print-lists.update', [
            'printed_design_list_add_ids' => [$printedDesignLists[0]->id, $printedDesignLists[1]->id],
            'printed_design_list_remove_ids' => [],
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

it('removes a printed design from lists', function () {
    $user = User::factory()->create();
    $printedDesignLists = PrintedDesignList::factory(2)->create();
    $printedDesign = PrintedDesign::factory()
        ->hasAttached($printedDesignLists)
        ->create();

    foreach ($printedDesignLists as $printedDesignList) {
        $this->assertDatabaseHas(
            'printed_design_printed_design_list',
            [
                'printed_design_id' => $printedDesign->id,
                'printed_design_list_id' => $printedDesignList->id,
            ]);
    }

    $response = $this
        ->actingAs($user)
        ->postJson(route('my.prints.print-lists.update', [
            'printed_design_list_add_ids' => [],
            'printed_design_list_remove_ids' => [$printedDesignLists[0]->id, $printedDesignLists[1]->id],
            'printedDesign' => $printedDesign->id,
        ]))->assertOk();

    foreach ($printedDesignLists as $printedDesignList) {
        $this->assertDatabaseMissing(
            'printed_design_printed_design_list',
            [
                'printed_design_id' => $printedDesign->id,
                'printed_design_list_id' => $printedDesignList->id,
            ]);
    }

    $this->assertJsonResponseContent(PrintedDesignResource::make($printedDesign->loadMissing('printedDesignSetting')), $response);

});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        UpdatePrintedDesignPrintedDesignListsController::class,
        '__invoke',
        UpdatePrintedDesignPrintedDesignListsRequest::class
    );
});
