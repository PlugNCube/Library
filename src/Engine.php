<?php

namespace Apply\Library;

use Apply\Library\Support\Autoload;
use BadMethodCallException;
use Illuminate\Foundation\Application;

class Engine
{
    /**
     * All of the registered Library tool elements.
     *
     * @var array
     */
    public static $cubes = [];

    /**
     * All of the registered Library tool elements.
     *
     * @var array
     */
    public static $elements = [];

    /**
     * Check if read PlugLoad
     *
     * $read boolean.
     */
    public static $read = false;

    /**
     * Get all of the additional elements that should be registered.
     *
     * @return array
     */
    public static function all()
    {
        return static::$elements;
    }

    /**
     * Get all elements force.
     *
     * @return array
     */
    public static function element()
    {
        return static::$cubes[config('library.element')]->setLibrary(true);;
    }

    /**
     * Register the given script file with Nova.
     *
     * @param $name
     * @param $cube
     * @return static
     */
    public static function cube($name, $cube = null)
    {
        if(!$cube){
            $name = $name ?? config('library.element');
            return static::$cubes[$name];
        }

        static::$cubes[$name] = $cube;

        return new static;
    }

    /**
     * Run library engine
     * @param Application $app
     * @return string
     */
    public static function run(Application $app)
    {
        static::load();
        $load = new Plugin();
        $load->setLibrary(true);

        $elements = $load->read()->filter(function ($item) {
                return $item->active == true;
        })->sortBy('order');

        // Register Class Composer
        foreach ($elements as $element)
        {
            //dd($element);
            foreach ((array)$element->composer('autoload.psr-4') as $class => $src)
            {
                Autoload::register($class, $element->path($src));
            }
        }

        foreach ($elements as $element)
        {
            $method = $element->namespace('Apply\Setup');
            $app->register(new $method($app, $element));
        }
    }

    /**
     * Lod elements cache.
     *
     * @return mixed
     */
     public static function load()
     {
         if (!static::$read){
             $load = new PackageLoad();
             static::$read = true;
             return static::$elements = collect($load->getPackages());
         }

         return static::$elements;
     }

    /**
     * Generate structure element plug.
     *
     * @param $name
     * @param string $type
     * @return mixed
     */
    public function generate($name, $type = 'plugin')
    {
        return  static::$cubes[$type]->generate($name);
    }

    /**
     * Dynamically proxy static method calls.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return void
     */
    public static function __callStatic($method, $parameters)
    {
        if (! property_exists(get_called_class(), $method)) {
            throw new BadMethodCallException("Method {$method} does not exist.");
        }

        return static::${$method};
    }

}