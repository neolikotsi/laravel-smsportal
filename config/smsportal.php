<?php

/**
 * The SMSPortal api credentials
 */

return [
    'client_id' => env('SMS_PORTAL_CLIENT_ID'),
    'secret' => env('SMS_PORTAL_SECRET'),
    'base_uri' => env('SMS_PORTAL_URL', 'https://rest.smsportal.com/v1/'),
    'delivery_environment' => env('SMS_PORTAL_ENVIRONMENT', 'production'),
];
