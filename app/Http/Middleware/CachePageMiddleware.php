<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;

class CachePageMiddleware
{
    public function handle($request, \Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldCacheResponse($request, $response)) {
            $response->headers->add([
                'Cache-Control' => 'max-age=1800, public',
            ]);
        }

        return $response;
    }

    public function shouldCacheResponse($request, Response $response): bool
    {
        if (! app()->isProduction()) {
            return false;
        }

        if (auth()->check()) {
            return false;
        }

        if (! $request->isMethod('GET')) {
            return false;
        }

        if (! $response->isSuccessful()) {
            return false;
        }

        return true;
    }
}
