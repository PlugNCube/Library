<?php

namespace Apply\Library\Support\Providers\Concerns;

trait HasConfig
{
    /**
     * Register config.
     *
     * @param null $alias
     * @param null $file
     * @return $this
     */
    protected function registerConfig($alias = null, $file = null): self
    {
        $file = $file ?? $alias;

        if ($alias)
            $this->mergeConfigFrom($this->item->path('config/'.$file.'.php'), $alias);

        return $this;
    }
}
