<?php

//
//namespace Tests\Feature;
//
//use Domain\Filaments\Colours\Models\FilamentColour;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use JMac\Testing\Traits\AdditionalAssertions;
//use Tests\TestCase;
//
//class FilamentColourTest extends TestCase
//{
//    use RefreshDatabase;
//    use AdditionalAssertions;
//
//    /** @test */
//    public function it_returns_a_list_of_filament_colours(): void
//    {
//        // arrange
//        $filamentColours = FilamentColour::factory()->count(3)->create();
//
//        // act
//        $response = $this->getJson(route('filament-colours.index'));
//
//        // assert
//        $response
//            ->assertOk()
//            ->assertJsonCount(3, 'data')
//            ->assertJsonStructure([
//                'data' => [
//                    '*' => [
//                        'id',
//                    ],
//                ],
//            ])
//            ->assertJson([
//                'data' => $filamentColours->toArray(),
//            ]);
//    }
//
//    /** @test */
//    public function it_returns_an_empty_collection_of__when_no_records_exist(): void
//    {
//        // arrange
//
//        // act
//        $response = $this->getJson("/api/filament-colours");
//
//        // assert
//        $response
//            ->assertOk()
//            ->assertJsonCount(0, 'data')
//            ->assertJsonStructure([
//                'data' => [],
//            ]);
//    }
//
//    /** @test */
//    public function it_returns_a_specific_filament_colour(): void
//    {
//        // arrange
//        $filamentColour = FilamentColour::factory()->create();
//
//        // act
//        $response = $this->getJson("/api/filament-colours");
//
//        // assert
//        $response
//            ->assertOk()
//            ->assertJson([
//                'data' => [
//                    'id' => $filamentColour->id,
//                ],
//            ]);
//    }
//
//    /** @test */
//    public function it_stores_a_filament_colour(): void
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
//}
