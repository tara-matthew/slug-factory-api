<?php

namespace Tests\Unit\FormRequest;

use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use JMac\Testing\Traits\AdditionalAssertions;

uses(AdditionalAssertions::class);

it('has rules set up correctly', function () {
    $storeFilamentBrandRequest = new StoreFilamentBrandRequest;

    $this->assertEquals(
        [
            'name' => ['required', 'string', 'max:255'],
        ],

        $storeFilamentBrandRequest->rules()
    );
});
