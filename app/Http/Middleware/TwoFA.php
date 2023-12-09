<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFA {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $user = auth()->user();
        if ($user && $user->two_fa && !$user->two_fa_completed) {
            auth()->logout();
            return redirect()->route('login')->with('2fa', '2FA is required!');
        }
        return $next($request);
    }
}
