<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check() && Auth::user()->role->id == 1){
            $redirectTo = route('admin.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id == 2){
            $redirectTo = route('author.dashboard');
        }
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) { 
            if ($user->role->id == 1) {
                return redirect()->route('admin.dashboard');
            } else if($user->role->id == 2) {
                return redirect()->route('author.dashboard');
            }
    
            return redirect('/home');
        }

}
