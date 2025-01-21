<?php

namespace Domain\Notifications\Actions;

use Domain\Notifications\DataTransferObjects\NotificationData;
use Domain\Notifications\Models\Notification;
use Exception;
use Illuminate\Support\Facades\Log;

class CreateNotificationAction
{
    public function execute(NotificationData $notificationData)
    {
        $notification = Notification::make([
            'title' => $notificationData->title,
            'body' => $notificationData->body,
            'channel' => $notificationData->channel,
        ]);

        $notification->user()->associate($notificationData->user);

        $notification->save();

        try {
            $notificationData->user->notify(new $notificationData->notification_type($notification));
        } catch (Exception $e) {
            Log::error('Error sending  notification of type '.$notificationData->notification_type.' to user ID '.$notificationData->user->id.': '.$e->getMessage());
            // TODO implement failed status here
        }

        return $notification;
    }

}
