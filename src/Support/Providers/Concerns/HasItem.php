<?php

namespace Apply\Library\Support\Providers\Concerns;

trait HasItem
{
    /**
     * @var $item
     */
    public $item;

    /**
     * Get details of the package.
     *
     * @return null
     */
    public function item()
    {
        return  $this->item;
    }
}
