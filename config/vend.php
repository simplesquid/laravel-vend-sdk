<?php

return [
    /*
     * The driver to use to interact with Vend API.
     * You may use "log" or "null" to prevent calling the
     * API directly from your environment.
     */
    'driver'        => env('VEND_DRIVER', 'api'),

    /*
     * The user agent to be used when interacting with
     * the Vend API.
     */
    'user_agent'    => env('VEND_USER_AGENT', 'Laravel Vend SDK'),

    /*
     * The authentication method to be used.
     * Can be "personal" for a personal access token
     * or "oauth" for OAUTH 2.0 authentication.
     */
    'authorisation' => env('VEND_AUTHORISATION', 'oauth'),

    /*
     * Fields required for authentication using a
     * personal access token.
     */
    'personal'      => [
        /*
         * Vend domain prefix.
         */
        'domain_prefix' => env('VEND_DOMAIN_PREFIX', ''),

        /*
         * Vend personal access token.
         */
        'access_token'  => env('VEND_ACCESS_TOKEN', ''),
    ],

    /*
     * Fields required for authentication using OAuth 2.0.
     */
    'oauth'         => [
        /*
         * Vend API Client ID.
         */
        'client_id'     => env('VEND_CLIENT_ID', ''),

        /*
         * Vend API Client Secret.
         */
        'client_secret' => env('VEND_CLIENT_SECRET', ''),

        /*
         * Replace with your own token manage class which
         * implements \SimpleSquid\LaravelVend\VendTokenManager.
         */
        'token_manager' => \SimpleSquid\LaravelVend\VendTokenManager::class,
    ],

    /*
     * The number of seconds before a queued request job
     * should timeout.
     */
    'queue_timeout' => env('VEND_QUEUE_TIMEOUT', 5),

    /*
     * Model observers to register.
     * e.g. Product::class => VendProductObserver::class,
     */
    'observers'     => [
        //
    ],
];
