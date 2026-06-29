<?php
if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($number)
    {
        // Hapus karakter selain angka
        $clean = preg_replace('/[^0-9]/', '', $number);

        // Ubah 0xxx jadi +62xxx
        if (substr($clean, 0, 1) === '0') {
            $clean = '+62' . substr($clean, 1);
        } elseif (substr($clean, 0, 2) === '62') {
            $clean = '+' . $clean;
        }

        // Format menjadi +62-xxxx-xxxx-xxx
        return preg_replace('/^(\+62)(\d{3,4})(\d{3,4})(\d{0,4})$/', '$1-$2-$3-$4', $clean);
    }
}



if (!function_exists('thumb_url')) {
    /**
     * Build a thumbnail URL for an image stored in the public disk.
     * Prefer a pre-generated static thumbnail when available so the homepage
     * does not need to hit a PHP route for every image request.
     */
    function thumb_url(?string $publicDiskPath, int $width = 480): string
    {
        $publicDiskPath = ltrim((string) ($publicDiskPath ?? ''), '/');
        if ($publicDiskPath === '') {
            return asset('images/placeholder.png');
        }

        $thumbRel = '.thumbs/' . $width . '/' . preg_replace('/\.[^.]+$/', '', $publicDiskPath) . '.webp';
        $thumbRel = str_replace('..', '', $thumbRel);
        $thumbAbs = public_path('storage/' . $thumbRel);

        if (is_file($thumbAbs)) {
            return asset('storage/' . $thumbRel);
        }

        return route('media.thumb', ['width' => $width, 'path' => $publicDiskPath]);
    }
}
