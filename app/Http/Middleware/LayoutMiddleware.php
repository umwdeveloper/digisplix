<?php

namespace App\Http\Middleware;

use App\Models\Partner;
use App\Models\Staff;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LayoutMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (Auth::user()) {
            $user_type = Auth::user()->userable_type;
            $layout = $user_type === Staff::class ? 'layouts.app' : ($user_type === Partner::class ? 'layouts.partner' : 'layouts.client');

            view()->share('layout', $layout);
        }
        return $next($request);
    }
}
