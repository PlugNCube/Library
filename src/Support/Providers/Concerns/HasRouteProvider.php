<?php

namespace Apply\Library\Support\Providers\Concerns;

trait HasRouteProvider
{
    /**
     * Register Route provider.
     * @param $method
     * @return $this
     */
    public function registerRouteProvider($method): self
    {
        $this->app->register(new $method($this));

        return $this;
    }
}
