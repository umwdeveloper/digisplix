<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller {
    public function markAsRead(Request $request) {
        $link = $request->query('url');
        $notification = auth()->user()->notifications()->where('data->link', $link)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->to($link);
    }
}
