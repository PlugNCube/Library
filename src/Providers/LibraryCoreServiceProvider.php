<?php


namespace Apply\Library\Providers;

use Apply\Library\Engine;
use Apply\Common\Support\Helper;
use Illuminate\Support\ServiceProvider;

class LibraryCoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('LIBRARY_PATH')) {
            define('LIBRARY_PATH', realpath(__DIR__.'/../../'));
        }

        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/library.php'), 'library');
        Helper::autoload(realpath(LIBRARY_PATH . '/helpers'));
        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/plugin.php'), 'plugin');
        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/cube.php'), 'cube');

        $this->app->register(LibraryServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}