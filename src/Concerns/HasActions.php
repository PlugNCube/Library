<?php

namespace Apply\Library\Concerns;

use Illuminate\Filesystem\Filesystem;

trait HasActions
{
    /**
     * Filesystem.
     */
    public function filesystem()
    {
        return new Filesystem;
    }

    /**
     * Write the data into the store.
     *
     * @param  array  $data
     * @return void
     */
    public function write(array $data)
    {
        $path = (array)$this->getFile();

        if ($data) {
            $contents = json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            $contents = '{}';
        }

        $this->filesystem()->put($path['pathname'], $contents);
        $this->lock()->updatePackage($path['pathname']);
    }

    /**
     * enable Package.
     */
    public function enable()
    {
        if ($this->exists)
            $this->active = true;

        return $this->save();
    }

    /**
     * disable Package.
     */
    public function disable()
    {
        if ($this->exists)
            $this->active = false;

        return $this->save();
    }

    /**
     * Delete Package folder
     */
    public function delete()
    {
        if ($this->exists){
            $this->lock()->removePackage($this->id);
            $this->filesystem()->deleteDirectory($this->path());
        }
    }

    /**
     * Save any changes done to the items data.
     *
     * @return mixed
     */
    public function save()
    {
        if ($this->exists)
            $this->write($this->getAttributes());
        return $this;
    }

}
