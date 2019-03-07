### SMS Portal Notification Channel for laravel

## SMS Notifications

## Installation

Send SMS notifications in Laravel powered by [SMSPortal](https://www.smsportal.com/). Before you can send notifications via SMSPortal, you need to install the `neolikotsi/laravel-smsportal` Composer package:

```bash
composer require neolikotsi/laravel-smsportal
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="Illuminate\Notifications\SMSPortalServiceProvider"
```

This is the contents of the published config file:

```php
return [
    'client_id' => env('SMS_PORTAL_CLIENT_ID'),
    'secret' => env('SMS_PORTAL_SECRET'),
];
```

## Formatting SMS Notifications

If a notification supports being sent as an SMS, you should define a `toSmsPortal` method on the notification class. This method will receive a `$notifiable` entity and should return a `Illuminate\Notifications\Messages\SMSPortalMessage` instance:

```php
/**
 * Get the SMSPortal / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
    * @return SMSPortalMessage
    */
public function toSmsPortal($notifiable)
{
    return (new SMSPortalMessage)
                ->content('Your SMS message content');
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.