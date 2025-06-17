<?php

use Domain\Notifications\Actions\CreateNotificationAction;
use Domain\PrintedDesigns\Events\PrintedDesignUploaded;
use Domain\PrintedDesigns\Listeners\SendPrintedDesignUploadedMailNotification;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\PrintedDesigns\Notifications\PrintedDesignUploaded as PrintedDesignUploadedNotification;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

uses(RefreshDatabase::class);
uses(TestCase::class);

it('sends a notification when the event is fired', function () {
    Notification::fake();

    $users = User::factory(5)->create();
    $printedDesign = PrintedDesign::factory()->create();

    PrintedDesignUploaded::dispatch($printedDesign);

    Notification::assertSentTo([$users], PrintedDesignUploadedNotification::class);
});

it('sends notifications to all users via the listener', function () {
    Notification::fake();

    $users = User::factory()->create();
    $printedDesign = PrintedDesign::factory()->create([
        'title' => 'Test Design',
    ]);

    $listener = new SendPrintedDesignUploadedMailNotification(
        app(CreateNotificationAction::class)
    );

    $listener->handle(new PrintedDesignUploaded($printedDesign));

    Notification::assertSentTo([$users], PrintedDesignUploadedNotification::class);
});
