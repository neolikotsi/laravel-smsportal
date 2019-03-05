<?php

namespace Illuminate\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SMSPortalMessage;

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
    * @param  \SMSPortal\Client  $smsPortal
    * @return void
    */
    public function __construct(SMSPortalClient $smsPortal)
    {
        $this->smsPortal = $smsPortal;
    }

    /**
    * Send the given notification.
    *
    * @param  mixed  $notifiable
    * @param  \Illuminate\Notifications\Notification  $notification
    * @return \Nexmo\Message\Message
    */
    public function sent($notifiable, Notification $notification)
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
