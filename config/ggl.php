<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Calendar App Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your Google OAuth Application
    |
    */
    'app_name' => env('GGL_APPNAME', ''),
    /*
    |--------------------------------------------------------------------------
    | Google Calendar Client ID
    |--------------------------------------------------------------------------
    |
    | This value is the client ID of your Google OAuth Application
    |
    */
    'client_id' => env('GGL_CLIENTID', ''),
    /*
    |--------------------------------------------------------------------------
    | Google Calendar Client Secret
    |--------------------------------------------------------------------------
    |
    | This value is the client secret of your Google OAuth Application
    |
    */
    'client_secret' => env('GGL_SECRET', ''),
    /*
    |--------------------------------------------------------------------------
    | Google OAuth Redirect URI
    |--------------------------------------------------------------------------
    |
    | Redirect if the request to user is accepted
    |
    */
    'redirect_uri' => env('GGL_REDIRECT_URI', '')
];
