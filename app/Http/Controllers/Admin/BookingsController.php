<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DataTables;
use Validator;
use App\Models\User;
use App\Models\Bookings;
use App\Models\Airport;
use App\Models\Company;

class BookingsController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){               
        if ($request->ajax()) {}
        $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get(); 
        $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();    
        return view('admin.booking.index')->with(['title' => 'Booking Management', "header" => "Booking  List", "airports" => $airports, "companies" => $companies]);
       
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $airports = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();             
        return view('admin.booking.create')->with(['title' =>"Booking Management", "header" => "Add Booking",'airports' => $airports]);
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required',
            'dep_date'                  => 'required',
            'dep_time'                  => 'required',
            'return_date'               => 'required',
        ]);
      
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        return redirect()->route('bookings.index')->with(['success' => 'Booking added successfully']);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    
        return view('admin.booking.edit');
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){       
         return $this->sendSuccess([],$message,200);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelledBookingList(Request $request){       
        $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get(); 
        $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        return view('admin.booking.cancelled')->with(['title' => 'Booking Management', "header" => "Cancelled Booking List", 'airports' => $airports, 'companies' => $companies]);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashededBookingList(Request $request){
        return view('admin.booking.cancelled')->with(['title' => 'Booking Management', "header" => "Trashed Booking List"]);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeBookingsStatus(Request $request){
        // cancel booking 
    }

}
