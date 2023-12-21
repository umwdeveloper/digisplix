<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Models\Support;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $sharedTickets = [];
        if (auth()->check() && auth()->user()->userable_type === Staff::class) {
            $sharedTickets = Support::with('user')->orderByDesc('created_at')->take(10)->get();
        } elseif (auth()->check() && (auth()->user()->userable_type === Client::class || auth()->user()->userable_type === Partner::class)) {
            $sharedTickets = Support::with('user')->where('user_id', auth()->user()->id)->orderByDesc('created_at')->take(10)->get();
        }

        view()->share('shared_tickets', $sharedTickets);
        return $next($request);
    }
}
