<?php

namespace Apply\Library;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Apply\Common\Support\SplFileInfo;
use Symfony\Component\Finder\Finder;

class PackageLoad
{
    /**
     * $packages array.
     */
    protected $packages = [];

    /**
     * $changed boolean.
     */
    protected $changed = false;

    /**
     * PackageLoad constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Library load init.
     */
    public function init()
    {
        if (!Cache::has('apply.library'))
            $this->scan();

        $this->packages = Cache::get('apply.library')['packages'];
    }

    /**
     * Scan folder and generate item.
     */
    public function scan()
    {
        $files = Finder::create()->files()
            ->in(config("library.scan.folder"))
            ->name(config("library.scan.filename"))
            ->contains(null);

        $items = [];

        foreach ($files as $file) {

            $item = new SplFileInfo($file);
            $data = $this->generatePackage($item);
            $items[$data['type'].':'.$data['name']] = $data;
        }

        $this->addPackages($items)->save();

        return $this;
    }

    /**
     * Generate structure package item.
     * @param $file
     * @return mixed
     */
    public function generatePackage($file)
    {
        $item = $file->getJsonDecode();

        $merge['id']   = $item['id'];
        $merge['name'] = $item['name'];
        $merge['type'] = $item['type'];
        $merge['data'] = $item;
        //$merge['file']['filename'] = $file->getFilename();
        //$merge['file']['extension'] = $file->getExtension();
        $merge['file']['pathname'] = $file->getPathname();
        $merge['file']['path'] = $file->getPath();

        $composer = new SplFileInfo($file->getPath().'/composer.json');
        $merge['composer'] = $composer->getJsonDecode();

        return $merge;
    }

    /**
     * Add items to packages and changed true.
     * @param $item
     * @return $this
     */
    public function addPackages($item)
    {
        $this->packages = $item;
        $this->changed = true;
        return $this;
    }

    /**
     * Update package and changed true.
     * @param $file
     * @return $this
     */
    public function updatePackage($file)
    {
        $item = new SplFileInfo($file);
        $data = $this->generatePackage($item);

        $this->packages[$data["data"]["id"]] = $data;
        $this->changed = true;
        $this->save();
        return $this;
    }

    /**
     * Remove an item from the library
     *
     * @param  mixed $id
     * @return void
     */
    public function removePackage($id)
    {
        Arr::forget($this->packages, $id);
        $this->changed = true;
        $this->save();
    }

    /**
     * get packages.
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * Save packages on Cache.
     */
    public function save()
    {
        if ($this->changed) {
            Cache::forever('apply.library', ['packages' => $this->packages]);
            $this->changed = false;
        }
    }
}
