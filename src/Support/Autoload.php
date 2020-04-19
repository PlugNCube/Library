<?php

namespace Apply\Library\Support;

class Autoload
{
    public static function register($class, $path)
    {
        $composer = require(base_path('vendor/autoload.php'));

        $classMap = [
            realpath($path.'/../database/seeds'),
            realpath($path.'/../database/factories'),
        ];

        foreach ($classMap as $directory)
        {
            if (is_dir($directory)){
                $files = scandir($directory);

                foreach ($files as $file){
                    $classname = str_replace('.php', '', $file);
                    $file = $directory.DIRECTORY_SEPARATOR.$file;

                    if (is_file($file))
                    {
                        $composer->addClassMap([$classname => $file]);
                    }
                }
            }
        }

        if (! array_key_exists($class, $composer->getClassMap())) {
            $composer->addPsr4($class, $path);
        }

        $composer->register();

    }
}
