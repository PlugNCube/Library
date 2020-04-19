<?php

namespace Apply\Library\Concerns;

trait HasPath
{
    /**
     * Path.
     *
     * @param null $key
     * @return mixed|string
     */
    public function path($key = null)
    {
        $path =  $this->config('path');

        if ($this->exists){

            $path =  (array)$this->getFile();
            $path = dirname($path['pathname']);
        }

        if ($key) {
            return $path.'/'.$key;
        }

        return $path;
    }

    /**
     * Path.
     *
     * @param null $key
     * @return mixed|string
     */
    public function strPath($key = null)
    {
        return  str_replace(base_path().'\\', '', $this->path($key));
    }
}
