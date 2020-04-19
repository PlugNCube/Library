<?php

if (! function_exists('lib_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function lib_path($path = '')
    {
        return config('library.scan.folder').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('library')) {
    /**
     * Get / set the specified package value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @return mixed
     */
    function library()
    {
        return new \Apply\Library\Engine();
    }
}

