<?php

use App\Filaments\Brands\Controllers\FilamentBrandController;
use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

it('stores a filament brand', function () {
    $this->postJson(route('filament-brands.store'), [
        'name' => 'My name',
    ])
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJson(fn (AssertableJson $json) => $json
            ->where('data.name', 'My name')
        );
});

it('validates using a form request', function () {
    $this->assertActionUsesFormRequest(
        FilamentBrandController::class,
        'store',
        StoreFilamentBrandRequest::class
    );
});
