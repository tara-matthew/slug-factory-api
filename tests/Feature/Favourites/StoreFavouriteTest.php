<?php

//
//use Domain\Favourites\Models\Favourite;
//use Domain\PrintedDesigns\Events\PrintedDesignFavourited;
//use Domain\PrintedDesigns\Models\PrintedDesign;
//use Domain\Users\Models\User;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Event;
//use Illuminate\Testing\Fluent\AssertableJson;
//use Laravel\Sanctum\Sanctum;
//
//uses(RefreshDatabase::class);
//
//it('stores a favourite', function () {
//    Event::fake();
//
//    $print = PrintedDesign::factory()->create();
//    Sanctum::actingAs(User::factory()->create());
//
//    $this->postJson(route('favourites.store', ['type' => 'printed_design', 'id' => $print->id]))
//        ->assertCreated();
//
//    $this->assertCount(1, Favourite::all());
//    $this->assertDatabaseHas('favourites', [
//        'user_id' => Auth::id(),
//        'favouritable_type' => 'printed_design',
//        'favouritable_id' => $print->id]);
//});
//
//it('throws an exception if an item has already been favourited by the authenticated user, differentiating between different items belonging to the same user', function () {
//    $authenticatedUser = User::factory()->create();
//    Sanctum::actingAs($authenticatedUser);
//
//    $favouritedPrint = PrintedDesign::factory()
//        ->for($authenticatedUser)
//        ->create();
//
//    $secondPrint = PrintedDesign::factory()
//        ->for($authenticatedUser)
//        ->create();
//
//    // Make a favourite for the first print and the current user
//    Favourite::factory()->for(
//        $favouritedPrint, 'favouritable'
//    )->for($authenticatedUser)->create();
//
//    $this->assertCount(1, Favourite::all());
//
//    $this
//        ->postJson(route('favourites.store', ['type' => 'printed_design', 'id' => $favouritedPrint->id]))
//        ->assertUnprocessable()
//        ->assertJson(fn (AssertableJson $json) => $json
//            ->where('message', 'Item has already been added to favourites'));
//
//    $this->assertCount(1, Favourite::all());
//
//});
//
//it('dispatches an event if a printed design is favourited', function () {
//    Event::fake();
//
//    $print = PrintedDesign::factory()->create();
//    Sanctum::actingAs(User::factory()->create());
//
//    $this->postJson(route('favourites.store', ['type' => 'printed_design', 'id' => $print->id]))
//        ->assertCreated();
//
//    Event::assertDispatched(function (PrintedDesignFavourited $event) use ($print) {
//        return $event->printedDesign->id === $print->id && $event->user->id === $print->user_id;
//    });
//});
