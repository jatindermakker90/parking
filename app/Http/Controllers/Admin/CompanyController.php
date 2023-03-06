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
use App\Models\Countries;
use App\Models\OfferType;
use App\Models\CompanyType;
use App\Models\ServiceType;
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
                        if($row->company_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row) use ($user){
                            $view_url    =  route('companies.show',[$row->id]);
                            $edit_url    =  route('companies.edit',[$row->id]);
                            if($user->hasRole('superadmin')){
                               $delete_url  =  route('companies.destroy',[$row->id]);
                            }
                            // $btn = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                            $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                            if($user->hasRole('superadmin')){
                            $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' User""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            }
                           return $btn;
                    })
                    ->rawColumns(['action','company_status'])
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
        $header         =   'Add Company';
        $airports       =   Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        $offer_type     =   OfferType::get();
        $company_type   =   CompanyType::get();
        $service_type   =   ServiceType::get();
        return view('admin.company.create')->with([
            'title' =>'Company', 
            "header" => $header, 
            "airports" => $airports,
            'offer_type' => $offer_type,
            'company_type' => $company_type,
            'service_type' => $service_type
        ]);
    }

    /**
     * Update the specified Customer Resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    //    dd($request->all());
    //    die;
        $validator = Validator::make($request->all(), [
            'airport_id'                => 'required',
            'terminal_id'               => 'required',
            'company_title'             => 'required'
        ]);
  
        // if($validator->fails()){
        //    return redirect()->back()->withErrors($validator);      
        // }
        if($request->has('offer_types') && $request->offer_types){
            $request['offer_types'] = implode(', ', $request->offer_types);
        }
        if($request->has('company_types') && $request->company_types){
            $request['company_types'] = implode(', ', $request->company_types);
        }
        if($request->has('service_types') && $request->service_types){
            $request['service_types'] = implode(', ', $request->service_types);
        }

        $user = Auth::user();
        if($user){
            $request->merge(['added_by' => $user->id]);
        }
        // print_r($request->all());die;
        $save_company = Company::addCompany($request);
        return redirect()->route('companies.index')->with(['success' => 'Company created successfully']);
    }

    /**
     * Show the form for editing the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,Request $request)
    {
        echo "company show";
        die;
        $user_id = 1;
        $user            = Company::where('id',$user_id)->first();
        $countries       = Countries::where('status','!=',config('constant.STATUS.DELETED'))->get();
        $header          = $user->name;
        return view('admin.companies.show')->with(['title' =>'Company', "header" => $header,'user' => $user ,'countries' => $countries]);
    }

    /**
     * Show the form for editing the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id,Request $request)
    {
        $company        =   Company::where('id',$company_id)->first();
        $airports       =   Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        $terminal       =   AirportTerminal::where('terminal_status',config('constant.STATUS.ACTIVE'))->get();
        $offer_type     =   OfferType::get();
        $company_type   =   CompanyType::get();
        $service_type   =   ServiceType::get();

        if($company->offer_types){
            $company->offer_types = explode(",",$company->offer_types);
        }
        if($company->company_types){
            $company->company_types = explode(",",$company->company_types);
        }
        if($company->service_types){
            $company->service_types = explode(",",$company->service_types);
        }
        
        $header = 'Edit '.$company->company_title. " Company";
        return view('admin.company.edit')->with([
            'title' =>'Company', 
            "header" => $header,
            'company' => $company,
            'airports' => $airports,
            'terminal' => $terminal,
            'offer_type' => $offer_type,
            'company_type' => $company_type,
            'service_type' => $service_type
        ]);
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company_id){
        // echo($company_id);
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'airport_id'                => 'required',
            'terminal_id'               => 'required',
            'company_title'             => 'required'
        ]);
     
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        if($company_id){
            $request->merge(['company_id' => $company_id]);
        }
        $user = Auth::user();
        if($user){
            $request->merge(['added_by' => $user->id]);
        }
        if($request->has('offer_types') && $request->offer_types){
            $request['offer_types'] = implode(', ', $request->offer_types);
        }
        if($request->has('company_types') && $request->company_types){
            $request['company_types'] = implode(', ', $request->company_types);
        }
        if($request->has('service_types') && $request->service_types){
            $request['service_types'] = implode(', ', $request->service_types);
        }
        $update_company = Company::updateCompany($request);

        return redirect()->route('companies.index')->with(['success' => 'Company updated successfully']);
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id,Request $request)
    {

    //    $save_countries = User::deleteUser($company_id);
       Company::where('id',$company_id)->delete();
       $message         = "Company deleted successfully";
        return $this->sendSuccess([],$message,200);    
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
