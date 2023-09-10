<?php

namespace Tests\Feature;

use App\Http\Controllers\PrintedDesignController;
use App\Http\Requests\StorePrintedDesignRequest;
use App\Models\FilamentBrand;
use App\Models\FilamentColour;
use App\Models\PrintedDesign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class PrintedDesignControllerTest extends TestCase
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

    /**
     * @test
     * @covers \App\Http\Controllers\PrintedDesignController::index
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
        $print = PrintedDesign::factory()->for($user)->create();
        $response = $this->getJson('/api/prints');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $print->id,
                        'user_id' => $user->id,
                        'title' => $print->title,
                        'description' => $print->description,
                        'filament_brand_id' => $print->filament_brand_id,
                        'filament_colour_id' => $print->filament_colour_id
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_returns_an_empty_collection_of_prints_when_no_records_exist()
    {
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
     * @covers \App\Http\Controllers\PrintedDesignController::index
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
                    'filament_colour_id' => $print->filament_colour_id
                ]
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PrintedDesignController::store
     */
    public function it_stores_a_print(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson("/api/prints", [
            'title' => 'My title',
            'description' => 'My description',
            'user_id' => $user->id,
            'filament_brand_id' => $this->brand->id,
            'filament_colour_id' => $this->colour->id
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'My title',
                    'description' => 'My description',
                    'user_id' => $user->id,
                    'filament_brand_id' => $this->brand->id,
                    'filament_colour_id' => $this->colour->id
                ]
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PrintedDesignController::store
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
