<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerformanceHeaders
{
    /**
     * Add lightweight caching headers for local/dev server and edge cases.
     * (In production, prefer web-server level caching for static assets.)
     */
    // PENANDA BAB IV - WPO: header cache respons untuk resource statis/dinamis.
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);

        // Only for successful GET/HEAD responses
        if (!in_array($request->method(), ['GET', 'HEAD'], true) || $response->getStatusCode() >= 400) {
            return $response;
        }

        // Do not override if app already sets cache headers
        $hasCache = $response->headers->has('Cache-Control') || $response->headers->has('Expires');
        if (!$hasCache) {
            $path = $request->path();
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

            $staticExt = [
                'css','js','mjs','map',
                'jpg','jpeg','png','gif','svg','webp','ico',
                'woff','woff2','ttf','eot',
                'pdf'
            ];

            if (in_array($ext, $staticExt, true)) {
                // One year cache for static assets
                $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
            } else {
                // HTML / dynamic: allow revalidation; can be paired with server-side caching.
                $response->headers->set('Cache-Control', 'public, max-age=0, must-revalidate');
            }
        }

        // Ensure compression proxies vary properly
        $response->headers->set('Vary', trim(($response->headers->get('Vary') ?? '') . ', Accept-Encoding', ' ,'));

        return $response;
    }
}
