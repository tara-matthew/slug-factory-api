<?php

namespace Tests\Feature;

use App\Filaments\Brands\Controllers\FilamentBrandController;
use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FilamentBrandTest extends TestCase
{
    #[Test]
    public function it_returns_a_list_of_filament_brands()
    {
        // arrange
        $filamentBrands = FilamentBrand::factory()->count(3)->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->getJson('api/filament-brands');

        // assert
        $response
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ])
            ->assertJson([
                'data' => $filamentBrands->toArray(),
            ]);
    }

    #[Test]
    public function it_returns_an_empty_collection_of_filament_brands_when_no_records_exist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('api/filament-brands');

        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    #[Test]
    public function it_returns_a_specific_filament_brand(): void
    {
        /**
         * @var FilamentBrand $filamentBrand
         */
        $filamentBrand = FilamentBrand::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson("/api/filament-brands/$filamentBrand->id");

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $filamentBrand->id,
                    'name' => $filamentBrand->name,
                ],
            ]);
    }

    #[Test]
    public function it_stores_a_filament_brand(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/filament-brands', [
            'name' => 'My name',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'My name',
                ],
            ]);
    }

    #[Test]
    public function store_validates_using_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            FilamentBrandController::class,
            'store',
            StoreFilamentBrandRequest::class
        );
    }
}
