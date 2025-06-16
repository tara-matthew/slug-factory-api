<?php

use App\Favourites\Requests\IndexFavouritesRequest;
use App\Users\Requests\LoginUserRequest;
use JMac\Testing\Traits\AdditionalAssertions;

uses(AdditionalAssertions::class);

it('has rules set up correctly', function () {
    $indexFavouritesRequest = new IndexFavouritesRequest();

    $this->assertEquals(
        [
            'type' => ['required', 'string', 'in:printed_design,filament_brand,printer,printer_filament'],
        ],

        $indexFavouritesRequest->rules()
    );
});
