<?php

namespace Apply\Library\Concerns;

trait HasNamespace
{
    /**
     * Get the namespace
     *
     * @param null $key
     * @return mixed
     */
    public function namespace($key = null)
    {
        $namespace = $this->config('namespace');

        if ($this->exists)
            $namespace = $this->getOriginal('namespace');

        if ($key)
            $namespace = $namespace."\\".$key;

        return $namespace;
    }
}
