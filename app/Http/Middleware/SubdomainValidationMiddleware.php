<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubdomainValidationMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $allowedSubdomains = ['admin', 'staff', 'client', 'partner'];

        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        if (!in_array($subdomain, $allowedSubdomains)) {
            abort(404);
        }
        return $next($request);
    }
}
