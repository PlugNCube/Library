<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Packages namespace
    |--------------------------------------------------------------------------
    |
    | This is the default namespace for the packages
    |
    */
    'namespace' => 'Packages',


    /*
    |--------------------------------------------------------------------------
    | Packages alias
    |--------------------------------------------------------------------------
    |
    | This is the default alias for the packages
    |
    */

    'alias'     => 'package',

    /*
    |--------------------------------------------------------------------------
    | Packages vendor if use composer require or install
    |--------------------------------------------------------------------------
    |
    | This is the default vendor for the packages
    |  -> path/vendor/name
    |
    */

    'vendor'     => 'packages',

    /*
    |--------------------------------------------------------------------------
    | Packages path
    |--------------------------------------------------------------------------
    |
    | This path used for save the generated module. This path also will added
    | automatically to list of scanned folders.
    |
    */
    'path'  => lib_path('packages'),

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
            'loader'                => 'src/Setup/loader.php',
            'RouteServiceProvider'  => 'src/Providers/RouteServiceProvider.php',
            'AppServiceProvider'    => 'src/Providers/AppServiceProvider.php',
            'Controller'            => 'src/Http/Controllers/Controller.php',
        ],
    ],
];
