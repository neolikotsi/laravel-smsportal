<?php

namespace Illuminate\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SMSPortalMessage;
use SMSPortal\RestClient;

class SMSPortalChannel
{
    /**
     * The SMSPortal client instance
     *
     * @var [type]
     */
    protected $smsPortal;

    /**
    * Create a new SMSPortal channel instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->smsPortal = new RestClient;
    }

    /**
    * Send the given notification.
    *
    * @param  mixed  $notifiable
    * @param  \Illuminate\Notifications\Notification  $notification
    * @return \SMSPortal\RestClient
    */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('smsportal', $notification)) {
            return;
        }

        $message = $notification->toSmsPortal($notifiable);

        if (is_string($message)) {
            $message = new SMSPortalMessage($message);
        }

        return $this->smsPortal->message()->send([
            'destination' => $to,
            'content' => trim($message->content),
        ]);
    }
}
