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

class FlatDiscountController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('flat discount');
        return view('admin.discountFlatDiscount.create')->with([
            'title' => 'Flat Discount', 
            "header" => "Flat Discount Add"
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
        //
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
