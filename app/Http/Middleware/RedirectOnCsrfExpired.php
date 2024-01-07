<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectOnCsrfExpired {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $response = $next($request);

        if ($response->status() === 419) {
            return redirect()->route('login')->withErrors(['error' => 'Your session has expired. Please log in again.']);
        }

        return $response;
    }
}
