<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user_type = Auth::user()->userable_type;
                if ($user_type === Staff::class) {
                    return redirect('/');
                } elseif ($user_type === Partner::class) {
                    return redirect('/partners');
                } elseif ($user_type === Client::class) {
                    return redirect('/clients');
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
