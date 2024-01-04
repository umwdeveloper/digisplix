<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller {
    public function markAsRead(Request $request) {
        if (auth()->check()) {
            $link = $request->query('url');

            /** @var \App\Models\User|null */
            $user = auth()->user();
            $notification = $user->notifications()->where('data->link', $link)->first();

            if ($notification) {
                $notification->markAsRead();
            }

            return redirect()->to($link);
        }
    }
}
