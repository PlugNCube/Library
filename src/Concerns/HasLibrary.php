<?php
namespace Apply\Library\Concerns;

trait HasLibrary
{
    /**
     * Call of the library engine.
     *
     * @var bool
     */
    protected $library = false;

    /**
     * Set the engine library.
     *
     * @param $library
     * @return $this
     */
    public function setLibrary($library)
    {
        $this->library = $library;
        return $this;
    }
}
