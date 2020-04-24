<?php

namespace Apply\Library\Support\Providers\Concerns;

trait HasProviders
{
    /**
     * Register provider.
     */
    public function registerProviders(): self
    {
        foreach ($this->provides() as $provide) {
            $this->app->register(new $provide($this));
        }

        return $this;
    }
}
