<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\WebController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use Validator;
use Hash;

class LoginController extends WebController
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
    use AuthenticatesUsers{
        logout as performLogout;
        login as performLogin;
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function login(Request $request){

        return view('admin.auth.login');
        
    }

    public function postLogin(Request $request){

            $rules = [
                'email'    => 'required',
                'password' => 'required',
            ];

            $customMessages = [
                  'email.required'    => 'Please Enter Correct Email',
                  'password.required' => 'Please Enter Correct Password',
            ];

            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
               return $this->sendError($validator->getMessageBag()->first(),$validator->getMessageBag(),400);
            }

            $check_user = User::where('email',$request->email)->first();

            if($check_user){
               if(($check_user->hasRole('superadmin') || $check_user->hasRole('admin')) && ($check_user->user_status)){
                     $is_valid_user = true;
               }else{
//                  return $this->sendSuccess([],$message,200);
                  return $this->sendError("You are not authorised to access this dashboard",[],400);
               }
            }else{
               return $this->sendError("Please use correct credentails",[],400);
            }

            if (!$this->performLogin($request)) {
                $error_message = "Please use correct credentails";
                return $this->sendError($error_message,[],401);
            }
            $request->session()->regenerate();
            $result['token'] = NULL;
            $result['user']  = auth()->user();
            $result['path']  = route('admin_home');
            $message         = "User login successfully";
            //return redirect();
            return $this->sendSuccess($result,$message,200);
        
    }

    public function logout(Request $request) {
        $user = Auth::user();
        $redirect = '/admin';
        $this->performLogout($request);
        return redirect($redirect);
    }
}
