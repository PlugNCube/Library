<?php

namespace Apply\Library\Support\Providers\Concerns;

trait HasDatabase
{
    /**
     * Register Database.
     *
     * @param null $folder
     * @return $this
     */
    protected function registerDatabase($folder = null): self
    {
        $path = $folder ?? $this->item->path('database/migrations');
        $this->loadMigrationsFrom($path);

        return $this;
    }
}
