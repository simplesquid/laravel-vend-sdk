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
     * or "oauth2" for OAUTH 2.0 authentication.
     */
    'authorisation' => env('VEND_AUTHORISATION', 'oauth2'),

    /*
     * Fields required for authentication using a
     * personal access token.
     */
    'personal' => [
        'domain_prefix' => env('VEND_DOMAIN_PREFIX', ''),
        'access_token'  => env('VEND_ACCESS_TOKEN', ''),
    ],

    /*
     * Fields required for authentication using OAUTH 2.0.
     */
    'oauth2' => [
        'client_id'     => env('VEND_CLIENT_ID', ''),
        'client_secret' => env('VEND_CLIENT_SECRET', ''),
        'redirect_uri'  => env('VEND_REDIRECT_URI', ''),
    ],
];
