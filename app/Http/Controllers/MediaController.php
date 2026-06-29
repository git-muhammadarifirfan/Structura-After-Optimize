<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    /**
     * Generate & serve a cached thumbnail (WebP) for images stored on the public disk.
     * Example: /media/thumb/480/products/abc.jpg
     */
    public function thumb(Request $request, int $width, string $path)
    {
        $width = max(64, min(2000, $width));

        // sanitize path
        $path = ltrim($path, '/');
        $path = str_replace(['..\\', '../', '..'], '', $path);

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $sourceAbs = Storage::disk('public')->path($path);

        $thumbRel = '.thumbs/' . $width . '/' . preg_replace('/\.[^.]+$/', '', $path) . '.webp';
        $thumbRel = str_replace('..', '', $thumbRel);
        $thumbDisk = Storage::disk('public');

        // Ensure directory exists
        $dir = dirname($thumbRel);
        if (!$thumbDisk->exists($dir)) {
            $thumbDisk->makeDirectory($dir);
        }

        if (!$thumbDisk->exists($thumbRel)) {
            $manager = ImageManager::gd();
            $img = $manager->read($sourceAbs);

            // Resize down keeping aspect ratio
            $img = $img->scaleDown(width: $width);

            // Encode to WebP
            $encoded = $img->toWebp(80);

            $thumbDisk->put($thumbRel, (string) $encoded, 'public');
        }

        $thumbAbs = $thumbDisk->path($thumbRel);

        /** @var BinaryFileResponse $resp */
        $resp = response()->file($thumbAbs, [
            'Content-Type' => 'image/webp',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);

        return $resp;
    }
}
