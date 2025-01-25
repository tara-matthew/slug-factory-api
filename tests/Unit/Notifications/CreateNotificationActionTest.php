<?php

use Domain\Notifications\Actions\CreateNotificationAction;
use Domain\Notifications\DataTransferObjects\NotificationData;
use Domain\Notifications\Enums\NotificationChannel;
use Domain\PrintedDesigns\Notifications\PrintedDesignUploaded;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Tests\TestCase;

uses(RefreshDatabase::class);
uses(TestCase::class);

it('creates a notification', function () {
    NotificationFacade::fake();

    $action = new CreateNotificationAction;

    $user = User::factory()->create();

    $notificationData = NotificationData::from([
        'user' => $user,
        'title' => 'A notification',
        'body' => 'A new notification has arrived',
        'notification_type' => PrintedDesignUploaded::class,
        'channel' => NotificationChannel::PUSH,
    ]);

    $this->assertDatabaseCount('notifications', 0);

    $action->execute($notificationData);

    NotificationFacade::assertSentTo($user, PrintedDesignUploaded::class);
    NotificationFacade::assertCount(1);

    $this->assertDatabaseCount('notifications', 1);

    $this->assertDatabaseHas('notifications', [
        'user_id' => $user->id,
        'title' => 'A notification',
        'body' => 'A new notification has arrived',
        'channel' => NotificationChannel::PUSH,
        'read_at' => null,
    ]);
});
