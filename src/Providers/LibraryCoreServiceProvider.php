<?php


namespace Apply\Library\Providers;

use Apply\Library\Engine;
use Apply\Library\Support\Helper;
use Illuminate\Support\ServiceProvider;

class LibraryCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/library.php'), 'library');
        Helper::autoload(realpath(LIBRARY_PATH . '/helpers'));
        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/plugin.php'), 'plugin');
        $this->mergeConfigFrom(realpath(LIBRARY_PATH . '/config/cube.php'), 'cube');

        $this->app->register(LibraryServiceProvider::class);
        $this->app->register(PlugServiceProvider::class);
    }

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
    }
}