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
use App\Models\VehicleDetails;

class BookingsController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){    
        if ($request->ajax()) {
            $booking = Bookings::with(['vehicle', 'company', 'airport'])->where('booking_status','!=',config('constant.STATUS.DELETED'))->get();
            return Datatables::of($booking)
                    ->addIndexColumn()
                    ->addColumn('customer', function($row){
                        return $full_name = $row->first_name.' '.$row->last_name; 
                    })
                    ->addColumn('ref_no', function($row){
                        return '123'; 
                    })
                    ->addColumn('action', function($row){
                            $btn = '<a href="#" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                            $btn .= '<a href="#" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type =""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action', 'customer', 'ref_no'])
                    ->make(true);
        }
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
    public function store(Request $request, Bookings $bookings, VehicleDetails $vehicle_details){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required',
            // 'dep_date'                  => 'required',
            // 'dep_time'                  => 'required',
            // 'return_date'               => 'required',
        ]);
      
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $bookingSave = $bookings::addBooking($request);

        if($bookingSave->count() > 0  && $bookingSave->id){
            $request->merge(['booking_id' => $bookingSave->id]);
            $bookingVehicle = $vehicle_details::addVehical($request);
        }
        $response = [];
        $response['booking_details'] = $bookingSave;
        $response['vehicle_details'] = $bookingVehicle;
        $response['path'] = route('bookings.index');
        $message = 'Booking has been saved successfully !';
        return $this->sendSuccess($response,$message,200);
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
