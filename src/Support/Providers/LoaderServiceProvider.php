<?php

namespace Apply\Library\Support\Providers;

use Illuminate\Support\ServiceProvider;

class LoaderServiceProvider extends ServiceProvider
{
    use Concerns\HasItem,
        Concerns\HasAlias,
        Concerns\HasViews,
        Concerns\HasGraphql,
        Concerns\HasConfig,
        Concerns\HasHelpers,
        Concerns\HasConfigs,
        Concerns\HasDatabase,
        Concerns\HasProviders,
        Concerns\HasRouteProvider;

    /**
     * @var $item
     */
    public $item;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     * @param $item
     */
    public function __construct($app, $item)
    {
        parent::__construct($app);

        $this->item = $item;
    }

    /**
     * Get details of the package.
     *
     * @return null
     */
    public function item()
    {
        return  $this->item;
    }
}
