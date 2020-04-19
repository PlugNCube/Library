<?php

namespace Apply\Library\Concerns;

trait HasArrayable
{
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getAttributes();
    }
}
