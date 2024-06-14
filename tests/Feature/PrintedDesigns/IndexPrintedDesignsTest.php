<?php

namespace Tests\Feature\PrintedDesigns;

use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IndexPrintedDesignsTest extends TestCase
{
    #[Test]
    public function it_returns_a_list_of_prints(): void
    {
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

        $response = $this->getJson(route('prints.index'));

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

    #[Test]
    public function it_returns_an_empty_collection_of_prints_when_no_records_exist()
    {
        /**
         * @var User $user
         * @var PrintedDesign $print
         */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson(route('prints.index'));

        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }
}
