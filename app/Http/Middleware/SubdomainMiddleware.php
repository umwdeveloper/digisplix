<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SubdomainMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Set defaults for use with route() helpers.
        URL::defaults(['subdomain' => 'default']);

        // Remove these params so they aren't passed to controllers.
        $request->route()->forgetParameter('subdomain');

        return $next($request);
    }
}
