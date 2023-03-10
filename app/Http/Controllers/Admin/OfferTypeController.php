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
        // $get_offer_types = DiscountOfferType::get();
        $data_query = DiscountOfferType::query();
        // $data_query = Company::query();
        
        // $data_query->where(function($query){
        //     $query->where('company_status','!=',config('constant.STATUS.DELETED'));
        //     $query->whereNotNull('company_status');
        // });
        $user = Auth::user();
    
        if ($request->ajax()) {
            return Datatables::of($data_query)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if($row->status)
                        $btn = '<button type="button" class="btn btn-default btm-sm">Active</button>';
                        else
                        $btn = '<button type="button" class="btn btn-danger btm-sm">Inactive</button>';
                        return $btn;
                    })
                    ->addColumn('action',function($row){
                        $modify_url = route('change_company_status',[$row->id]);
                        if($row->company_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    // ->addColumn('action', function($row) use ($user){
                    //         $view_url    =  route('companies.show',[$row->id]);
                    //         $edit_url    =  route('companies.edit',[$row->id]);
                    //         if($user->hasRole('superadmin')){
                    //            $delete_url  =  route('companies.destroy',[$row->id]);
                    //         }
                    //         // $btn = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    //         $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    //         if($user->hasRole('superadmin')){
                    //         $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' Company""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    //         }
                    //        return $btn;
                    // })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.discount.offer-type.index')->with(['title' => 'Offer Type', "header" => "Offer Type"]);
       
    }

    public function create(Request $request){
        echo "create";
        $header         =   'Add Offer Type';
        return view('admin.discount.offer-type.create')->with([
            'title' =>'Company', 
            "header" => $header, 
        ]);
    }
}
