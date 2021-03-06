<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/apps';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    protected $username = 'email';

    public function loginNameOrEmail(Request $request)
    {

        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email_address' : 'username';

        $request->merge([$field => $request->input('email')]);

        $this->username = $field;

        return $this->login($request);
    }


    public function username()
    {
        return $this->username;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login', ['viewname' => 'Login']);
    }


    public function authenticate(){

        $email = Input::get('email');

        $password = Input::get('password');


        $attempt = Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1],true);

        dd($attempt);

        return response()->json([
            'user'
        ]);

    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }


}
