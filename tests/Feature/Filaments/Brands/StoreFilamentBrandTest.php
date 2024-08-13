<?php

use App\Filaments\Brands\Controllers\StoreFilamentBrandController;
use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

it('stores a filament brand', function () {
    $this->postJson(route('filament-brands.store'), [
        'name' => 'My name',
    ])
        ->assertCreated()
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.name', 'My name')
        );
});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        StoreFilamentBrandController::class,
        '__invoke',
        StoreFilamentBrandRequest::class
    );
});
