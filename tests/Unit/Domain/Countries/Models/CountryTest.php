<?php

use Domain\Users\Models\Country;
use Domain\Users\Models\User;
use Tests\TestCase;

uses(TestCase::class);

test('relations', function () {
    $country = Country::factory()->hasUsers(2)->create();

    expect($country->users)->each->toBeInstanceOf(User::class);
});
