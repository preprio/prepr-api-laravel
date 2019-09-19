<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Base Url
    |--------------------------------------------------------------------------
    |
    | The base url of the API to consume.
    |
    */

    'base_url' => env('PREPR_URL'),

    /*
    |--------------------------------------------------------------------------
    | Token
    |--------------------------------------------------------------------------
    |
    | The token of the API to consume.
    |
    */

    'token' => env('PREPR_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Headers
    |--------------------------------------------------------------------------
    |
    | The HTTP headers to be send along in each call
    |
    */

    'headers' => [

    ]

];