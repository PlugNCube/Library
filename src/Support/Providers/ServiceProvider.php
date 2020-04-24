<?php

namespace Apply\Library\Support\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    use Concerns\HasItem;

    /**
     * Create a new service provider instance.
     *
     * @param $setup
     */
    public function __construct($setup)
    {
        parent::__construct($setup->app);
        $this->item = $setup->item;
    }
}