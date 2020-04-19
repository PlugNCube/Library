<?php

namespace Apply\Library\Support\Providers\Concerns;

use Nuwave\Lighthouse\Events\BuildSchemaString;
use Symfony\Component\Finder\Finder;

trait HasGraphql
{
    /**
     * Register Graphql.
     * @param $folder
     * @return $this
     */
    public function registerGraphql($folder = null): self
    {
        $path = $folder ?? $this->item->path('graphql');

        $files = Finder::create()->files()
            ->in($path)
            ->name('*.graphql')
            ->contains([]);

        foreach($files as $item)
        {
            app('events')->listen(
                BuildSchemaString::class,
                function () use ($item): string {
                    return $item->getContents();
                }
            );
        }

        return $this;
    }

}
