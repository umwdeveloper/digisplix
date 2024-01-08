<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller {
    public function markAsRead(Request $request) {
        if (auth()->check()) {
            $link = $request->query('url');

            /** @var \App\Models\User|null */
            $user = auth()->user();
            $notifications = $user->notifications()->where('data->link', $link)->get();

            if ($notifications->count() > 0) {
                $notifications->markAsRead();
            }

            return redirect()->to($link);
        }
    }
}
