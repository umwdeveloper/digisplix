<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TimezoneMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (auth()->check()) {
            $timezone = $request->cookie('timezone');

            if ($timezone) {
                config(['app.timezone' => $timezone]);
            } else {
                $userIp = $request->ip();
                $response = Http::get('http://ip-api.com/json/' . $userIp);
                $userData = $response->json();

                if ($userData['status'] == 'success') {
                    $timezone = $userData['timezone'];

                    config(['app.timezone' => $timezone]);

                    Cookie::queue('timezone', $timezone, 60 * 24 * 7);
                }
            }
        }
        return $next($request);
    }
}
