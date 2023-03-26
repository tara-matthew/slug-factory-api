<?php

namespace Tests\Feature;

use App\Http\Controllers\PrintedDesignController;
use App\Http\Requests\StorePrintedDesignRequest;
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

    /**
     * @test
     * @covers \App\Http\Controllers\PrintedDesignController::index
     * @return void
     */
    public function it_returns_a_list_of_prints(): void
    {
        /**
         * @var User $user
         * @var PrintedDesign $print
         */
        $user = User::factory()->create();
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
                        'description' => $print->description
                    ]
                ]
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
        $print = PrintedDesign::factory()->for($user)->create();
        $response = $this->getJson("/api/prints/$print->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $print->id,
                    'user_id' => $user->id,
                    'title' => $print->title,
                    'description' => $print->description
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
        $response = $this->postJson("/api/prints", [
            'title' => 'My title',
            'description' => 'My description',
            'user_id' => $user->id
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'My title',
                    'description' => 'My description',
                    'user_id' => $user->id
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
