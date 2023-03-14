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
use App\Models\AssignDiscount;
use DataTables;
use Validator;

class AssignDiscountController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $airport = Airport::select('id', 'airport_name')->where('airport_status','=',config('constant.STATUS.ACTIVE'))->get();
        $offer_type = DiscountOfferType::select('id', 'name')->where('status','=',config('constant.STATUS.ACTIVE'))->get();   
        // dd($airport);
        if ($request->ajax()) {
            $companies = Company::select('id', 'company_title')->where('airport_id', $request->airport_id)->get();
            
            $response['companies']         = $companies;
            $message                       = "Companies fetched successfully";
            return $this->sendSuccess($response,$message,200);
        }
        return view('admin.discountAssignDiscount.create')->with([
            'title' => 'Assign Discount', 
            "header" => "Assign Discount",
            'airport' => $airport,
            'offer_type' => $offer_type
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'offer_type'    => 'required',
            'airport'     => 'required',
            'company'          => 'required'
        ]);
        
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        
        $user = Auth::user();
        if($user){
            $request->merge(['added_by' => $user->id]);
        }
        $save_flat_discount = AssignDiscount::addAssignDiscount($request);
        return redirect()->route('assign-discount.index')->with(['success' => 'Assign discount created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignDiscount  $assignDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(AssignDiscount $assignDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignDiscount  $assignDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignDiscount $assignDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignDiscount  $assignDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignDiscount $assignDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignDiscount  $assignDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignDiscount $assignDiscount)
    {
        //
    }
}
