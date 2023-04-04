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
use App\Models\AssignAdminToCompany;
use App\Models\CloseCompany;
use App\Models\CompaniesOperation;
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

        $data_query = Company::with(['operation'])
                    ->where('company_status','!=',config('constant.STATUS.DELETED'))
                    ->whereNotNull('company_status')
                    ->get();
        // dd($data_query->toArray());
        
        // $data_query->where(function($query){
        //     $query->where('company_status','!=',config('constant.STATUS.DELETED'));
        //     $query->whereNotNull('company_status');
        // });
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
                    ->editColumn('logo_id', function($row){
                        if($row->logo_id != 1){
                            $path = config('constant.GET_IMAGE').$row->logo_id;
                            
                            return '<img height="50" width="100" src="'.$path.'" />';
                            // return '<div>'.$path.'</div>';
                        }
                        else{
                            return 1;
                        }
                    })
                    ->addColumn('manage_price',function($row){
                        $manage_price_url    =  route('manage-company-price',[$row->id]);
                        $btn = '<a href="'.$manage_price_url.'" class="manage-price btn btn-outline-secondary btn-sm">Manage Price</a>';
                        // '<button type="button" class="btn btn-xs btn-outline-secondary manage-plan-button" data-companyId="'.$row->id.'">Manage Price</button>';
                        return $btn;
                    })
                    ->addColumn('action', function($row) use ($user){
                            $operation_id = ($row->operation != null) ? $row->operation->id : null; 
                            $view_url    =  route('companies.show',[$row->id]);
                            $edit_url    =  route('companies.edit',[$row->id]);
                            $operation_url = ($row->operation != null) ? route('get-company-operations', [$row->operation->id]) : null;
                            if($user->hasRole('superadmin')){
                               $delete_url  =  route('companies.destroy',[$row->id]);
                               $company_operation_url = "";//route('company-operation-html', [$row->id]);
                            }
                            // $btn = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                            $btn = '<a href="'.$edit_url.'" title="Edit" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                            if($user->hasRole('superadmin')){
                            $btn .= '<a href="'.$operation_url.'" data-id="'.$row->id.'" title="Operations" data-operation="'.$operation_id.'" class="btn btn-info btn-sm mr-2 company-operation" data-type ="'.$row->company_title.' Company""><i class="fa fa-compass" data-id="'.$row->id.'" data-operation="'.$operation_id.'"></i></a>';
                            $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete" data-type ="'.$row->name.' Company""><i class="fa fa-trash"></i></a>';
                            }
                           return $btn;
                    })
                    ->rawColumns([
                        'action', 
                        'manage_price', 
                        'company_status',
                        'logo_id'
                        ])
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
  
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
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

    public function companyOwnersView(Request $request){
        $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))
                    ->get()->toArray();
        // dd($companies);
        $user = Auth::user();
        $data_query = User::with(['companies'])->get();
        // dd($data_query->toArray());
        if ($request->ajax()) {
            return Datatables::of($data_query)
                    ->addIndexColumn()
                    ->editColumn('user_status',function($row){
                        $modify_url = route('change_users_status',[$row->id]);
                        if($row->user_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('assign_user', function($row) use ($user){
                        // $assign_user_url = route('admin/company/assign-user-to-companies', [$row->id]);

                        // $btn = '<button class="view open-assign-modal btn btn-default btn-sm mr-2" data-toggle="modal" data-target="#modal-default">Assign Admin</button>';
                        $btn = '<button id=user_element_'.$row->id.' class="view open-assign-modal btn btn-default btn-sm mr-2">Assign Admin</button>';
                        return $btn;
                    })
                    ->addColumn('assignd_companies', function($row) use ($user){
                        
                        if(!empty($row) && $row->companies){
                            $div = '<ul class="assigned-company">';
                            foreach ($row->companies as $c_key => $c_value) {
                                $div .= '<li>'.$c_value->company_title.'<span data-uid="'.$row->id.'" data-cid="'.$c_value->id.'" class="assign-admin-remove">x</span></li>';
                            }
                            $div .= '</ul>';
                        }
                        else{
                            $div = '<ul class="assigned-company"></ul>';
                        }
                        return $div;
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
                            $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' Company""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            }
                           return $btn;
                    })
                    ->rawColumns(['action','assign_user','user_status', 'assignd_companies'])
                    ->make(true);
        }
        return view('admin.company.owners')->with([
            'title' => 'Customer', 
            "header" => " Listing",
            'companies' =>  $companies
        ]);
    }

    public function assignUserToCompanies(Request $request){
        if(!$request->email){
            return response()->json([
                'code' => 203,
                'success' => 'Email is required !'
            ]);
        }
        if(!$request->company_id){
            return response()->json([
                'code' => 204,
                'success' => 'Company id is required !'
            ]);
        }

        $user_id = User::select('id')->where('email', $request->email)->first()->id;
        if($user_id){
            $request->merge(['user_id' => $user_id]);
            $company_id = $request->company_id;
            $company = Company::select('id','company_title')->where('id', $company_id)->first()->toArray();
            $company['user_id'] = $user_id;
            $company['user_element'] = $request->user_element;
            $alreadyAssingAdmin = AssignAdminToCompany::where(['user_id'=>$user_id, 'company_id'=>$company_id])->get()->toArray();
            if(count($alreadyAssingAdmin) > 0){
                return response()->json([
                    'code' => 202,
                    'success' => 'Already assigned admin!'
                ]);
            }
            else{
                $assign_admin_to_company = AssignAdminToCompany::insert($request);
                return response()->json([
                    'code' => 200,
                    'success' => 'Assign admin successfully!',
                    'data' => $company
                ]);
            }
            
        }
        else{
            return response()->json([
                'code' => 201,
                'success' => 'User id is not found!'
            ]);
        }
        
    }

    public function removeUserToCompanies(Request $request){
        if(!$request->user_id){
            return response()->json([
                'code' => 203,
                'success' => 'User id is required !'
            ]);
        }
        if(!$request->company_id){
            return response()->json([
                'code' => 204,
                'success' => 'Company id is required !'
            ]);
        }
        $removeAssingAdmin = AssignAdminToCompany::where([
            'user_id' => $request->user_id, 
            'company_id' => $request->company_id 
        ])->delete();
        if($removeAssingAdmin){
            return response()->json([
                'code' => 200,
                'success' => 'Assigned admin has been removed!',
                'data' => $request->all()

            ]);
        }
        else{
            return response()->json([
                'code' => 400,
                'success' => 'Assigned admin couldn\'t removed.'
            ]);
        }
    }

    public function closeCompany(Request $request, CloseCompany $closeCompany)
    {
        $user = Auth::user();
        $companies = Company::where('company_status', '!=', config('constant.STATUS.DELETED'))->get();
        if ($request->ajax()) {
            $close_companies = $closeCompany->with(['company'])->get();
            return Datatables::of($close_companies)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        
                        if($row->status)
                        $btn = '<button type="button" class="btn btn-sm btn-success">Active</button>';
                        else
                        $btn = '<button type="button" class="btn btn-sm btn-danger">Unactive</button>';
                        return $btn;
                    })
                    ->addColumn('action', function($row) use ($user){
                        if($user->hasRole('superadmin')){
                            $delete_url  =  route('close-company-delete',[$row->id]);
                        }
                        $btn = '<a href="javascript:void(0);" class="btn btn-sm btn-warning mr-2 edit-close-company" data-id="'.$row->id.'"><i class="fa fa-edit" aria-hidden="true" data-id="'.$row->id.'"></i></a>';
                        if($user->hasRole('superadmin')){
                            $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->company->company_title.' Company""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        return view('admin/company/close-company')->with([
            'title' => 'Close Company',
            'header' => 'Close Company',
            'companies' => $companies
        ]);
    }

    public function closeCompanyStore(Request $request, CloseCompany $closeCompany)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'company_id'    => 'required',
            'date'          => 'required',
            'journey_type'  => 'required',
            'status'        => 'required'
        ]);
        // dd($validator);
        if($validator->fails()){
            // return $this->sendError($validator->getMessageBag()->first());  
            return redirect()->back()->withErrors($validator);      
        }

        $closeCompany->closeCompanySave($request);
        return redirect()->route('close-company')->with(['success' => 'Close company updated successfully']);
    }

    public function getcloseCompanyEditHtml(Request $request, CloseCompany $closeCompany)
    {
        $companies = Company::select('id', 'company_title')->where('company_status', '!=', config('constant.STATUS.DELETED'))->get();
        $close_company = $closeCompany->with(['company'])->find($request->id);
        $close_company->date = date("Y-m-d", strtotime($close_company->date));
        $close_company->all_companies = $companies;
        // dd($close_company);
        return response()->view('admin.company.edit-close-company', $close_company, 200);
    }

    public function closeCompanyUpdate(Request $request, CloseCompany $closeCompany)
    {
        // dd($request->all());
        $closeCompany->closeCompanyUpdate($request);
        $response = [];
        $response['path'] = route('close-company');
        $message = 'Company details has been updated successfully !';
        return $this->sendSuccess($response,$message,200);
    }

    public function closeCompanyDelete($id,Request $request)
    {
        CloseCompany::where('id',$id)->delete();
        $message         = "Company deleted successfully";
        return $this->sendSuccess([],$message,200);    
    }

    public function getCompanyOperations($id, CompaniesOperation $companiesOperation)
    {
        $getCompanyOperation = $companiesOperation->find($id);
        if($getCompanyOperation->count() > 0){
            $operation_types = config('constant.COMPANY_OPERATION_TYPE');
            foreach ($operation_types as $key => $value) {
                if($value == $getCompanyOperation->operation_type){
                    $getCompanyOperation->operation_type = $key;
                }
            }
            $response = [];
            $response['operation'] = $getCompanyOperation;
            $message = 'Company operation details fetched !';
            return $this->sendSuccess($response,$message,200);
        }
    }

    public function saveCompanyOperations(Request $request, CompaniesOperation $companiesOperation)
    {
        $defaultOperationTime = [
            "monday" => [
                "day" => "monday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ],
            "tuesday" => [
                "day" => "tuesday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ],
            "wednesday" => [
                "day" => "wednesday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ],
            "thursday" => [
                "day" => "thursday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ],
            "friday" => [
                "day" => "friday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ],
            "saturday" => [
                "day" => "saturday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ],
            "sunday" => [
                "day" => "sunday",
                "start_time" => config('constant.DEFAULT_OPERATION_TIME.START'),
                "end_time" => config('constant.DEFAULT_OPERATION_TIME.END'),
                "service" => "both",
                "status" => "open"
            ]
        ];
        if($request->has('id') && $request->id){
            $operation_id = $request->id;
        }
        else{
            $operation_id = null;
        }
        $requestData = new \stdClass();
        $requestData->company_id = $request->company_id;
        $requestData->operation_type = config('constant.COMPANY_OPERATION_TYPE.'.$request->operating_type);
        if($requestData->operation_type == 1){
            $data = $request->{$request->operating_type};
            foreach ($defaultOperationTime as $key => $value) { 
                $defaultOperationTime[$key]['status'] = $data['status'];
            }
            $requestData->weekdays = json_encode($defaultOperationTime);
        }
        else{
            $requestData->weekdays = json_encode($request->{$request->operating_type});
        }
        $save_and_update_operation = $companiesOperation->saveAndUpdateOperation($operation_id, $requestData);
        $response = [];
        $response['path'] = route('companies.index');
        if($save_and_update_operation->id){
            $message = 'Company operation has been updated successfully !';
            return $this->sendSuccess($response,$message,200);
        }
        else{
            $message = 'Something went wrong !';
            return $this->sendError($response,$message,200);
        }

    }

    public function manageCompanyPrice($id, Company $company)
    {
        $company_details = $company->where('id', $id)->first();
        // dd($company_details->toArray());

        return view('admin.company.manage-price')->with([
            "title" => 'Manage Price',
            "company_details" => $company_details
        ]);
    }
}
