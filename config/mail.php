<?php

return [
    'default' => env('MAIL_MAILER', 'log'),
    'mailers' => [
        'log' => [
            'driver' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL', 'stack'),
        ],
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ],
        'mailgun' => [
            'transport' => 'mailgun',
        ],
        'sendgrid' => [
            'transport' => 'sendgrid',
        ],
    ],
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'noreply@windkracht12.local'),
        'name' => env('MAIL_FROM_NAME', 'Windkracht-12 KiteSurfSchool'),
    ],
];
