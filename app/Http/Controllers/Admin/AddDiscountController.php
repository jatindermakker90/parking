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
use App\Models\AddDiscount;
use DataTables;
use Validator;

class AddDiscountController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_offer_type = DiscountOfferType::get();
        return view('admin.discountAddDiscount.create')->with([
            'title' => 'Add Discount', 
            "header" => "Add Discount Add",
            'get_offer_type' => $get_offer_type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date'   => 'required',
            'end_date'     => 'required',
            'name'         => 'required',
            'offer_type'   => 'required'
        ]);
        
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        
        $user = Auth::user();
        if($user){
            $request->merge(['added_by' => $user->id]);
        }
        $save_add_discount = AddDiscount::addDiscount($request);
        return redirect()->route('add-discount.index')->with(['success' => 'addDiscount created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddDiscount  $addDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(AddDiscount $addDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddDiscount  $addDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // dd($id);
        $get_discount = AddDiscount::where('id', $id)->first();
        // dd($get_discount);
        $get_offer_type = DiscountOfferType::get();
        return view('admin.discountAddDiscount.edit')->with([
            'title' => 'Edit Discount', 
            "header" => "Add Discount Edit",
            'get_discount' => $get_discount,
            'get_offer_type' => $get_offer_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddDiscount  $addDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id, $request->all());
         $validator = Validator::make($request->all(), [
            'start_date'    => 'required',
            'end_date'      => 'required',
            'name'          => 'required',
            'offer_type'    => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        if($id){
            $request->merge(['discount_id' => $id]);
        }

        $update_discount = AddDiscount::updateAddDiscount($request);
        return redirect()->route('discoun-code-list')->with(['success' => 'Discount updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddDiscount  $addDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // dd($id);
        AddDiscount::where('id',$id)->delete();
        $message = "Discount deleted successfully";
        return $this->sendSuccess([],$message,200); 
    }

    public function discountCodeList(Request $request){
        if ($request->ajax()) {
            $data_query = AddDiscount::with(['offer_type'])->get();
            $user = Auth::user();

            return Datatables::of($data_query)
                    ->addIndexColumn()
                    ->editColumn('start_date', function($row){
                        return date('d-m-Y', strtotime($row->start_date) );
                    })
                    ->editColumn('end_date', function($row){
                        return date('d-m-Y', strtotime($row->end_date) );
                    })
                    ->addColumn('status', function($row){
                        $todayDate = date('d-m-Y', strtotime(now()));
                        $startDate = date('d-m-Y', strtotime($row->start_date)); 
                        $lastDate = date('d-m-Y', strtotime($row->end_date));
                        if($startDate < $todayDate && $todayDate < $lastDate){
                            return 'Active';
                        }
                        else{
                            return 'Expired';
                        }
                    })
                    ->addColumn('action', function($row) use ($user){
                        $edit_url    =  route('add-discount.edit',[$row->id]);
                        $delete_url  =  route('add-discount.destroy',[$row->id]);
                        $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                        $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' discount""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
        }
        return view('admin.discountAddDiscount.index')->with([
            'title' => 'Discount Code', 
            'header' => "Discount Code Listing"
        ]);
    }

    public function discountCodeReport(Request $request){
        $offer_type = DiscountOfferType::select('id', 'name')->where('status','=',config('constant.STATUS.ACTIVE'))->get();   
        
        if ($request->ajax()) {
            $offer_type_id = $request->offer_type;
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));

            $addDiscount = AddDiscount::where('offer_type_id', $offer_type_id)
                        ->where('start_date', '>=', $start_date)
                        ->where('end_date', '<=', $end_date)
                        ->get();

            return Datatables::of($addDiscount)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        $todayDate = date('d-m-Y', strtotime(now()));
                        $startDate = date('d-m-Y', strtotime($row->start_date)); 
                        $lastDate = date('d-m-Y', strtotime($row->end_date));
                        if($startDate < $todayDate && $todayDate < $lastDate){
                            return 'Active';
                        }
                        else{
                            return 'Expired';
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        return view('admin.discountAddDiscount.discount-report')->with([
            'title' => 'Discount Report', 
            'header' => "Discount Code Report",
            'offer_type' => $offer_type
        ]);
    }
}
