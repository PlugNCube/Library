<?php

namespace Apply\Library\Concerns;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Apply\Library\Support\Stub;

trait HasGenerate
{
    /**
     * Generate the package.
     * @param $name
     * @return mixed
     */
    public function generate($name)
    {
        $filesystem = new Filesystem();

        // name plug
        $name = strtolower($name);
        // name Plug
        $package = Str::studly($name);

        //driver singular
        $driver = $this->driver();

        // name composer vendor/name
        $collection = $this->vendor();

        //items Path
        $itemPath = $this->path($name);

        //Packages/Plug; full Namespace
        $namespace = $this->namespace($package);

        //Packages;  Base namespace
        $driverSpace = $this->config('namespace');


        $uuid = (string) Str::uuid();
        $date = date('Y-m-d');

        if ($filesystem->isDirectory($itemPath))
            return ['status' => 'error', 'message' => 'Sorry "'.$name.'" '.$this->driver().' folder already exist!!!', 'id' => $uuid];

        foreach ($this->config('stubs.files') as $key => $value)
        {
            Stub::createFromPath($this->config('stubs.path').'/'.$key.'.stub',
                compact(['name', 'package', 'driver', 'driverSpace', 'namespace', 'date', 'uuid', 'collection']))
                ->saveTo($itemPath, $value);
        }

        $this->lock()->scan();

        return ['status' => 'success', 'message' => Str::studly($this->driver()).' created successfully.', 'id' => $uuid];
    }
}
