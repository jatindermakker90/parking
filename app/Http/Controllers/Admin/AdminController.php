<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries as CountriesList;

use DataTables;
use Validator;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use App\Models\Countries;

class AdminController extends WebController
{
    


    /**
     * Display a listing of the Admin Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
       
        $data            = User::whereHas('roles',function($query){
                            $query->where('key','admin');
                          });
        $data->where('user_status',config('constant.STATUS.ACTIVE'));

        $country              = $request->has('country') && $request->country ? $request->country : null;
        if($country){
           $country_detail    = Countries::where('id','=',$country)->first();
           if($country_detail)
           $data->where('country_code',$country_detail->country_code);  
        }
        $countries            = Countries::where('status','=',config('constant.STATUS.ACTIVE'))->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_status',function($row){
                        $modify_url = route('change_admin_status',[$row->id]);
                        if($row->user_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('service-providers.show',[$row->id]);
                           $edit_url    =  route('service-providers.edit',[$row->id]);
                           $delete_url  =  route('service-providers.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' User""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','user_status'])
                    ->make(true);
        }
        return view('admin.service-providers.index')->with(['title' => 'Admin', "header" => "Admin Listing",'countries' => $countries,'country' => $country]);
       
    }
     /**
     * Show the form for adding the specified Admin Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries       = Countries::where('status','=',config('constant.STATUS.ACTIVE'))->get();
        $header          = 'Add Admin';
        return view('admin.service-providers.create')->with(['title' =>'Admin', "header" => $header,'countries' => $countries]);
    }

    /**
     * Update the specified Admin Resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       
        $validator = Validator::make($request->all(), [
            'first_name'             => 'required',
            'last_name'              => 'required',
            'password'               => 'required',
            'email'                  => 'required|unique:users,email',
            'phone_number'           => 'required|unique:users,phone',
            'country_code'           => 'required',
        ]);
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
       
        $user = Auth::user();
       
        $save_user = User::addCustomer($request,'admin');
        return redirect()->route('service-providers.index')->with(['success' => 'Admin creat successfully']);
    }
    /**
     * Show the form for editing the specified Admin Resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,Request $request)
    {
        $user            = User::where('id',$user_id)->first();
        //echo "<pre>";
        //print_r($user);die;
        $countries       = Countries::where('status','=',config('constant.STATUS.ACTIVE'))->get();
        $header          = 'Edit '.$user->name. " Admin";
        return view('admin.service-providers.edit')->with(['title' =>'Admin', "header" => $header,'user' => $user ,'countries' => $countries]);
    }

    /**
     * Update the specified Admin Resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id){
       
        $validator = Validator::make($request->all(), [
            'user_id'                => 'required|exists:users,id',
            //'name'                   => 'required',
            'first_name'             => 'required',
            'last_name'              => 'required',
            'email'                  => 'required|unique:users,email,'.$user_id.',id',
            'phone_number'           => 'required|unique:users,phone,'.$user_id.',id',
            'country_code'           => 'required',
        ]);
     
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $save_user = User::updateCustomer($request,'admin');
        return redirect()->route('service-providers.index')->with(['success' => 'Admin updated successfully']);
    }

    /**
     * Remove the specified Admin Resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,Request $request)
    {

        $save_user = User::deleteUser($user_id);
        $message = "Admin deleted successfully";
        return $this->sendSuccess(null,$message,200);

    }

     /**
     * update the specified Admin Resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeAdminStatus($user_id,Request $request)
    {

        $request->merge(['user_id' => $user_id]);

        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|exists:users,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $user = User::where('id',$user_id)->first();
        if($request->has('status') && ($status == 'true')){
         $user->user_status = config('constant.STATUS.ACTIVE');
         $user->save();
        }
        if($status == 'false'){
         $user->user_status = config('constant.STATUS.INACTIVE');
         $user->save();
        }
        $message = "Admin updated successfully";
        return $this->sendSuccess($user,$message,200);
    }

    /**
     * get the specified country details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCountriesDetails(Request $request){

        $name = $request->has('name') ? $request->name : null;
        $countries_query               = new CountriesList();
        $countries                     = $countries_query->where('name.common', $name)->first();
        $response['country_iso_code']  = $countries->cca3;
        $response['country_code']      = $countries->calling_codes->first();
        $response['currency']          = $countries->currencies->first();
        $response['languages']         = $countries->languages->first();
        $response['language_iso_code'] = $countries->languages->first() ? ucwords($countries->languages->keys()->first()) : '';

        return $this->sendResponse($response,__('messages.WEB_STATUS_MESSAGE.SUCCESS',['model' => 'Country']));   
    }


    
}
