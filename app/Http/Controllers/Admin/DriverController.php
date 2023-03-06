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
use App\Models\DriverDocuments;
use App\Models\Countries;

class DriverController extends WebController
{
    


    /**
     * Display a listing of the Driver Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
       
        $data            = User::whereHas('roles',function($query){
                            $query->where('key','driver');
                          });
        $country              = $request->has('country') && $request->country ? $request->country : null;
        if($country){
           $country_detail    = Countries::where('id','=',$country)->first();
           if($country_detail)
           $data->where('country_code',$country_detail->country_code);  
        }
        $countries            = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_status',function($row){
                        $modify_url = route('change_driver_status',[$row->id]);
                        if($row->user_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('drivers.show',[$row->id]);
                           $edit_url    =  route('drivers.edit',[$row->id]);
                           $delete_url  =  route('drivers.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                          $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' User""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','user_status'])
                    ->make(true);
        }
        return view('admin.drivers.index')->with(['title' => 'Drivers', "header" => "Drivers Listing",'countries' => $countries,'country' => $country]);
       
    }
       /**
     * Show the form for adding the specified Customer Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries       = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
        $header          = 'Add Driver';
        return view('admin.drivers.create')->with(['title' =>'Drivers', "header" => $header,'countries' => $countries]);
    }

    /**
     * Update the specified Driver Resource in storage.
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
       
        $save_user = User::addCustomer($request,'driver');
        $save_drivers = DriverDocuments::addDocuments($request,$save_user);

        return redirect()->route('drivers.index')->with(['success' => 'Driver created successfully']);
    }
    /**
     * Show the form for editing the specified Driver Resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id,Request $request)
    {
        $user            = User::where('id',$user_id)->first();
        $documents       = DriverDocuments::where('user_id',$user_id)->first();
      //  print_r($documents);die;
        $countries       = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
        $header          = 'Edit '.$user->name. " Driver";
        return view('admin.drivers.edit')->with(['title' =>'Drivers', "header" => $header,'user' => $user ,'countries' => $countries, 'documents' => $documents]);
    }

    /**
     * Update the specified Driver Resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id){
       
        $validator = Validator::make($request->all(), [
            'user_id'                => 'required|exists:users,id',
            'first_name'             => 'required',
            'last_name'              => 'required',
            'email'                  => 'required|unique:users,email,'.$user_id.',id',
            'phone_number'           => 'required|unique:users,phone,'.$user_id.',id',
            'country_code'           => 'required',
        ]);
     
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
       
        $save_user = User::updateCustomer($request,'driver');
        $save_drivers = DriverDocuments::addDocuments($request,$save_user);

        return redirect()->route('drivers.index')->with(['success' => 'Driver updated successfully']);
    }

    /**
     * Remove the specified Driver Resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,Request $request)
    {

       $save_countries = User::deleteUser($user_id);
       $message = "Driver deleted successfully";
       return $this->sendSuccess([],$message,200);
      // return $this->sendResponse(null,__('messages.WEB_STATUS_MESSAGE.STATUS_UPDATE_SUCCESS',['model' => 'Driver']));  
    }

    /**
     * update the specified Driver Resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeDriverStatus($user_id,Request $request)
    {

        $request->merge(['user_id' => $user_id]);

        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|exists:users,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $countries = User::where('id',$user_id)->first();
        if($request->has('status') && ($status == 'true')){
         $countries->user_status = config('constant.STATUS.ACTIVE');
         $countries->save();
        }
        if($status == 'false'){
         $countries->user_status = config('constant.STATUS.INACTIVE');
         $countries->save();
        }
        $message = "Driver updated successfully";
        return $this->sendSuccess($countries,$message,200);
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

        $message = "Countries fetched successfully";
        return $this->sendSuccess($response,$message,200);  
    }


    
}
