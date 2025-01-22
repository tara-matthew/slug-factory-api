<?php

namespace Domain\PrintedDesigns\Listeners;

use Domain\Notifications\Actions\CreateNotificationAction;
use Domain\Notifications\DataTransferObjects\NotificationData;
use Domain\Notifications\Enums\NotificationChannel;
use Domain\PrintedDesigns\Events\PrintedDesignUploaded;
use Domain\PrintedDesigns\Notifications\PrintedDesignUploaded as PrintedDesignUploadedNotification;
use Domain\Users\Models\User;

class SendPrintedDesignUploadedMailNotification
{
    public function __construct(private readonly CreateNotificationAction $createNotificationAction) {}

    public function handle(PrintedDesignUploaded $event): void
    {
        User::chunkById(50, function ($users) use ($event) {
            $users->each(function ($user) use ($event) {
                $notificationData = NotificationData::from([
                    'user' => $user,
                    'title' => $event->printedDesign->title.' has been uploaded!',
                    'body' => 'A new print has been uploaded.',
                    'notification_type' => PrintedDesignUploadedNotification::class,
                    'channel' => NotificationChannel::MAIL,
                ]);

                $this->createNotificationAction->execute($notificationData);
            });
        });
    }
}
