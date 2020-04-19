<?php
namespace Apply\Library\Support\Providers\Concerns;

trait HasViews
{
    /**
     * Register views & Publish views.
     *
     * @param null $alias
     * @param null $folder
     * @return $this
     */
    public function registerViews($alias = null, $folder = null): self
    {
        $path = $folder ?? $this->item->path('resources/views');
        $alias = $alias ?? $this->item->alias;
        $this->loadViewsFrom($path, $alias);

        return $this;
    }
}
