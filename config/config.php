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
    | HTTP Headers
    |--------------------------------------------------------------------------
    |
    | The HTTP headers to be send along in each call
    |
    */

    'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => env('PREPR_TOKEN'),
    ]

];