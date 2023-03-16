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
use App\Models\AffiliateDiscount;
use DataTables;
use Validator;

class AffiliateDiscountController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        return redirect()->route('affiliate-discount.create');
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        return view('admin.discountAffiliate.create')->with([
            'title' =>'Affiliate Discount', 
            'header' => 'Add Affiliate discount', 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $save_affiliate = AffiliateDiscount::addAffiliate($request);
        return redirect()->route('affiliate-discount.create')->with(['success' => 'Affiliate discount created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AffiliateDiscount  $affiliateDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(AffiliateDiscount $affiliateDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AffiliateDiscount  $affiliateDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(AffiliateDiscount $affiliateDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AffiliateDiscount  $affiliateDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AffiliateDiscount $affiliateDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AffiliateDiscount  $affiliateDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(AffiliateDiscount $affiliateDiscount)
    {
        //
    }
}
