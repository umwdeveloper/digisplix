<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RedirectOnCsrfExpired {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        try {
            $response = $next($request);
        } catch (HttpException $e) {
            if ($e->getStatusCode() === 419) {
                return redirect()->route('login')->withErrors(['error' => 'Your session has expired. Please log in again.']);
            }
            throw $e; // Re-throw other exceptions
        }

        return $response;
    }
}
