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
            if ($request->ajax()) {
            // $booking = Bookings::with(['vehicle', 'company', 'airport'])->where('booking_status','=',config('constant.BOOKING_STATUS.TRASHED'))->get();
            // dd($booking);
            dd($request->all());
            $booking = Bookings::with(['vehicle', 'company', 'airport']);
            
            if($request->selected_airport && $request->selected_airport != null){
                $booking->where('airport_id', $request->selected_airport);
            }
            if($request->selected_company && $request->selected_company != null){
                $booking->where('company_id', $request->selected_company);
            }

            if($request->booking_status && $request->booking_status != null){
                $booking->where('booking_status','=',$request->booking_status);
            }
            else{
                $booking->where('booking_status','=',config('constant.BOOKING_STATUS.ACTIVE'));
            }

            if($request->start_date && $request->start_date != null){
                $booking->where('dep_date_time','>=',$request->start_date);
            }
            if($request->end_date && $request->end_date != null){
                $booking->where('return_date_time','<=',$request->end_date);
            }
            

            $booking->orderBy('id', 'desc');
            $booking_data = $booking->get();
            return Datatables::of($booking)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                        return date("d-m-Y", strtotime($row->created_at));; 
                    })
                    ->editColumn('dep_date_time', function($row){
                        return date("d-m-Y H:i:s", strtotime($row->dep_date_time));; 
                    })
                    ->editColumn('return_date_time', function($row){
                        return date("d-m-Y H:i:s", strtotime($row->return_date_time));; 
                    })
                    ->addColumn('customer', function($row){
                        return $full_name = $row->first_name.' '.$row->last_name; 
                    })
                   ->editColumn('price', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Payed</button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Not Payed</button>';
                        }
                    })
                    ->editColumn('cancellation_cover', function($row){
                        if($row->cancellation_cover){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '';
                            // $btn = '<button type="button" class="edit-booking btn btn-warning btn-sm mr-2" title="Edit Booking" data-id="'.$row->id.'"><i class="fa fa-edit" data-id="'.$row->id.'" aria-hidden="true"></i></button>';
                            // $btn .= '<button class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete Booking" data-type =""><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm mr-2 change-status" title="Change Status" data-id="'.$row->id.'"><i class="fas fa-stream" data-id="'.$row->id.'"></i></button>';
                            return $btn;
                    })
                    ->rawColumns([
                        'action', 
                        'customer', 
                        'price', 
                        'cancellation_cover', 
                        'sms_confirmation', 
                        'discount_code', 
                        'status'
                    ])
                    ->make(true);
            }
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
