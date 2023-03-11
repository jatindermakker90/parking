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
        return redirect()->route('add-discount.index')->with(['success' => 'Company created successfully']);
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
    public function edit(AddDiscount $addDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddDiscount  $addDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddDiscount $addDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddDiscount  $addDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddDiscount $addDiscount)
    {
        //
    }
}
