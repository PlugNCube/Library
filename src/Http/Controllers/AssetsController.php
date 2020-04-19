<?php

namespace Apply\Library\Http\Controllers;

use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AssetsController
{
    /**
     * Serve the requested assets.
     *
     * @param string $package
     * @param string $path
     * @return BinaryFileResponse
     */
    public function show(string $package, string $path)
    {
        $library = library()->element();
        $package = $library->where('id', $package)->first();
        $realPath = $package->path('public/'.$path);
        return response()->file($realPath, [
            'Content-Type'  => File::mimeType($realPath) ?? 'text/plain',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}