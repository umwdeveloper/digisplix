<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Staff;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
        // Session::flush();
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request) {
        $request->validate([
            $this->username() => 'required|string|email',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request) {
        $attempt = $this->guard()->attempt(
            $this->credentials($request),
            $request->boolean('remember')
        );

        if ($attempt) {
            $user = Auth::user();
            $subdomain = $this->getSubdomain();

            if ($subdomain === "admin") {
                if ($user->userable_type === Staff::class) {
                    return true;
                }
                $this->guard()->logout();
            } elseif ($subdomain === "partner") {
                if ($user->userable_type === Partner::class) {
                    return true;
                }
                $this->guard()->logout();
            } elseif ($subdomain === "client") {
                if ($user->userable_type === Client::class) {
                    return true;
                }
                $this->guard()->logout();
            }
        }

        return false;
    }

    protected function getSubdomain() {
        $request = request();
        $host = $request->getHost();

        // Parse the host to extract subdomain
        $parsedHost = parse_url($host);

        // Check if the subdomain exists
        $subdomain = isset($parsedHost['path']) ? explode('.', $parsedHost['path'])[0] : null;

        return strtolower($subdomain);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user) {
        if ($user->userable_type === Staff::class) {
            return redirect()->route('staff.index');
        } else if ($user->userable_type === Partner::class) {
            return redirect()->route('partner.index');
        } else if ($user->userable_type === Client::class) {
            return redirect()->route('client.index');
        }
    }
}
