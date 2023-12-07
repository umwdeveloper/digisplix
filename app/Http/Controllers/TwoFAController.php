<?php

namespace App\Http\Controllers;

use App\Mail\TwoFA;
use App\Models\TwoFA as ModelsTwoFA;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFAController extends Controller {
    public function enable2FA() {
        $user = User::findOrFail(Auth::user()->id);

        $code = (string) rand(1000, 9999);

        ModelsTwoFA::updateOrCreate(
            ['user_id' => $user->id],
            ['code' => $code]
        );

        Mail::to($user->email)->send(new TwoFA($code));

        $user->fill([
            '2fa' => true
        ]);

        $user->save();
    }
}
