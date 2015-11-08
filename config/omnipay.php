<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Provider Connection
    |--------------------------------------------------------------------------
    |
    | This option controls the default provider connection that gets used while
    | using this omnipay library. This connection is used when another is
    | not explicitly specified when executing a given payment function.
    |
    */

    'default' => 'Stripe',

    /*
    |--------------------------------------------------------------------------
    | Available Provider
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information providers that is used
    | by your application. A default configuration has been added for each
    | payment connection. You are free to add more.
    |
    */

    'providers' => [
        'Stripe' => [
            'apiKey'   => env('OMNIPAY_STRIPE_APIKEY'),
            'testMode' => env('OMNIPAY_STRIPE_TESTMODE', false),
        ],
    ],
];
