<?php

namespace Apply\Library\Support\Str;

use Illuminate\Support\Str;

class Alias
{
    protected static $cube = null;

    protected static $plug = null;

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
            static::$plug = $collection[1];
        }
        else{
            static::$plug = $alias;
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
        return static::$plug;
    }
}