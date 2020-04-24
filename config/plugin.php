<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Plugins namespace
    |--------------------------------------------------------------------------
    |
    | This is the default namespace for the plugins
    |
    */
    'namespace' => 'Plugins',


    /*
    |--------------------------------------------------------------------------
    | Plugins alias
    |--------------------------------------------------------------------------
    |
    | This is the default alias for the packages
    |
    */

    'alias'     => 'plugin',

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
    | POl path
    |--------------------------------------------------------------------------
    |
    | This path used for save the generated plugin. This path also will added
    | automatically to list of scanned folders.
    |
    */
    'path'  => lib_path('plugins'),

    /*
    |--------------------------------------------------------------------------
    | Packages Stubs
    |--------------------------------------------------------------------------
    |
    | Default packages stubs.
    |
    */
    'stubs' => [
        'path' => realpath(LIBRARY_PATH.'/src/Console/stubs'),
        'files'  => [
            'apply'                 => 'apply.json',
            'license'               => 'LICENCE.md',
            'composer'              => 'composer.json',
            'setup'                => 'src/Apply/Setup.php',
            'RouteServiceProvider'  => 'src/Providers/RouteServiceProvider.php',
            'AppServiceProvider'    => 'src/Providers/AppServiceProvider.php',
            'Controller'            => 'src/Http/Controllers/Controller.php',
        ],
    ],
];
