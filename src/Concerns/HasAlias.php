<?php

namespace Apply\Library\Concerns;

trait HasAlias
{
    /**
     * Get the alias
     *
     * @return mixed
     */
    public function alias()
    {
        $alias = $this->config('alias');

        if (!$alias)
           $alias = $this->getDriver();

        return $alias;
    }
}