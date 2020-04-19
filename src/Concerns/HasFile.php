<?php

namespace Apply\Library\Concerns;

trait HasFile
{
	/**
     * The file associated  with the item.
     *
     * @var string
     */
    protected $file;

    /**
     * Get the location associated with the item.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the location associated with the item.
     *
     * @param  string  $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
