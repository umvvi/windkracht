<?php

return [
    'default' => env('MAIL_MAILER', 'log'),
    'mailers' => [
        'log' => [
            'driver' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],
    ],
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'noreply@windkracht12.local'),
        'name' => env('MAIL_FROM_NAME', 'Windkracht-12 KiteSurfSchool'),
    ],
];
