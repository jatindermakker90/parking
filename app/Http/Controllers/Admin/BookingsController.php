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

use Carbon\Carbon;

class BookingsController extends WebController
{
    function getDaysFromDates($start_date, $end_date){
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $start_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $end_date);

        $diff_in_days = $to->diffInDays($from);

        return $diff_in_days;
    }
    public function checkIfEndDateIsGreater(Request $request)
    {
        // dd($request->all());
        
        if(!$request->start_date){
            return response()->json([
                'code' => 203,
                'success' => 'Start date is required !'
            ]);
        }
        if(!$request->end_date){
            return response()->json([
                'code' => 203,
                'success' => 'End date is required !'
            ]);
        }

        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->start_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->end_date);

        $data = $from->greaterThanOrEqualTo($to);
        $message = 'Booking has been saved successfully !';
        return response()->json([
                'code' => 200,
                'messsage' => 'Data getsuccesfully !',
                'data' => $data
            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){    
        if ($request->ajax()) {
            $booking = Bookings::with(['vehicle', 'company', 'airport']);
            
            if($request->selected_airport && $request->selected_airport != null){
                $booking->where('airport_id', $request->selected_airport);
            }
            if($request->selected_company && $request->selected_company != null){
                $booking->where('company_id', $request->selected_company);
            }

            if($request->booking_status && $request->booking_status != null){
                $booking->where('booking_status','=',$request->booking_status);
            }
            else{
                $booking->where('booking_status','=',config('constant.BOOKING_STATUS.ACTIVE'));
            }

            if($request->start_date && $request->start_date != null){
                $booking->where('dep_date_time','>=',$request->start_date);
            }
            if($request->end_date && $request->end_date != null){
                $booking->where('return_date_time','<=',$request->end_date);
            }
            

            $booking->orderBy('id', 'desc');
            $booking_data = $booking->get();
            
            return Datatables::of($booking_data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                        return date("d-m-Y", strtotime($row->created_at));; 
                    })
                    ->editColumn('dep_date_time', function($row){
                        return date("d-m-Y H:i", strtotime($row->dep_date_time));; 
                    })
                    ->editColumn('return_date_time', function($row){
                        return date("d-m-Y H:i", strtotime($row->return_date_time));; 
                    })
                    ->addColumn('customer', function($row){
                        return $full_name = $row->first_name.' '.$row->last_name; 
                    })
                    ->editColumn('price', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Payed</button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Not Payed</button>';
                        }
                    })
                    ->editColumn('cancellation_cover', function($row){
                        if($row->cancellation_cover){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" class="edit-booking btn btn-warning btn-sm mr-2" title="Edit Booking" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-edit" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            // $btn .= '<button class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete Booking" data-type =""><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm mr-2 change-status" title="Change Status" data-id="'.$row->id.'"><i class="fas fa-stream" data-id="'.$row->id.'"></i></button>';
                            return $btn;
                    })
                    ->rawColumns([
                        'action', 
                        'customer', 
                        'price', 
                        'cancellation_cover', 
                        'sms_confirmation', 
                        'discount_code', 
                        'status'
                    ])
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
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required'
        ]);
      
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $dep_date = $request->dep_date.' '.$request->dep_time.':00';
        $return_date = $request->return_date.' '.$request->return_time.':00';
        $total_days = $this->getDaysFromDates($dep_date, $return_date);
        if($total_days == 0){
            $total_days = 1;
        }
        
        $request->merge(['total_days' => $total_days]);

        $nextBookingRefId = 'PARK4U-';
        $lastBookingRefId = $bookings->select('ref_id')->latest()->first();
        
        if($lastBookingRefId == null){
            $nextBookingRefId = $nextBookingRefId.'000001'; 
        }else{
            $add = 1;
            $get_number = substr($lastBookingRefId->ref_id,7);
            $increaseRefId = $get_number+$add;
            $increasedId = str_pad($increaseRefId,strlen($get_number),"0",STR_PAD_LEFT);
            $nextBookingRefId = $nextBookingRefId.$increasedId;
        }
        $request->merge(['ref_id'=> $nextBookingRefId]);
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
        if($request->has('updated_dep_date')){
            if($request->has('updated_dep_time')){
                $updated_dep_date_time = $request->updated_dep_date.' '.$request->updated_dep_time;
            }
            else{
                $updated_dep_date_time = $request->updated_dep_date.' 00:00';
            }
            $request->merge(['updated_dep_date_time' => $updated_dep_date_time]);
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
        if($request->has('updated_return_date')){
            if($request->has('updated_return_time')){
                $updated_return_date_time = $request->updated_return_date.' '.$request->updated_return_time;
            }
            else{
                $updated_return_date_time = $request->updated_return_date.' 00:00';
            }
            $request->merge(['updated_return_date_time' => $updated_return_date_time]);
        }

        $dep_date = $updated_dep_date_time.':00';
        $return_date = $updated_return_date_time.':00';
        $total_days = $this->getDaysFromDates($dep_date, $return_date);
        if($total_days == 0){
            $total_days = 1;
        }
        
        $request->merge(['total_days' => $total_days]);


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
        if ($request->ajax()) {
            // $booking = Bookings::with(['vehicle', 'company', 'airport'])->where('booking_status','=',config('constant.BOOKING_STATUS.CANCEL'))->get();
            // dd($booking);
            $booking = Bookings::with(['vehicle', 'company', 'airport']);
            
            if($request->selected_airport && $request->selected_airport != null){
                $booking->where('airport_id', $request->selected_airport);
            }
            if($request->selected_company && $request->selected_company != null){
                $booking->where('company_id', $request->selected_company);
            }

            if($request->booking_status && $request->booking_status != null){
                $booking->where('booking_status','=',$request->booking_status);
            }
            else{
                $booking->where('booking_status','=',config('constant.BOOKING_STATUS.CANCEL'));
            }

            if($request->start_date && $request->start_date != null){
                $booking->where('dep_date_time','>=',$request->start_date);
            }
            if($request->end_date && $request->end_date != null){
                $booking->where('return_date_time','<=',$request->end_date);
            }
            

            $booking->orderBy('id', 'desc');
            $booking_data = $booking->get();

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
                    ->editColumn('price', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Payed</button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Not Payed</button>';
                        }
                    })
                    ->editColumn('cancellation_cover', function($row){
                        if($row->cancellation_cover){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '';
                            // $btn = '<button type="button" class="edit-booking btn btn-warning btn-sm mr-2" title="Edit Booking" data-id="'.$row->id.'"><i class="fa fa-edit" data-id="'.$row->id.'" aria-hidden="true"></i></button>';
                            // $btn .= '<button class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete Booking" data-type =""><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm mr-2 change-status" title="Change Status" data-id="'.$row->id.'"><i class="fas fa-stream" data-id="'.$row->id.'"></i></button>';
                            return $btn;
                    })
                    ->rawColumns([
                        'action', 
                        'customer', 
                        'price', 
                        'cancellation_cover', 
                        'sms_confirmation', 
                        'discount_code', 
                        'status'
                    ])
                    ->make(true);
        }
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
        if ($request->ajax()) {
            // $booking = Bookings::with(['vehicle', 'company', 'airport'])->where('booking_status','=',config('constant.BOOKING_STATUS.TRASHED'))->get();
            // dd($booking);
            $booking = Bookings::with(['vehicle', 'company', 'airport']);
            
            if($request->selected_airport && $request->selected_airport != null){
                $booking->where('airport_id', $request->selected_airport);
            }
            if($request->selected_company && $request->selected_company != null){
                $booking->where('company_id', $request->selected_company);
            }

            if($request->booking_status && $request->booking_status != null){
                $booking->where('booking_status','=',$request->booking_status);
            }
            else{
                $booking->where('booking_status','=',config('constant.BOOKING_STATUS.TRASHED'));
            }

            if($request->start_date && $request->start_date != null){
                $booking->where('dep_date_time','>=',$request->start_date);
            }
            if($request->end_date && $request->end_date != null){
                $booking->where('return_date_time','<=',$request->end_date);
            }
            

            $booking->orderBy('id', 'desc');
            $booking_data = $booking->get();
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
                   ->editColumn('price', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Payed</button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 2px 0px 2px;">$'.$row->price.' Not Payed</button>';
                        }
                    })
                    ->editColumn('cancellation_cover', function($row){
                        if($row->cancellation_cover){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '';
                            // $btn = '<button type="button" class="edit-booking btn btn-warning btn-sm mr-2" title="Edit Booking" data-id="'.$row->id.'"><i class="fa fa-edit" data-id="'.$row->id.'" aria-hidden="true"></i></button>';
                            // $btn .= '<button class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete Booking" data-type =""><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm mr-2 change-status" title="Change Status" data-id="'.$row->id.'"><i class="fas fa-stream" data-id="'.$row->id.'"></i></button>';
                            return $btn;
                    })
                    ->rawColumns([
                        'action', 
                        'customer', 
                        'price', 
                        'cancellation_cover', 
                        'sms_confirmation', 
                        'discount_code', 
                        'status'
                    ])
                    ->make(true);
        }
        $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get(); 
        $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        return view('admin.booking.trasheded')->with([
            'title' => 'Booking Management', 
            "header" => "Trashed Booking List",
            'airports' => $airports, 
            'companies' => $companies
        ]);
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

        // dd($companies);
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
        
        $get_booking = $booking->with(['vehicle', 'company', 'airport'])->find($request->id);
        $get_booking->booking_id = $request->id;
        $all_companies = $company->where('airport_id', $get_booking->airport_id)->where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        $get_booking->all_companies = $all_companies;
        // dd($all_companies->toArray());
        
        $get_booking->dep_date = date("Y-m-d", strtotime($get_booking->dep_date_time));
        $get_booking->dep_time = date("H:i", strtotime($get_booking->dep_date_time));
        $get_booking->updated_dep_date = date("Y-m-d", strtotime($get_booking->updated_dep_date_time));
        $get_booking->updated_dep_time = date("H:i", strtotime($get_booking->updated_dep_date_time));
        
        $get_booking->return_date = date("Y-m-d", strtotime($get_booking->return_date_time));
        $get_booking->return_time = date("H:i", strtotime($get_booking->return_date_time));
        $get_booking->updated_return_date = date("Y-m-d", strtotime($get_booking->updated_return_date_time));
        $get_booking->updated_return_time = date("H:i", strtotime($get_booking->updated_return_date_time));

        // dd($get_booking->toArray());
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
