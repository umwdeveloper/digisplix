<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller {
    public function index(Client $client) {
        $emails = $client->emails;
        return view('staff.emails.emails', compact("emails"));
    }

    public function view(Email $email) {
        return response()->json([
            'status' => 'success',
            'email' => $email
        ]);
    }
}
