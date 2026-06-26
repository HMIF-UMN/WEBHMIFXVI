<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        $csp = "default-src 'self'; "
            . "img-src 'self' data: https:; "
            . "font-src 'self' data: https://fonts.gstatic.com; "
            . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
            . "script-src 'self' 'unsafe-inline' 'unsafe-eval'; "
            . "connect-src 'self' https:; "
            . "frame-ancestors 'self'; "
            . "base-uri 'self'; "
            . "form-action 'self'";

        $response->headers->set('Content-Security-Policy-Report-Only', $csp);

        return $response;
    }
}
