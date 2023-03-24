<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use App\Models\Services;
use App\Models\Countries;
use App\Models\Bookings;
use App\Models\Airport;
use App\Models\Company;
use Validator;
use Session;
use DB;


class HomeController extends WebController
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


    public function home(Request $request)
    {
        $user       = Auth::user();
        $user_role  = $user->roles->first();
        $default_role = $user_role->key;
        Session::put('default_role', $default_role);
        // print_r($default_role);die;
        if($default_role == 'superadmin'){
            // $country    = $request->has('country') ? $request->input('country') : null;
            // $service    = $request->has('service') && $request->service ? $request->service : null;
            // $countries  = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
            // $customer   = UserRoles::join('roles','roles.id','=','user_roles.role_id')->select('roles.*')->where('roles.key','CUSTOMER')->count();
            // $driver     = UserRoles::join('roles','roles.id','=','user_roles.role_id')->select('roles.*')->where('roles.key','DRIVER')->count();
            // return view('admin.home',compact('customer','driver','countries','country'));
            $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get(); 
            $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();    
            return view('admin.booking.index')->with([
                'title' => 'Booking Management', 
                "header" => "Booking  List", 
                "airports" => $airports, 
                "companies" => $companies
            ]);

        }

         if($default_role == 'admin'){
            $country    = $request->has('country') ? $request->input('country') : null;
            $service    = $request->has('service') && $request->service ? $request->service : null;
            $countries  = Countries::where('country_code',$user->country_code)->get();
            $customer   = UserRoles::join('roles','roles.id','=','user_roles.role_id')->select('roles.*')->where('roles.key','CUSTOMER')->count();
            $driver     = UserRoles::join('roles','roles.id','=','user_roles.role_id')->select('roles.*')->where('roles.key','DRIVER')->count();
            return view('admin.home',compact('customer','driver','countries','country'));
        }

    }

    public function userRoles(Request $request)
    {
        $user      = Auth::user();
        
        $roles     = Roles::select('roles.*')
                            /*->when(($user->hasRole('superadmin')) function ($collection) {
                                return $collection->push(5);
                            })*/
                            ->when((!$user->hasRole('superadmin')), function ($query) {
                                return $query->whereIn('key',['driver','customer']);
                            })
                            ->withCount(['getUsers'])->get();
        return view('admin.roles.all',compact('roles'));
    }

    public function changeUserRolesStatus($role_id,Request $request)
    {
         $request->merge(['role_id' => $role_id]);

        $validator = Validator::make($request->all(), [
            'role_id'       => 'required|exists:roles,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;
      //  print_r($status);die;
        $role = Roles::where('id',$role_id)->first();
        if($request->has('status') && ($status == 'true')){
         $role->role_status = config('constant.STATUS.ACTIVE');
         $role->save();
        }
        if($status == 'false'){
         $role->role_status = config('constant.STATUS.INACTIVE');
         $role->save();
        }
        $response        = [];
        $message         = "Role status updated successfully";
        return $this->sendSuccess($response,$message,200); 
    }
    
    public function adminDashboardStats(Request $request)
    {
        $user         = Auth::user();
        $user_role    = $user->roles->first();
        $default_role = $user_role->key;
        $response     = [];
        $range          = range(0,11,1);
        $driver_data    = [];
        $customer_data  = [];
        $order_data     = [];

        $driver_query      = UserRoles::join('roles','roles.id','=','user_roles.role_id')->where('roles.key','DRIVER');
        $driver_query->select(DB::raw('count(user_roles.id) as `data`'), DB::raw("DATE_FORMAT(user_roles.created_at, '%b, %Y') new_date"),  DB::raw('YEAR(user_roles.created_at) year, MONTH(user_roles.created_at) month'));
        $driver = $driver_query->groupby('month')->get();

        $customer_query   = UserRoles::join('roles','roles.id','=','user_roles.role_id')->where('roles.key','CUSTOMER');
        $customer_query->select(DB::raw('count(user_roles.id) as `data`'), DB::raw("DATE_FORMAT(user_roles.created_at, '%b, %Y') new_date"),  DB::raw('YEAR(user_roles.created_at) year, MONTH(user_roles.created_at) month'));
        $customer = $customer_query->groupby('month')->get();

        
         foreach ($range as $key => $value) {
           $driver_details       = $driver->where('month', $value)->first();
           $driver_data[$value]  = $driver_details ?? ['data' => 0, 'new_date' =>date("M", mktime(0, 0, 0,($value+1),1,0)).", ".date("Y")] ; 

           $customer_details       = $customer->where('month', $value)->first();
           $customer_data[$value]  = $customer_details ?? ['data' => 0, 'new_date' =>date("M", mktime(0, 0, 0,($value+1),1,0)).", ".date("Y")] ;  
        }
        $response['driver']            = $driver_data;
        $response['customer']          = $customer_data;
        $response['rides']             = [];

        $message         = "Stats fetched successfully";
        return $this->sendSuccess($response,$message,200);
      
    }

    public function adminDashboardRides(Request $request)
    {
        $user         = Auth::user();
        $user_role    = $user->roles->first();
        $default_role = $user_role->key;
        $response     = [];
        $response['rides']         = [];
        $message         = "Rides fetched successfully";
        return $this->sendSuccess($response,$message,200);
    }

    public function adminDashboardCommissons(Request $request)
    {
        $user         = Auth::user();
        $user_role    = $user->roles->first();
        $default_role = $user_role->key;
        $response     = [];
        $response['rides']         = [];
        $message         = "Commissions fetched successfully";
        return $this->sendSuccess($response,$message,200); 
    }


}
