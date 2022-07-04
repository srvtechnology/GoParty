<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
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


    protected function authenticated(Request $request, $user)
    {
        if (@$request->remember) {
            Cookie::queue('activarmor_admin_user_email', $request->email);
            Cookie::queue('activarmor_admin_user_password', $request->password);
        } else {
            Cookie::queue(Cookie::forget('activarmor_admin_user_email'));
            Cookie::queue(Cookie::forget('activarmor_admin_user_password'));
        }
    }


    public function loginCustom(Request $request)
    {
        if ($request->email && $request->password) {
            $user = User::where('email',$request->email)->first();
            if (@$user) {
                $password = $request->password;
                if(Hash::check($password, $user->password)){  
                    if (@$user->status=="I") {
                        return redirect()->back()->with('login_error','User account is currently inactive');
                    }
                     if (@$user->status=="D") {
                        return redirect()->back()->with('login_error','User account is currently deactive.Contact Admin.');
                    }
                    
                    Auth::login($user);
                    
                    return redirect()->back();
                   
                }else{
                    return redirect()->back()->with('login_error','Password Does Not Match');
                }
            }else{
                return redirect()->back()->with('login_error','Email Id Does Not Exists');
            }
            
       }
    }
}
