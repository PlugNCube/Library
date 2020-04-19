<?php

namespace Apply\Library\Concerns;

use Illuminate\Config\Repository;
use Illuminate\Support\Str;

trait HasConfig
{
    /**
     * Config.
     *
     * @param null $key
     * @return Repository|mixed
     */
    public function config($key = null)
    {
        $class = Str::snake(class_basename($this));
        $driver = $this->driver ?? $this->getAttribute('type');
        $config = $class;

        return  $key ? config($driver ?? $config.'.'.$key) : config($driver ?? $config);
    }

}
