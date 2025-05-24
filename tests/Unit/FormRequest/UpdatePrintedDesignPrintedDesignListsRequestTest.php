<?php

use App\PrintedDesignLists\Requests\UpdatePrintedDesignPrintedDesignListsRequest;
use JMac\Testing\Traits\AdditionalAssertions;

uses(AdditionalAssertions::class);

it('has rules set up correctly', function () {
    $request = new UpdatePrintedDesignPrintedDesignListsRequest;

    $this->assertEquals(
        [
            'printed_design_list_add_ids' => ['sometimes', 'array'],
            'printed_design_list_remove_ids' => ['sometimes', 'array'],
            'printed_design_list_add_ids.*' => ['sometimes', 'integer', 'exists:printed_design_lists,id'],
            'printed_design_list_remove_ids.*' => ['sometimes', 'integer', 'exists:printed_design_lists,id'],
        ],

        $request->rules()
    );
});
