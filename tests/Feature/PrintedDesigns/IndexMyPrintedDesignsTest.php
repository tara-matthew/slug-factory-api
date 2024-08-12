<?php

namespace Tests\Feature\PrintedDesigns;

use Domain\Favourites\Models\Favourite;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IndexMyPrintedDesignsTest extends TestCase
{
    #[Test]
    public function it_returns_a_list_of_prints(): void
    {
        $user = User::factory()->create();
        $prints = PrintedDesign::factory(2)->hasImages()->for($user)->create();

        // Make a favourite for the first print and the current user
        Favourite::factory()->for(
            $prints[0], 'favouritable'
        )->for($user)->create();

        $this
            ->actingAs($user)
            ->getJson(route('my.prints.index'))
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json
                ->where('data.0.id', $prints[0]->id)
                ->where('data.0.user_id', $user->id)
                ->where('data.0.title', $prints[0]->title)
                ->where('data.0.description', $prints[0]->description)
                ->where('data.0.filament_brand_id', $prints[0]->filament_brand_id)
                ->where('data.0.filament_colour_id', $prints[0]->filament_colour_id)
                ->where('data.0.is_favourite', true)
                ->where('data.1.id', $prints[1]->id)
                ->where('data.1.user_id', $user->id)
                ->where('data.1.title', $prints[1]->title)
                ->where('data.1.description', $prints[1]->description)
                ->where('data.1.filament_brand_id', $prints[1]->filament_brand_id)
                ->where('data.1.filament_colour_id', $prints[1]->filament_colour_id)
                ->where('data.1.is_favourite', false)
            ->etc());
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

        $response = $this->getJson(route('my.prints.index'));

        $response
            ->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonStructure([
                'data' => [],
            ]);
    }
}
