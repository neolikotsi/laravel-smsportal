<?php

namespace Illuminate\Notifications\Channels;

use NeoLikotsi\SMSPortal\RestClient;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SMSPortalMessage;

class SMSPortalChannel
{
    /**
     * The SMSPortal client instance
     *
     * @var RestClient
     */
    protected $smsPortal;

    /**
    * Create a new SMSPortal channel instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->smsPortal = new RestClient(config('smsportal.client_id'), config('smsportal.secret'), config('smsportal.base_uri'));
    }

    /**
    * Send the given notification.
    *
    * @param  mixed  $notifiable
    * @param  \Illuminate\Notifications\Notification  $notification
    * @return \NeoLikotsi\SMSPortal\RestClient
    */
    public function send($notifiable, Notification $notification)
    {
        if (app()->environment(config('smsportal.delivery_environment'))) {
            return;
        }

        if (!$to = $notifiable->routeNotificationFor('smsportal', $notification)) {
            return;
        }

        $message = $notification->toSmsPortal($notifiable);

        if (is_string($message)) {
            $message = new SMSPortalMessage($message);
        }

        return $this->smsPortal->message()->send([
            'messages' => [
                'destination' => $to,
                'content' => $message->content,
            ]
        ]);
    }
}
