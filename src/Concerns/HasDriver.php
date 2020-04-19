<?php

namespace Apply\Library\Concerns;

use Illuminate\Support\Str;

trait HasDriver
{
    /**
     * Driver item's.
     *
     * @var string
     */
    protected $driver;

    /**
     *  driver associated with the item.
     *
     * @param null $driver
     * @return string
     */
    public function driver($driver = null)
    {   
    	return $driver ? $this->setDriver($driver) : $this->getDriver();
    }

    /**
     * Get the engine associated with the item.
     *
     * @return string
     */
    public function getDriver()
    {
    	$class = Str::snake(class_basename($this));
    	$driver = $this->driver ?? $this->getAttribute('type');
        //return $driver ?? ( $class != 'package' ? null : $class );
        return $driver ?? $class;
    }

    /**
     * Set the engine associated with the item.
     *
     * @param $driver
     * @return $this
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }
}
