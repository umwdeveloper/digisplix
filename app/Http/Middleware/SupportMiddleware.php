<?php

namespace App\Http\Middleware;

use App\Models\ChMessage as Message;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Models\Support;
use App\Models\User;
use App\Notifications\SupportCreated;
use App\Notifications\SupportReplied;
use App\Notifications\SupportUpdate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $totalNotificationsCount = 0;
        $totalStaffTickets = 0;
        $totalClientTickets = 0;

        if (auth()->check() && auth()->user()->userable_type === Staff::class) {
            // $sharedTickets = Support::with('user')->orderByDesc('created_at')->take(10)->get();

            // Tickets
            $ticketNotifications = DB::table('notifications')
                ->select('notifications.*')
                ->join('notification_types', 'notifications.id', '=', 'notification_types.notification_id')
                ->where('notifications.notifiable_id', auth()->user()->id)
                ->where('notification_types.notifiable_type', Support::class)
                ->orderBy('notifications.created_at', 'DESC')
                ->get();

            $ticketNotifications = $ticketNotifications->map(function ($notification) {
                $notification->data = json_decode($notification->data, true);
                return $notification;
            });

            // Get messages count for admin
            $query = Message::where('to_id', User::getAdmin()->id)
                ->where('seen', 0);
            $totalMessagesCount = $query->count();

            $totalStaffTickets = auth()->user()->unreadNotifications
                ->filter(function ($notification) {
                    return $notification->type === SupportCreated::class || $notification->type === SupportReplied::class;
                })
                ->count();
        } elseif (auth()->check() && (auth()->user()->userable_type === Client::class || auth()->user()->userable_type === Partner::class)) {
            // $sharedTickets = Support::with('user')->where('user_id', auth()->user()->id)->orderByDesc('created_at')->take(10)->get();

            // Tickets
            $ticketNotifications = DB::table('notifications')
                ->select('notifications.*')
                ->join('notification_types', 'notifications.id', '=', 'notification_types.notification_id')
                ->where('notifications.notifiable_id', auth()->user()->id)
                ->where('notification_types.notifiable_type', Support::class)
                ->orderBy('notifications.created_at', 'DESC')
                ->get();

            $ticketNotifications = $ticketNotifications->map(function ($notification) {
                $notification->data = json_decode($notification->data, true);
                return $notification;
            });

            // Get messages count for client/partner
            $query = Message::where('to_id', auth()->user()->id)
                ->where('seen', 0);
            $totalMessagesCount = $query->count();

            $totalClientTickets = auth()->user()->unreadNotifications
                ->where('type', SupportUpdate::class)
                ->count();
        }

        if (auth()->check()) {
            // $totalNotificationsCount = auth()->user()->unreadNotifications->count();

            $notifications = DB::table('notifications')
                ->select('notifications.*')
                ->join('notification_types', 'notifications.id', '=', 'notification_types.notification_id')
                ->where('notifications.notifiable_id', auth()->user()->id)
                ->where('notification_types.notifiable_type', '!=', Support::class)
                ->orderBy('notifications.created_at', 'DESC')
                ->get();

            $notifications = $notifications->map(function ($notification) {
                $notification->data = json_decode($notification->data, true);
                return $notification;
            });

            $totalNotificationsCount = $notifications->where('read_at', null)->count();
            $allNotifications = $notifications->take(5);
        }

        if (auth()->check()) {
            view()->share([
                'ticket_notifications' => $ticketNotifications,
                'ticket_notifications_count' => $ticketNotifications->where('read_at', null)->count(),
                'total_messages_count' => $totalMessagesCount,
                'all_notifications' => $allNotifications,
                'total_notifications_count' => $totalNotificationsCount,
                'total_staff_tickets' => $totalStaffTickets,
                'total_client_tickets' => $totalClientTickets,
            ]);
        }
        return $next($request);
    }
}
