<?php

namespace Apply\Library\Providers;

use Apply\Library\Console\Commands\ElementMake;
use Apply\Library\Console\Commands\LibraryList;
use Apply\Library\Console\Commands\LibrarySync;
use Apply\Library\Console\Generators\ConsoleMakeCommand;
use Apply\Library\Console\Generators\ControllerMakeCommand;
use Apply\Library\Console\Generators\FactoryMakeCommand;
use Apply\Library\Console\Generators\MiddlewareMakeCommand;
use Apply\Library\Console\Generators\MigrateMakeCommand;
use Apply\Library\Console\Generators\ModelMakeCommand;
use Apply\Library\Console\Generators\ProviderMakeCommand;
use Apply\Library\Console\Generators\RequestMakeCommand;
use Apply\Library\Console\Generators\ResourceMakeCommand;
use Apply\Library\Console\Generators\SeederMakeCommand;
use Apply\Library\Http\Controllers\AssetsController;
use Illuminate\Support\ServiceProvider;

class LibraryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerAssets();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
        $this->makeDirectory();
        $this->registerAutoload();
    }

    /**
     * Register Library´s.
     *
     * @return void
     */
    public function registerAutoload()
    {
        library()->run($this->app);
    }

    /**
     * Register Library´s.
     *
     * @return void
     */
    public function registerAssets()
    {
        $this->app['router']->get(config('library.assets.route'), [AssetsController::class, 'show'])
            ->where('patch', '.*')
            ->name('library.assets');
    }

    /**
     * Make Directory if no exist.
     *
     * @return void
     */
    public function makeDirectory()
    {
        if (!file_exists(config('library.scan.folder')))
            mkdir(config('library.scan.folder'), 0755, true);
    }

    /**
     * Register Commands.
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            ElementMake::class,
            LibraryList::class,
            LibrarySync::class,
            ControllerMakeCommand::class,
            MiddlewareMakeCommand::class,
            ConsoleMakeCommand::class,
            ModelMakeCommand::class,
            ProviderMakeCommand::class,
            RequestMakeCommand::class,
            ResourceMakeCommand::class,
            MigrateMakeCommand::class,
            SeederMakeCommand::class,
            FactoryMakeCommand::class
        ]);
    }
}