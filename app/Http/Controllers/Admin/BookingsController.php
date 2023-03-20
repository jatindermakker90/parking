<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Routing\ResponseFactory;

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
        // dd('index');
        if ($request->ajax()) {
            $booking = Bookings::with(['vehicle', 'company', 'airport'])->where('booking_status','!=',config('constant.STATUS.DELETED'))->get();
            return Datatables::of($booking)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                        return date("d-m-Y", strtotime($row->created_at));; 
                    })
                    ->editColumn('dep_date_time', function($row){
                        return date("d-m-Y H:i:s", strtotime($row->dep_date_time));; 
                    })
                    ->editColumn('return_date_time', function($row){
                        return date("d-m-Y H:i:s", strtotime($row->return_date_time));; 
                    })
                    ->addColumn('customer', function($row){
                        return $full_name = $row->first_name.' '.$row->last_name; 
                    })
                    ->addColumn('ref_no', function($row){
                        return '123'; 
                    })
                    ->addColumn('days', function($row){
                        return '123'; 
                    })
                    // ->addColumn('price', function($row){
                    //     return '49'; 
                    // })
                    ->addColumn('cnc', function($row){
                        return '0'; 
                    })
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" class="edit-booking btn btn-warning btn-sm mr-2" title="Edit Booking" data-id="'.$row->id.'"><i class="fa fa-edit" data-id="'.$row->id.'" aria-hidden="true"></i></button>';
                            // $btn .= '<button class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete Booking" data-type =""><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm mr-2 change-status" title="Change Status" data-id="'.$row->id.'"><i class="fas fa-stream" data-id="'.$row->id.'"></i></button>';
                            return $btn;
                    })
                    ->rawColumns(['action', 'customer', 'ref_no', 'days', 'cnc'])
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
    public function update(Request $request, Bookings $booking, VehicleDetails $vehicle_details){       
        // dd($request->all());
        if(!$request->booking_id){
            return response()->json([
                'code' => 203,
                'success' => 'Booking id is required !'
            ]);
        }
        if($request->has('dep_date')){
            if($request->has('dep_time')){
                $dep_date_time = $request->dep_date.' '.$request->dep_time;
            }
            else{
                $dep_date_time = $request->dep_date.' 00:00';
            }
            $request->merge(['dep_date_time' => $dep_date_time]);
        }
        if($request->has('return_date')){
            if($request->has('return_time')){
                $return_date_time = $request->return_date.' '.$request->return_time;
            }
            else{
                $return_date_time = $request->return_date.' 00:00';
            }
            $request->merge(['return_date_time' => $return_date_time]);
        }
        // dd($request->all());
        $booking_updated_data = $booking->updateBooking($request);
        $vehicle_update_data = $vehicle_details->updateVehicle($request);
        
        if($booking_updated_data->id && $vehicle_update_data->id){
            return response()->json([
                'code' => 200,
                'path' => route('bookings.index'),
                'success' => 'Booking updated successfully !'
            ]);
        }



        
        //  return $this->sendSuccess([],$message,200);
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required',
            // 'dep_date'                  => 'required',
            // 'dep_time'                  => 'required',
            // 'return_date'               => 'required',
        ]);
        
        // dd($validator);
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

    public function getSingleBooking(Request $request, Bookings $booking, Company $company)
    {
        if(!$request->id){
            return response()->json([
                'code' => 203,
                'success' => 'Booking id is required !'
            ]);
        }
        $all_companies = $company->where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        $get_booking = $booking->with(['vehicle', 'company', 'airport'])->find($request->id);
        $get_booking->booking_id = $request->id;
        $get_booking->all_companies = $all_companies;
        $get_booking->dep_date = date("Y-m-d", strtotime($get_booking->dep_date_time));
        $get_booking->return_date = date("Y-m-d", strtotime($get_booking->return_date_time));
        $get_booking->dep_time = date("H:i", strtotime($get_booking->dep_date_time));
        $get_booking->return_time = date("H:i", strtotime($get_booking->return_date_time));


        // dd($get_booking->toArray());
        // return response()->json([
        //             'code' => 200,
        //             'success' => 'Assign admin successfully!',
        //             'data' => $get_booking
        //         ]);
        return response()->view('admin.booking.edit', $get_booking, 200);
        
                
                
    }

    public function getChangeStatusHtml(Request $request, Bookings $booking)
    {
        $booking_status =  $booking->select(['id','booking_status'])->find($request->id);
        // dd($booking_status);
        return response()->view('admin.booking.change-status-model-body', $booking_status, 200);
    }

    public function getChangeBookingStatus(Request $request, Bookings $booking)
    {
        // dd($request->all());
        $get_booking = $booking->find($request->booking_id) ?? $booking;
        if($request->has('status') && $request->status){
            $get_booking->booking_status = $request->status;
        }
        $updated_booking = $get_booking->save();
        // dd($updated_booking);
        if($updated_booking){
            return response()->json([
                'code' => 200,
                'path' => route('bookings.index'),
                'success' => 'Booking status updated successfully !'
            ]);
        }
        
    }

}
