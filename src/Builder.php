<?php

namespace Apply\Library;

use Illuminate\Support\Collection;

class Builder
{
    /**
     * The base query builder instance.
     *
     * @var Collection
     */
    protected $query;

    /**
     * The model being queried.
     *
     * @var Plugin
     */
    protected $item;

    /**
     * Create a new Package query builder instance.
     *
     * @param Collection $query
     * @return void
     */
    public function __construct(Collection $query)
    {
        $this->query = $query;
    }

    /**
     * Set a item instance for the item being queried.
     *
     * @param Plugin $item
     * @return $this
     */
    public function setModel(Plugin $item)
    {
        $this->item = $item;
        return $this;
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
        return $this->query->$method(...$parameters);
    }
}
