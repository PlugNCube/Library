<?php

namespace Apply\Library\Support;

class SplFileInfo extends \SplFileInfo
{
    /**
     * Returns the contents of the file.
     *
     * @return string the contents of the file
     *
     * @throws \RuntimeException
     */
    public function getContents()
    {
        set_error_handler(function ($type, $msg) use (&$error) { $error = $msg; });
        $content = file_get_contents($this->getPathname());
        restore_error_handler();
        if (false === $content) {
            throw new \RuntimeException($error);
        }

        return $content;
    }

    /**
     * Decodes a JSON string
     *
     * @param bool $assoc
     * @return array the contents of the file
     *
     */
    public function getJsonDecode($assoc = true)
    {
        return json_decode($this->getContents(), $assoc);
    }

    /**
     * Write content File.
     * @param $content
     * @param string $node
     */
    public function writeFile($content, $node = 'w')
    {
        if ($this->isWritable()) {
            $fileobj = $this->openFile($node);
            $fileobj->fwrite($content);
        }
    }
}
