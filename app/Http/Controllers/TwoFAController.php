<?php

namespace App\Http\Controllers;

use App\Events\TwoFaEvent;
use App\Mail\TwoFA;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Models\TwoFA as ModelsTwoFA;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFAController extends Controller {

    public function index() {
        // $this->sendCode();
        return view('auth.twoFA');
    }

    public function sendCode() {
        $user = User::findOrFail(Auth::user()->id);

        $code = (string) rand(1000, 9999);

        ModelsTwoFA::updateOrCreate(
            ['user_id' => $user->id],
            ['code' => $code]
        );

        Mail::to($user->email)->queue(new TwoFA($user->name, $code));
        // event(new TwoFaEvent($user, $code));
    }

    public function confirmCode(Request $request) {
        $user = User::findOrFail(Auth::user()->id);

        $code = $request->input('code');

        $twoFA = ModelsTwoFA::where('user_id', $user->id)->first();

        if ($twoFA && $twoFA->code == $code) {
            $user->two_fa = true;
            $user->two_fa_completed = true;
            $user->save();
            ModelsTwoFA::where('user_id', $user->id)->delete();

            if ($request->input('login')) {
                if ($user->userable_type === Staff::class) {
                    return redirect()->route('staff.index');
                } else if ($user->userable_type === Partner::class) {
                    return redirect()->route('partner.leads.index');
                } else if ($user->userable_type === Client::class) {
                    return redirect()->route('client.projects.index');
                }
            } else {
                return response()->json(['success' => '']);
            }
        } else {
            if ($request->input('login')) {
                return redirect()->back()->withErrors(['code' => 'This code is incorrect!']);
            } else {
                return response()->json(['error' => 'This code is incorrect!']);
            }
        }
    }

    public function disable2FA() {
        $user = User::findOrFail(Auth::user()->id);
        $user->two_fa = false;
        $user->two_fa_completed = false;
        $user->save();
        return redirect()->back()->with('status', '2FA is now disabled!');
    }
}
