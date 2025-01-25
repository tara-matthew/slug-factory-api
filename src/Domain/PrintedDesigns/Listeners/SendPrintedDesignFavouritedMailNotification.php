<?php

namespace Domain\PrintedDesigns\Listeners;

use Domain\Notifications\Actions\CreateNotificationAction;
use Domain\Notifications\DataTransferObjects\NotificationData;
use Domain\Notifications\Enums\NotificationChannel;
use Domain\PrintedDesigns\Events\PrintedDesignFavourited;
use Domain\PrintedDesigns\Notifications\PrintedDesignFavourited as PrintedDesignFavouritedNotification;

class SendPrintedDesignFavouritedMailNotification
{
    public function __construct(private readonly CreateNotificationAction $createNotificationAction) {}

    public function handle(PrintedDesignFavourited $event): void
    {
        $notificationData = NotificationData::from([
            'user' => $event->user,
            'title' => $event->printedDesign->title.' has been favourited!',
            'body' => 'Someone favourited your print, '.$event->printedDesign->title.'.',
            'notification_type' => PrintedDesignFavouritedNotification::class,
            'channel' => NotificationChannel::MAIL,
        ]);

        $this->createNotificationAction->execute($notificationData);
    }
}
