<?php

namespace Apply\Library\Concerns;

use Apply\Library\Builder;
use Illuminate\Support\Collection;

trait HasQuery
{
    /**
     * Begin querying the model.
     *
     * @return Builder
     */
    public static function query()
    {
        return (new static)->newQuery();
    }

    /**
     * Get a new query builder for the items's.
     *
     * @return Builder
     */
    public function newQuery()
    {
        return  $this->newModelQuery();
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  Collection  $query
     * @return Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }
}
