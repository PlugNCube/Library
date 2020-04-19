<?php

namespace Apply\Library\Support\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    use Concerns\HasItem;

    /**
     * Create a new service provider instance.
     *
     * @param $load
     */
    public function __construct($load)
    {
        parent::__construct($load->app);
        $this->item = $load->item;
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
    }
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        if(file_exists($this->item->path('routes/web.php')))
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group($this->item->path('routes/web.php'));
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        if(file_exists($this->item->path('routes/api.php')))
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group($this->item->path('routes/api.php'));
    }
}
