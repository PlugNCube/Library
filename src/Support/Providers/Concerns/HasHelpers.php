<?php

namespace Apply\Library\Support\Providers\Concerns;

use Apply\Library\Support\Helper;

trait HasHelpers
{
    /**
     * Register helpers.
     *
     * @param string $path
     * @return $this
     */
    protected function registerHelpers($path = 'helpers'): self
    {
        Helper::autoload(realpath($this->item->path($path)));
        return $this;
    }

}
