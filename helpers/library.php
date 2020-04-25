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
     * Get the available Library engine instance.
     *
     * @return mixed
     */
    function library()
    {
        app();
        return new \Apply\Library\Engine();
    }
}

