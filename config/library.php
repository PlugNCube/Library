<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Library  Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('LIBRARY_NAME', 'Library'),

    /*
    |--------------------------------------------------------------------------
    | Library plugs assets url http://domain.com/asests/{id}/{path}
    |--------------------------------------------------------------------------
    */
    'assets' => [
        'route' => '/library/assets/{id}/{patch}'
    ],

    /*
    |--------------------------------------------------------------------------
    | Library´s scan
    |--------------------------------------------------------------------------
    */
    'scan' => [
        'filename' => 'apply.json',
        'folder' => base_path('common'),
    ],
];
