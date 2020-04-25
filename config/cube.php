<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Collections namespace
    |--------------------------------------------------------------------------
    |
    | This is the default namespace for the managers
    |
    */
    'namespace' => 'Cubes',

    /*
    |--------------------------------------------------------------------------
    | Plugins alias
    |--------------------------------------------------------------------------
    |
    | This is the default alias for the packages
    |
    */

    'alias'     => 'cube',

    /*
    |--------------------------------------------------------------------------
    | Plugins vendor if use composer require or install
    |--------------------------------------------------------------------------
    |
    | This is the default vendor for the plugin
    |  -> path/vendor/name
    |
    */

    'vendor'     => 'plugins',


    /*
    |--------------------------------------------------------------------------
    | Collections path
    |--------------------------------------------------------------------------
    |
    | This path used for save the generated module. This path also will added
    | automatically to list of scanned folders.
    |
    */
    'path'  => lib_path('plugins'),

    /*
    |--------------------------------------------------------------------------
    | Collections Stubs
    |--------------------------------------------------------------------------
    |
    | Default collection stubs.
    |
    */
    'stubs' => [
        'path' => realpath(LIBRARY_PATH.'/src/Console/stubs'),
        'files'  => [
            'apply'                 => 'apply.json',
            'license'               => 'LICENCE.md',
            'composer'              => 'composer.json',
            'configCollection'      => 'config/configCollection.php',
            'ClassCollection'       => 'src/ClassCollection.php',
            'SetupCollection'      => 'src/Apply/Setup.php',
            'RouteServiceProvider'  => 'src/Providers/RouteServiceProvider.php',
            'AppServiceProvider'    => 'src/Providers/AppServiceProvider.php',
            'Controller'            => 'src/Http/Controllers/Controller.php',
        ],
    ],
];
