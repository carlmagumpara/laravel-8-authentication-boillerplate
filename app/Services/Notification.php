<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\UserNotification;
use App\Notifications\AppointmentNotification;
use App\Notifications\ReservationNotification;
use App\Notifications\BillNotification;
use Berkayk\OneSignal\OneSignalClient;
use Illuminate\Notifications\Notifiable;

/**
 * A service class to send notification.
 *
 * @return bool
 */
class Notification
{
    public static $oneSignalClient;
    public static $baseUrl;

    public static function init()
    {
        self::$oneSignalClient = new OneSignalClient(
            config('onesignal.app_id'),
            config('onesignal.rest_api_key'),
            config('onesignal.user_auth_key')
        );
        self::$baseUrl = \URL::to('/');
    }

    public static function send($notification = [], $replace = [])
    {
        self::init();

        if (! empty($notification['notify_id'])) {
            
            $user = User::find($notification['notify_id']);
            $notification['opened'] = false;
            $notification['archived'] = false;
            if (! empty($notification['id'])) {
                $notification['id'] = (int) $notification['id'];
            }
            $notification['notify_id'] = (int) $notification['notify_id'];
            $notification['owner_id'] = (int) $notification['owner_id'];
            $notification['content'] = $notification['content'];

            switch ($notification['key']) {
                case 'bill':
                    $user->notify(new BillNotification($notification));
                    break;
                case 'appointment':
                    $user->notify(new AppointmentNotification($notification));
                    break;
                case 'reservation':
                    $user->notify(new ReservationNotification($notification));
                    break;
                default:
                    $user->notify(new UserNotification($notification));
            }

            $data = $user->notifications()->first();

            try {
                self::$oneSignalClient->sendNotificationUsingTags(
                    $data->data['content'],
                    [
                        json_decode('{"field": "tag", "key": "user_id", "relation": "=", "value": '.(int) $notification['notify_id'].'}'),
                    ],
                    $url = self::$baseUrl,
                    $data = $data,
                    $buttons = null,
                    $schedule = null
                );
            } catch (\Exception $e) {
            }

            return true;
        }

        return false;
    }

    public static function sendPlain(array $notification)
    {
        self::init();

        if (! empty($notification['notify_id'])) {
            self::$oneSignalClient->sendNotificationUsingTags(
                $notification['content'],
                [json_decode('{"field": "tag", "key": "user_id", "relation": "=", "value": '.(int) $notification['notify_id'].'}')],
                $url = $notification['url'],
                $data = null,
                $buttons = null,
                $schedule = null
            );
        } else {
            self::$oneSignalClient->sendNotificationToAll(
                $notification['content'],
                $url = $notification['url'],
                $data = null,
                $buttons = null,
                $schedule = null
            );
        }

        return true;
    }
}
