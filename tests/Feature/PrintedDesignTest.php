<?php

namespace Tests\Feature;

use App\PrintedDesigns\Controllers\PrintedDesignController;
use App\PrintedDesigns\Requests\StorePrintedDesignRequest;
use Domain\Favourites\Models\Favourite;
use Domain\Filaments\Brands\Models\FilamentBrand;
use Domain\Filaments\Colours\Models\FilamentColour;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class PrintedDesignTest extends TestCase
{
    // TODO add images into responses for test
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

    /**
     * @test
     * @covers \App\PrintedDesigns\Controllers\PrintedDesignController::index
     *
     * @return void
     */
    public function it_returns_a_list_of_prints(): void
    {
        // TODO Add several prints rather than just one
        /**
         * @var User $user
         * @var PrintedDesign $print
         */
        $user = User::factory()->create();
        $this->actingAs($user);
        $prints = PrintedDesign::factory(2)->hasImages()->for($user)->create();

        // Make a favourite for the first print and the current user
        Favourite::factory()->for(
            $prints[0], 'favouritable'
        )->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/prints');

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'id' => $prints[0]->id,
                        'user_id' => $user->id,
                        'title' => $prints[0]->title,
                        'description' => $prints[0]->description,
                        'filament_brand_id' => $prints[0]->filament_brand_id,
                        'filament_colour_id' => $prints[0]->filament_colour_id,
                        'is_favourite' => true
                    ],
                    [
                        'id' => $prints[1]->id,
                        'user_id' => $user->id,
                        'title' => $prints[1]->title,
                        'description' => $prints[1]->description,
                        'filament_brand_id' => $prints[1]->filament_brand_id,
                        'filament_colour_id' => $prints[1]->filament_colour_id,
                        'is_favourite' => false
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_returns_an_empty_collection_of_prints_when_no_records_exist()
    {
        /**
         * @var User $user
         * @var PrintedDesign $print
         */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('api/prints');

        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }

    /**
     * @test
     * @covers
     */
    public function it_returns_a_specific_print(): void
    {
        /**
         * @var User $user
         * @var PrintedDesign $print
         */
        $user = User::factory()->create();
        $this->actingAs($user);
        // TODO Use 'has' magic method with the factory
        $print = PrintedDesign::factory()->for($user)->create();
        $response = $this->getJson("/api/prints/$print->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $print->id,
                    'user_id' => $user->id,
                    'title' => $print->title,
                    'description' => $print->description,
                    'filament_brand_id' => $print->filament_brand_id,
                    'filament_colour_id' => $print->filament_colour_id,
                ],
            ]);
    }

    /**
     * @test
     * @covers \App\PrintedDesigns\Controllers\PrintedDesignController::store
     */
    public function it_stores_a_print(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/prints', [
            'title' => 'My title',
            'description' => 'My description',
            'user_id' => $user->id,
            'filament_brand_id' => $this->brand->id,
            'filament_colour_id' => $this->colour->id,
            'images' => [
                ['url' => 'test', 'is_cover_image' => true]
            ],
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'My title',
                    'description' => 'My description',
                    'user_id' => $user->id,
                    'filament_brand_id' => $this->brand->id,
                    'filament_colour_id' => $this->colour->id,
                    'images' => [
                        [
                            'url' => 'test',
                            'is_cover_image' => true,
                        ]
                    ]
                ],
            ]);
    }

    /**
     * @test
     * @covers \App\PrintedDesigns\Controllers\PrintedDesignController::store
     */
    public function store_validates_using_a_form_request(): void
    {
        $this->assertActionUsesFormRequest(
            PrintedDesignController::class,
            'store',
            StorePrintedDesignRequest::class
        );
    }
}
