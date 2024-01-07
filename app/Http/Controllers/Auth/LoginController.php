<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TwoFAController;
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
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm() {
        $subdomain = $this->getSubdomain();
        $title = "";

        if ($subdomain === 'admin') {
            $title = "Admin Login";
        } elseif ($subdomain === 'partner') {
            $title = "Partner Login";
        } elseif ($subdomain === 'client') {
            $title = "Client Login";
        }

        return view('auth.login', ['title' => $title]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            if (auth()->user() && auth()->user()->two_fa) {
                $twoFA = new TwoFAController();
                $twoFA->sendCode();
                return redirect()->route('2fa.index');
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
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
                    $user = User::findOrFail($user->id);
                    $user->two_fa_completed = false;
                    $user->save();
                    return true;
                }
                $this->guard()->logout();
            } elseif ($subdomain === "partner") {
                if ($user->userable_type === Partner::class) {
                    $user = User::findOrFail($user->id);
                    $user->two_fa_completed = false;
                    $user->save();
                    return true;
                }
                $this->guard()->logout();
            } elseif ($subdomain === "client") {
                if ($user->userable_type === Client::class && $user->userable->is_client == 1) {
                    $user = User::findOrFail($user->id);
                    $user->two_fa_completed = false;
                    $user->save();
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
            return redirect()->route('partner.leads.index');
        } else if ($user->userable_type === Client::class) {
            return redirect()->route('client.projects.index');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        if (auth()->check()) {
            $user = User::findOrFail(auth()->user()->id);
            $user->two_fa_completed = false;
            $user->save();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Cache::forget('preloader');

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
