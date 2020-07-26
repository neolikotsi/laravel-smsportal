<?php

/**
 * The SMSPortal api credentials
 */

return [
    'client_id' => env('SMS_PORTAL_CLIENT_ID'),
    'secret' => env('SMS_PORTAL_SECRET'),
    'base_uri' => env('SMS_PORTAL_URL', 'https://rest.smsportal.com/v1/'),
    'delivery_environment' => [
        'production' => env('SMS_PORTAL_DELIVERY_ENABLED', env('SMS_PORTAL_DELIVERY_ENABLED_PRODUCTION', true)),
        'staging' => env('SMS_PORTAL_DELIVERY_ENABLED', env('SMS_PORTAL_DELIVERY_ENABLED_STAGING', true)),
        'develop' => env('SMS_PORTAL_DELIVERY_ENABLED', env('SMS_PORTAL_DELIVERY_ENABLED_DEVELOP', true)),
        'testing' => env('SMS_PORTAL_DELIVERY_ENABLED', env('SMS_PORTAL_DELIVERY_ENABLED_TESTING', false)),
        ],
];
