<?php

use Domain\PrintedDesigns\Events\PrintedDesignFavourited;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\PrintedDesigns\Notifications\PrintedDesignFavourited as PrintedDesignFavouritedNotification;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

uses(RefreshDatabase::class);
uses(TestCase::class);

it('only sends a notification to the owner of the printed design when the event is fired', function () {
    Notification::fake();

    $userWithPrintedDesign = User::factory()->create();
    $printedDesign = PrintedDesign::factory()->for($userWithPrintedDesign)->create();

    $otherUsers = User::factory(5)->create();

    PrintedDesignFavourited::dispatch($printedDesign, $userWithPrintedDesign);

    Notification::assertSentTo([$userWithPrintedDesign], PrintedDesignFavouritedNotification::class);
    Notification::assertNotSentTo([$otherUsers], PrintedDesignFavouritedNotification::class);
});
