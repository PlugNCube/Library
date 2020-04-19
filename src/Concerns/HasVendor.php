<?php


namespace Apply\Library\Concerns;


use Illuminate\Support\Str;

trait HasVendor
{
    /**
     *  vendor associated with the item.
     *
     * @param null $driver
     * @return string
     */
    public function vendor($driver = null)
    {
        $class = Str::of(class_basename($this))->snake()->plural();
        $driver = $this->config('vendor');
        return $driver ?? $class;
    }

}