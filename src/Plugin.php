<?php

namespace Apply\Library;

use ArrayAccess;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;

class Plugin implements Arrayable, ArrayAccess, Jsonable, JsonSerializable, UrlRoutable
{
    use Macroable;
    use Concerns\HasDriver,
        Concerns\HasActions,
        Concerns\HasAlias,
        Concerns\HasAssets,
        Concerns\HasRoutable,
        Concerns\HasArrayable,
        Concerns\HasArrayAccess,
        Concerns\HasJsonable,
        Concerns\HasAttributes,
        Concerns\HasLock,
        Concerns\HasMagic,
        Concerns\HasNamespace,
        Concerns\HasPath,
        Concerns\HasFile,
        Concerns\HasKey,
        Concerns\HasLibrary,
        Concerns\HasQuery,
        Concerns\HasComposer,
        Concerns\HasGenerate,
        Concerns\HasConfig,
        Concerns\HasVendor;

    /**
     * Indicates if the item exists.
     *
     * @var bool
     */
    public $exists = false;

    /**
     * Package constructor.
     *
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->syncOriginal();
    }

    /**
     * Create a new instance of the given item.
     *
     * @param  array  $attributes
     * @param  bool  $exists
     * @return static
     */
    public function newInstance($attributes = [], $exists = false)
    {
        $model = new static((array) $attributes);
        $model->exists = $exists;
        return $model;
    }

    /**
     * Create a new item instance that is existing.
     *
     * @param  array  $attributes
     * @return static
     */
    public function newFromBuilder($attributes = [])
    {
        $model = $this->newInstance([], true);

        $model->setFile($attributes['file']);
        $model->setComposer($attributes['composer']);
        $model->setRawAttributes((array) $attributes['data'], true);

        return $model;
    }

    /**
     * Get a new query builder that doesn't have any global scopes or eager loading.
     *
     * @return Builder
     */
    public function newModelQuery()
    {
        return $this->newEloquentBuilder(
            $this->read()
        )->setModel($this);
    }

    /**
     * Read the data from the engine.
     *
     * @param bool $instance
     * @return mixed
     */
    public function read($instance = true)
    {
        $items = [];

        foreach (Engine::all() as $package)
        {
            $item = $this->formatItem($package, $instance);

            $this->library
                ? ($items[] = $item)
                : ($package['type'] != $this->getDriver() ?: $items[] = $item);
        }

        return new Collection($items);
    }

    /**
     * Format the data from item.
     *
     * @param $package
     * @param bool $instance
     * @return array
     */
    public function formatItem($package, $instance = true)
    {
        return $item = $this->item($package, $instance);
    }

    /**
     * Format the default data from item.
     *
     * @param null $package
     * @param bool $instance
     * @return mixed|null
     */
    public function item($package = null, $instance = false)
    {
        $item = $package['data'];
        if (array_key_exists('alias' , $item) && $item['alias'] == null){
            $item['alias'] = $this->alias().':'.$item['name'];
        }

        if (array_key_exists('core', $item) && $item['core']){
            $item['active'] = $item['core'];
        }

        $package['data'] = $item;
        return $instance ? $this->newFromBuilder($package) : $item;
    }

    /**
     * Handle dynamic method calls into the item.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->newQuery()->$method(...$parameters);
    }
}
