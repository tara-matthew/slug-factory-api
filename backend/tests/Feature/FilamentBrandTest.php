<?php

namespace Tests\Feature;

use App\Models\FilamentBrand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilamentBrandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_list_of_filament_brands()
    {
        $filamentBrands = FilamentBrand::factory()->count(3)->create();

        $response = $this->getJson('api/filament-brands');

        $response
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                  '*' =>  [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                    ]
                ]
            ])
            ->assertJson([
                'data' => $filamentBrands->toArray()
            ]);
    }

    /** @test */
    public function it_returns_an_empty_collection_of_filament_brands_when_no_records_exist()
    {
        $response = $this->getJson('api/filament-brands');

        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }
}
