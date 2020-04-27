<?php

namespace Apply\Library\Support\Str;

use Illuminate\Support\Str;

class Alias
{
    /**
     * @var $cube null
     */
    protected static $cube = null;

    /**
     * @var $plugin null
     */
    protected static $plugin = null;

    /**
     * Render Alias String
     *
     * @param $alias
     * @return mixed
     */
    public static function render($alias)
    {
        if (Str::contains($alias, ':')){
            $collection = Str::of($alias)->explode(':');
            static::$cube = $collection[0];
            static::$plugin = $collection[1];
        }
        else{
            static::$plugin = $alias;
        }

        return new static;
    }

    /**
     * Get cube
     *
     * @return mixed
     */
    public static function cube(){
        return static::$cube;
    }

    /**
     * Get plug
     *
     * @return mixed
     */
    public static function plug(){
        return static::$plugin;
    }
}