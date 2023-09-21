<?php

namespace Tests\Feature;

use App\Http\Controllers\FilamentBrandController;
use App\Http\Requests\StoreFilamentBrandRequest;
use App\Models\FilamentBrand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class FilamentBrandControllerTest extends TestCase
{
    use RefreshDatabase;
    use AdditionalAssertions;

    /** @test */
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

    /** @test */
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

    /** @test  */
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

    /** @test */
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

    /** @test */
    public function store_validates_using_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            FilamentBrandController::class,
            'store',
            StoreFilamentBrandRequest::class
        );
    }
}
