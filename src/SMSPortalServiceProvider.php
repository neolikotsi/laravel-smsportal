<?php

namespace Illuminate\Notifications;

use Illuminate\Support\ServiceProvider;

class SMSPortalServiceProvider extends ServiceProvider
{
    public function register()
    {
        Notification::extend('smsportal', function ($app) {
            return new Channels\SMSPortalChannel();
        });
    }
}
