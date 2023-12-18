<?php

namespace App\Http\Middleware;

use App\Models\Staff;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetAdminIdForStaffChat {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (Auth::check() && Auth::user()->userable_type === Staff::class) {
            // Set the user ID to the admin ID
            Auth::user()->id = User::getAdmin()->id;
        }
        return $next($request);
    }
}
