<?php

namespace Tests\Feature;

use App\Models\PrintedDesign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrintedDesignControllerTest extends TestCase
{
    use RefreshDatabase;

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
     * @return void
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
}
