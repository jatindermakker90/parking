<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries as CountriesList;
use App\Models\AirportTerminal;
use App\Models\Airport;
use App\Models\Company;
use App\Models\User;
use DataTables;
use Validator;

class CompanyController extends WebController
{
    


    /**
     * Display a listing of the user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $data_query = Company::query();
        $data_query->where(function($query){
            $query->where('company_status','!=',config('constant.STATUS.DELETED'));
            $query->whereNotNull('company_status');
        });
        $user = Auth::user();
    
        if ($request->ajax()) {
            return Datatables::of($data_query)
                    ->addIndexColumn()
                    ->editColumn('company_status',function($row){
                        $modify_url = route('change_company_status',[$row->id]);
                        if($row->user_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row) use ($user){
                            $view_url    =  route('users.show',[$row->id]);
                            $edit_url    =  route('users.edit',[$row->id]);
                            if($user->hasRole('superadmin')){
                               $delete_url  =  route('users.destroy',[$row->id]);
                            }
                            $btn = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                            $btn .= '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                            if($user->hasRole('superadmin')){
                            $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' User""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            }
                           return $btn;
                    })
                    ->rawColumns(['action','user_status'])
                    ->make(true);
        }
        return view('admin.company.index')->with(['title' => 'Company', "header" => "Company Listing"]);
       
    }

       /**
     * Show the form for adding the specified Customer Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header          = 'Add Company';
        $airports        = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        return view('admin.company.create')->with(['title' =>'Company', "header" => $header, "airports" => $airports]);
    }

    /**
     * Update the specified Customer Resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name'                   => 'required',
            'email'                  => 'required|unique:users,email',
            'phone_number'           => 'required|unique:users,phone',
            'country_code'           => 'required',
            'company_name'           => 'required',
            'state'                  => 'required',
            'street_address'         => 'required',
        ]);
      /*  echo "<pre>";
        print_r($request->all());die;*/
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $user = Auth::user();
        if($user){
             $request->merge(['added_by' => $user->id]);
             $request->merge(['password' => "user@123"]);
        }
        $save_user = User::addCustomer($request,'customer');
        return redirect()->route('users.index')->with(['success' => 'User created successfully']);
    }

    /**
     * Show the form for editing the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,Request $request)
    {
        $user            = User::where('id',$user_id)->first();
        $countries       = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
        $header          = $user->name;
        return view('admin.users.show')->with(['title' =>'Customer', "header" => $header,'user' => $user ,'countries' => $countries]);
    }

    /**
     * Show the form for editing the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,Request $request)
    {
        $user            = User::where('id',$user_id)->first();
        $countries       = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
        $header          = 'Edit '.$user->name. " Customer";
        return view('admin.users.edit')->with(['title' =>'Customer', "header" => $header,'user' => $user ,'countries' => $countries]);
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id){
       
        $validator = Validator::make($request->all(), [
            'user_id'                => 'required|exists:users,id',
            'name'                   => 'required',
           // 'first_name'             => 'required',
            //'last_name'              => 'required',
            'email'                  => 'required|unique:users,email,'.$user_id.',id',
            'phone_number'           => 'required|unique:users,phone,'.$user_id.',id',
            'country_code'           => 'required',
            'company_name'           => 'required',
            'state'                  => 'required',
            'street_address'         => 'required',
        ]);
     
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
             $user = Auth::user();
        if($user){
             $request->merge(['password' => "user@123"]);
        }
        $save_user = User::updateCustomer($request,'customer');

        return redirect()->route('users.index')->with(['success' => 'Customer updated successfully']);
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,Request $request)
    {

       $save_countries = User::deleteUser($user_id);
       $message         = "User deleted successfully";
        return $this->sendSuccess($response,$message,200);    
    }

    /**
     * update the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeCompanyStatus($company_id,Request $request)
    {

        $request->merge(['company_id' => $company_id]);

        $validator = Validator::make($request->all(), [
            'company_id'       => 'required|exists:companies,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $company_details = Company::where('id',$company_id)->first();
        if($request->has('status') && ($status == 'true')){
         $company_details->company_status = config('constant.STATUS.ACTIVE');
         $company_details->save();
        }
        if($status == 'false'){
         $company_details->company_status = config('constant.STATUS.INACTIVE');
         $company_details->save();
        }

        $message         = "User status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }

    /**
     * get the specified country details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fetchTerminalDetails(Request $request){

        $airport_id                    = $request->has('airport_id') ? $request->airport_id : null;
        $terminal                      = AirportTerminal::where('airport_id', $airport_id)->get();
        $response['terminal']          = $terminal;
        $message                       = "Terminal fetched successfully";
        return $this->sendSuccess($response,$message,200);      
    }


    
}
