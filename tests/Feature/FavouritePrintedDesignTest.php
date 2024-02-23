<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class FavouritePrintedDesignTest extends TestCase
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
        $this->createFavouritesForUser($user);

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
        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->getJson("/api/users/$user->id/favourite-printed-designs/");

        // assert
        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    /** @test */
    public function it_stores_a_favourite_print(): void
    {
        // arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        $print = PrintedDesign::factory()->create();

        // act
        $response = $this->patchJson("/api/users/$user->id/favourite-printed-designs/$print->id");
        $decodedResponse = json_decode($response->getContent());

        // assert
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => $decodedResponse->data->id,
                    'user_id' => $decodedResponse->data->user_id,
                    'favouritable_type' => $decodedResponse->data->favouritable_type,
                    'favouritable_id' => $decodedResponse->data->favouritable_id,
                ],
            ]);
    }
//
//    /** @test */
//    public function store_validates_using_a_form_request(): void
//    {
//        $this->assertActionUsesFormRequest(
//
//        );
//    }

    // TODO add a test to check when user isn't authorised

    private function createFavouritesForUser(User $user, int $count = 3): void
    {
        for ($i = 0; $i < $count; $i++) {
            Favourite::factory(['user_id' => $user->id])->for(
                PrintedDesign::factory(),
                'favouritable'
            )->create();
        }

    }
}
