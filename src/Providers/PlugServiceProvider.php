<?php

namespace Apply\Library\Providers;

use Apply\Library\Cube;
use Apply\Library\Engine;
use Apply\Library\Plug;
use Carbon\Laravel\ServiceProvider;

class PlugServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Engine::cube('plug', new  Plug());
        Engine::cube('cube', new Cube());
    }

}