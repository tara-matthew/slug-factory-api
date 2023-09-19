<?php

namespace Tests\Feature;

use App\Models\Favourite;
use App\Models\FilamentBrand;
use App\Models\FilamentColour;
use App\Models\PrintedDesign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class FavouritePrintedDesignControllerTest extends TestCase
{
    use RefreshDatabase;
    use AdditionalAssertions;

    private FilamentBrand $brand;

    private FilamentColour $colour;

    public function setUp(): void
    {
        parent::setUp();
        $this->brand = FilamentBrand::factory()->create();
        $this->colour = FilamentColour::factory()->create();
    }

    /** @test */
    public function it_returns_a_list_of_favourite_prints(): void
    {
        // arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        Favourite::factory(['user_id' => $user->id])->count(3)->for(
            PrintedDesign::factory(),
            'favouritable'
        )->create();

        // act
        $response = $this->getJson("/api/users/$user->id/favourite-printed-designs");

        // assert
        $response
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'user_id',
                        'title',
                        'description',
                        'filament_brand_id',
                        'filament_colour_id',
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_returns_an_empty_collection_of_favourite_prints_when_no_records_exist(): void
    {
        // arrange

        // act
        $response = $this->getJson("/");

        // assert
        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }
//
//    /** @test */
//    public function it_returns_a_specific_(): void
//    {
//        // arrange
//        $ = ::factory()->create();
//
//        // act
//        $response = $this->getJson("/");
//
//        // assert
//        $response
//            ->assertOk()
//            ->assertJson([
//                'data' => [
//                    'id' => $->id,
//                ],
//            ]);
//    }
//
//    /** @test */
//    public function it_stores_a_(): void
//    {
//        // arrange
//
//        // act
//        $response = $this->postJson("/");
//
//        // assert
//        $response
//            ->assertStatus(201)
//            ->assertJson([
//                'data' => [
//
//                ],
//            ]);
//    }
//
//    /** @test */
//    public function store_validates_using_a_form_request(): void
//    {
//        $this->assertActionUsesFormRequest(
//
//        );
//    }

    // TODO add a test to check when user isn't authorised
}
