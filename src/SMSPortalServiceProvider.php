<?php

namespace Illuminate\Notifications;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class SMSPortalServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/smsportal.php' => config_path('smsportal.php')
        ], 'config');
    }

    public function register()
    {
        Notification::extend('smsportal', function ($app) {
            return new Channels\SMSPortalChannel();
        });
    }
}
