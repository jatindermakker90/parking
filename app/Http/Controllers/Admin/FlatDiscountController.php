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
use App\Models\FlatDiscount;
use DataTables;
use Validator;

class FlatDiscountController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get_offer_type = DiscountOfferType::get();
        $get_flat_codes = AddDiscount::select('id', 'name')->get();
        if ($request->ajax()) {
            $get_flat_codes = AddDiscount::select('id', 'name')->where('offer_type_id', $request->offer_type_id)->get();
            
            $response['offer_types']       = $get_flat_codes;
            $message                       = "Offer Types fetched successfully";
            return $this->sendSuccess($response,$message,200);
        }
        return view('admin.discountFlatDiscount.create')->with([
            'title' => 'Flat Discount', 
            "header" => "Flat Discount Add",
            'get_offer_type' => $get_offer_type,
            'get_flat_codes' => $get_flat_codes
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
            'offer_type'    => 'required',
            'flat_code'     => 'required',
            'type'          => 'required',
            'amount'        => 'required'
        ]);
        
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        
        $user = Auth::user();
        if($user){
            $request->merge(['added_by' => $user->id]);
        }
        $save_flat_discount = FlatDiscount::addDiscount($request);
        return redirect()->route('flat-discount.index')->with(['success' => 'Flat discount created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlatDiscount  $flatDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(FlatDiscount $flatDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlatDiscount  $flatDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(FlatDiscount $flatDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlatDiscount  $flatDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlatDiscount $flatDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlatDiscount  $flatDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlatDiscount $flatDiscount)
    {
        //
    }
}
