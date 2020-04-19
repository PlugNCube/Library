<?php

namespace Apply\Library\Concerns;

use Apply\Library\PackageLoad;

trait HasLock
{
    /**
     * @return PackageLoad
     */
    public function lock()
    {
        return new PackageLoad();
    }
}
