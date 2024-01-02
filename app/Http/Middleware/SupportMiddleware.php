<?php

namespace App\Http\Middleware;

use App\Models\ChMessage as Message;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Models\Support;
use App\Models\User;
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
        $totalMessagesCount = 0;

        if (auth()->check() && auth()->user()->userable_type === Staff::class) {
            $sharedTickets = Support::with('user')->orderByDesc('created_at')->take(10)->get();

            // Get messages count for admin
            $query = Message::where('to_id', User::getAdmin()->id)
                ->where('seen', 0);
            $totalMessagesCount = $query->count();
        } elseif (auth()->check() && (auth()->user()->userable_type === Client::class || auth()->user()->userable_type === Partner::class)) {
            $sharedTickets = Support::with('user')->where('user_id', auth()->user()->id)->orderByDesc('created_at')->take(10)->get();

            // Get messages count for client/partner
            $query = Message::where('to_id', auth()->user()->id)
                ->where('seen', 0);
            $totalMessagesCount = $query->count();
        }

        view()->share([
            'shared_tickets' => $sharedTickets,
            'total_messages_count' => $totalMessagesCount
        ]);
        return $next($request);
    }
}
