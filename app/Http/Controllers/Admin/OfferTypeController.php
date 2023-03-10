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
use App\Models\DiscountOfferType;
use DataTables;
use Validator;

class OfferTypeController extends WebController
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data_query = DiscountOfferType::query();
            return Datatables::of($data_query)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        
                        if($row->status == 1)
                        $btn = '<button type="button" class="btn btn-sm btn-default">Active</button>';
                        else
                        $btn = '<button type="button" class="btn btn-sm btn-danger">Inactive</button>';
                        return $btn;
                    })
                    ->addColumn('action',function($row){
                        $modify_url = route('change_offer_type_status',[$row->id]);
                        if($row->status == 1)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
        }
        return view('admin.discountOfferType.index')->with([
            'title' => 'Offer Type', 
            "header" => "Offer Type"
        ]);
       
    }

    public function create(Request $request){
        $header         =   'Add Offer Type';
        return view('admin.discountOfferType.create')->with([
            'title' =>'Company', 
            "header" => $header, 
        ]);
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
  
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $user = Auth::user();
        if($user){
            $request->merge(['added_by' => $user->id]);
        }
        $save_offer_type = DiscountOfferType::addOfferType($request);
        return redirect()->route('offer-type.index')->with(['success' => 'Company created successfully']);
    }


    public function changeOfferTypeStatus($id,Request $request)
    {

        $request->merge(['offer_type_id' => $id]);

        $validator = Validator::make($request->all(), [
            'offer_type_id'       => 'required|exists:discount_offer_types,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $offer_type = DiscountOfferType::where('id',$request->offer_type_id)->first();
        if($request->has('status') && ($status == 'true')){
         $offer_type->status = config('constant.STATUS.ACTIVE');
         $offer_type->save();
        }
        if($status == 'false'){
         $offer_type->status = config('constant.STATUS.INACTIVE');
         $offer_type->save();
        }

        $message         = "Offer type status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }
}
