<?php

namespace Tests\Unit\FormRequest;

use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use App\PrintedDesignLists\Requests\StorePrintedDesignListRequest;
use JMac\Testing\Traits\AdditionalAssertions;

uses(AdditionalAssertions::class);

it('has rules set up correctly', function () {
    $storePrintedDesignListRequest = new StorePrintedDesignListRequest();

    $this->assertEquals(
        [
            'name' => ['required', 'string', 'min:1', 'max:255'],
        ],

        $storePrintedDesignListRequest->rules()
    );
});
