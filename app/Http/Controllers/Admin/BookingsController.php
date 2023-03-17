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
use App\Models\OfferType;
use App\Models\CompanyType;
use App\Models\ServiceType;

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
        return view('admin.booking.index')->with([
            'title' => 'Booking Management', 
            "header" => "Booking  List", 
            "airports" => $airports, 
            "companies" => $companies
        ]);
       
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $airports = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();             
        return view('admin.booking.create')->with([
            'title' =>"Booking Management", 
            "header" => "Add Booking",
            'airports' => $airports
        ]);
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bookings $bookings){
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required',
            // 'dep_date'                  => 'required',
            // 'dep_time'                  => 'required',
            // 'return_date'               => 'required',
        ]);
      
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }


        // $booking_data = [];
        // $booking_data['airport_id'] = $request->select_airport;
        // $booking_data['dep_date_time'] = $request->dep_date.' '.$request->dep_time;
        // $booking_data['return_date_time'] = $request->return_date.' '.$request->return_time;
        // $booking_data['discount_code'] = $request->discount_code;
        // $booking_data['title'] = $request->title;
        // $booking_data['first_name'] = $request->first_name;
        // $booking_data['last_name'] = $request->last_name;
        // $booking_data['email'] = $request->email;
        // $booking_data['mobile'] = $request->mobile;
        // $booking_data['cancellation_cover'] = $request->cancellation_cover;
        // $booking_data['sms_confirmation'] = $request->sms_confirmation;
        // $booking_data['no_of_people'] = $request->no_of_peopele;
        // $booking_data['drop_off_terminal'] = $request->drop_off_terminal;
        // $booking_data['return_terminal'] = $request->return_terminal;

        $bookingSave = $bookings::addBooking($request);
        // echo "<pre>";
        dd($bookingSave->toArray());


        $vehical_details = [];
        $vehical_details['booking_id']  = ''; 
        $vehical_details['vehicle_make']  = $request->vehicle_make;
        $vehical_details['vehicle_model']  = $request->vehicle_model;
        $vehical_details['vehicle_colour']  = $request->vehicle_colour;
        $vehical_details['vehicle_reg']  = $request->vehicle_reg;


        $companies = Company::where(['airport_id' => $request->select_airport])->get();
        dd($companies);


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

    public function searchCompanyList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required',
            // 'dep_date'                  => 'required',
            // 'dep_time'                  => 'required',
            // 'return_date'               => 'required',
        ]);
      
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $airports = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))
                            ->where('airport_id', $request->select_airport)
                            ->get();

                            // echo "<pre>";
        // dd($companies);
        if($companies->count() > 0){
            foreach ($companies as $key => $value) {
                if(!empty($value->company_types)){
                    $value->company_types =  CompanyType::wherein('id', explode(",", $value->company_types))->get();
                }
                if(!empty($value->offer_types)){
                    $value->offer_types =  OfferType::wherein('id', explode(",", $value->offer_types))->get();
                }
                if(!empty($value->service_types)){
                    $value->service_types =  ServiceType::wherein('id', explode(",", $value->service_types))->get();
                }

            }
        }
        // print_r($companies->toArray());
        // die;
        // $company_types = OfferType::whereIn('id', $companies->company_types)->get();
        // $companies->merge(["company_types" => OfferType::whereIn('id', $companies->company_types)]);                     

        
        return view('admin.booking.create')->with([
            'title' =>"Booking Management", 
            "header" => "Add Booking",
            'airports' => $airports,
            'searchedCompanies' => $companies,
            'request' => $request->all()
        ]);
    }

    public function searchCompanyListGet()
    {
        return redirect()->route('bookings.create');
    }

}
