<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // // dd($user->hasRole('super_admin'));
        // if($user->hasRole('super_admin')){
        //     echo "super_admin";
        //     die;
        // }
        // if($user->hasRole('dosen')){
        //     echo "dosen";
        //     die;
        // }
        // if($user->hasRole('mahasiswa')){
        //     echo "mahasiswa";
        //     die;
        // }
        return redirect()->route('dashboard');
        
    }
}
