<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email'    => $request->{$this->username()},
            'password' => $request->password,
            'status'   => 1,
        ];
    }

    protected function authenticated(Request $request, $user)
    {
        $user->access_number++;
        $user->last_login_at = Carbon::now();
        
        $user->save();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}