<?php

namespace Tests\Feature\PrintedDesigns;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShowPrintedDesignTest extends TestCase
{
    #[Test]
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
        $response = $this->getJson(route('prints.show', ['printedDesign' => $print]));

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
}
