<?php

namespace Apply\Library;

use Apply\Library\Support\Stub;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class Cube extends Plugin
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



        //Plugs namespace cube config
        $packages = Str::plural($package);
        //folder plugs Cubes
        $folder =  Str::plural($name);


        //driver singular
        $driver = $this->driver();
        //driverPlural
        $drivers = Str::studly(Str::plural($driver));

        $collection = Str::plural($driver);

        //items Path
        $itemPath = $this->path($name);



        //Packages/Plug; full Namespace
        $namespace = $this->namespace($package);

        //Packages;  Base namespace
        $driverspace = $this->config('namespace');



        $uuid = (string) Str::uuid();
        $date = date('Y-m-d');

        if ($filesystem->isDirectory($itemPath))
            return ['status' => 'error', 'message' => 'Sorry "'.$name.'" '.$this->driver().' folder already exist!!!', 'id' => $uuid];

        foreach ($this->config('stubs.files') as $key => $value)
        {
            if ($key == 'ClassCollection'){
                $value = str_replace($key,$package,$value);
            }
            if ($key == 'configCollection'){
                $value = str_replace($key,$name,$value);
            }

            Stub::createFromPath($this->config('stubs.path').'/'.$key.'.stub',
                compact(['name', 'driver', 'drivers', 'driverspace','package', 'packages', 'namespace', 'date', 'uuid', 'collection', 'folder']))
                ->saveTo($itemPath, $value);
        }

        $this->lock()->scan();

        return ['status' => 'success', 'message' => Str::studly($this->driver()).' created successfully.', 'id' => $uuid];
    }
}