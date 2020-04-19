<?php

namespace Apply\Library\Concerns;

use Illuminate\Config\Repository;

trait HasComposer
{
    /**
     * Var Composer.
     *
     * @var array
     */
    public $composer = [];

    /**
     *  Composer associated with the item.
     *
     * @param null $key
     * @return Repository|mixed
     */
    public function composer($key = null)
    {
        $composer = new Repository($this->composer);

        if ($key){
            return $composer->get($key);
        }

        return $composer;
    }

    /**
     * Set composer array.
     *
     * @param array $data
     * @return $this
     */
    public function setComposer(array $data)
    {
        $this->composer = $data;

        return $this;
    }

}
