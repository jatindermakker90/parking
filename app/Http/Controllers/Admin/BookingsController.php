<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\AirportTerminal;
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
use App\Models\Payment;

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
        $diffInDays = $from->diffInDays($to);
        $plusOne = 1;

        $data = $from->greaterThanOrEqualTo($to);
        return response()->json([
                'code' => 200,
                'messsage' => 'Data get succesfully !',
                'data' => $data,
                'diffInDays' => $diffInDays + $plusOne
            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request->ajax()) {
            $booking = Bookings::with(['vehicle', 'company', 'airport', 'payment']);

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
                        return date("d-m-Y H:i", strtotime($row->updated_dep_date_time));;
                    })
                    ->editColumn('return_date_time', function($row){
                        return date("d-m-Y H:i", strtotime($row->updated_return_date_time));;
                    })
                    ->addColumn('customer', function($row){
                        return $full_name = $row->first_name.' '.$row->last_name;
                    })
                    ->editColumn('price', function($row){
                        if(isset($row->payment)){
                            if($row->payment->status === 2){
                                return '<button type="button" class="btn btn-sm btn-danger price-pay" style="padding: 0px 2px 0px 2px;" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'">$'.$row->payment->total_price.' Not Payed</button>';

                            }else if($row->payment->status === 1){
                                return '<span style="padding: 0px 2px 0px 2px;">$'.$row->payment->total_price.'</span>';
                            }
                        }
                        else{
                            return '<button type="button" class="btn btn-sm btn-danger price-pay" style="padding: 0px 2px 0px 2px;" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'">$'.$row->price.' No Payed </button>';
                        }
                    })
                    ->editColumn('cancellation_cover', function($row){
                        if($row->cancellation_cover){
                            return '<button type="button" title="Cancellation Covered" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" title="Cancellation not Covered" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" title="SMS Confirmation covered" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" title="SMS Confirmation not covered" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" title="Discount Code applied" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" title="Discount Code not applied" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        if($row->payment_status == 1){
                            return '<button type="button" title="Complete" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" title="Incomplete" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                        }
                    })
                    ->editColumn('email', function($row){
                        if($row->email_status){
                            return '<button type="button" title="Email" class="btn btn-sm btn-success email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                        }else{
                            return '<button type="button" title="Email" class="btn btn-sm btn-danger email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                        }
                    })
                    ->addColumn('vehicle_reg', function($row){
                        $str = '';
                        if($row->vehicle != null){
                            foreach ($row->vehicle as $key => $value) {
                                $str .= (strlen($str) > 0) ? ';<br>'.$value->vehicle_reg : $value->vehicle_reg;
                            }
                        }
                        return $str;
                    })
                    ->addColumn('action', function($row){
                            $delete_url  =  route('booking_delete',[$row->id]);
                            $btn = '<button type="button" class="view-booking btn btn-primary btn-sm mr-2" title="View Booking" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-eye" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            $btn .= '<button type="button" class="edit-booking btn btn-warning btn-sm mr-2" title="Edit Booking" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-edit" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            if($row->booking_status == 1) {
                              $btn .= '<button type="button" class="cancel-booking btn btn-danger btn-sm mr-2" title="Cancel Booking" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            } else {
                              $btn .= '<button type="button" class="cancel-booking btn btn-success btn-sm mr-2" title="Approve Booking" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            }
                            $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete-booking" title="Delete Booking" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-trash" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></a>';
                            if($row->sms_status == 1){
                              $btn .= '<button type="button" class="sms-send btn btn-success btn-sm mr-2" title="SMS Sent" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fas fa-sms" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            } else {
                                $btn .= '<button type="button" class="sms-send btn btn-danger btn-sm mr-2" title="SMS Not Sent" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fas fa-sms" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></button>';
                            }
                            return $btn;
                    })
                    ->rawColumns([
                        'action',
                        'customer',
                        'price',
                        'cancellation_cover',
                        'sms_confirmation',
                        'discount_code',
                        'email',
                        'vehicle_reg',
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
    public function store(Request $request, Bookings $bookings, VehicleDetails $vehicle_details, Payment $payment){
        $validator = Validator::make($request->all(), [
            'select_airport'            => 'required'
        ]);

        if($validator->fails()){
           return redirect()->back()->withErrors($validator);
        }
        $dep_date = $request->dep_date.' '.$request->dep_time.':00';
        $return_date = $request->return_date.' '.$request->return_time.':00';
        $total_days = $this->getDaysFromDates($dep_date, $return_date);
        $plusOne = 1;
        $total_days = $total_days + $plusOne;

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
            $paymentDetails = $payment->savePayment($request);
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
    public function update(Request $request, Bookings $booking, VehicleDetails $vehicle_details, Payment $payment){
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
        $plusOne = 1;
        $total_days = $total_days + $plusOne;


        $request->merge(['total_days' => $total_days]);

        $booking_updated_data = $booking->updateBooking($request);
        $vehicle_update_data = $vehicle_details->updateVehicle($request);
        $payment_update_data = $payment->updatePayment($request);
        if($booking_updated_data->id && $vehicle_update_data && $payment_update_data->id){
            return response()->json([
                'code' => 200,
                'path' => route('bookings.index'),
                'success' => 'Booking updated successfully !'
            ]);
        }
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
                            return '<button type="button" title="Cancellation Cover" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" title="Cancellation Cover" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" title="SMS Confirmation" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" title="SMS Confirmation" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" title="Discount code" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" title="Discount code" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" title="Payment Status" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" title="Payment Status" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '';
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
                            return '<button type="button" title="Cancellation Cover" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" title="Cancellation Cover" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('sms_confirmation', function($row){
                        if($row->sms_confirmation){
                            return '<button type="button" title="SMS Confirmation" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }else{
                            return '<button type="button" title="SMS Confirmation" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->editColumn('discount_code', function($row){
                        if($row->discount_code != null){
                            return '<button type="button" title="Discount code" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;">Yes</button>';
                        }else{
                            return '<button type="button" title="Discount code" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;">No</button>';
                        }
                    })
                    ->editColumn('status', function($row){
                        $payment_status = false;
                        if($payment_status){
                            return '<button type="button" title="Payment Status" class="btn btn-sm btn-success" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check"></i></button>';
                        }
                        else{
                            return '<button type="button" title="Payment Status" class="btn btn-sm btn-danger" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times"></i></button>';
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '';
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
        $validator = Validator::make($request->all(), [
            'select_airport'   => 'required',
        ]);

        if($validator->fails()){
           return redirect()->back()->withErrors($validator);
        }

        $dep_date = $request->dep_date.' '.$request->dep_time.':00';
        $return_date = $request->return_date.' '.$request->return_time.':00';

        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $dep_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $return_date);

        $month = $to->month;
        $year = $to->year;

        $airports = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        $terminal = AirportTerminal::where('airport_id', $request->select_airport)->get();

        $companies  = Company::where('company_status', config('constant.STATUS.ACTIVE'))
                            ->where('airport_id', $request->select_airport)
                            ->get();

        if($companies->count() > 0){
            foreach ($companies as $key => $value) {

                $value->final_booking_price = getCompanyPriceByDays([
                                                'company' => $value,
                                                'no_of_days_booking' => $request->no_of_days_booking,
                                                'month' => $month,
                                                'year' => $year,
                                                'discount_amount' => $request->discount_amount,
                                                'discount_type' => $request->discount_type
                                            ]);
                $value->price_with_admin_charge = $value->final_booking_price + config('constant.BOOKING.BOOKING_CHARGE');
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
        return view('admin.booking.create')->with([
            'title' =>"Booking Management",
            "header" => "Add Booking",
            'airports' => $airports,
            'terminal' => $terminal,
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

        $get_booking = $booking->with(['vehicle', 'company', 'airport', 'payment'])->find($request->id);
        $get_booking->booking_id = $request->id;
        $all_companies = $company->where('airport_id', $get_booking->airport_id)->where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        $get_booking->all_companies = $all_companies;

        $get_booking->dep_date = date("Y-m-d", strtotime($get_booking->dep_date_time));
        $get_booking->dep_time = date("H:i", strtotime($get_booking->dep_date_time));
        $get_booking->updated_dep_date = date("Y-m-d", strtotime($get_booking->updated_dep_date_time));
        $get_booking->updated_dep_time = date("H:i", strtotime($get_booking->updated_dep_date_time));

        $get_booking->return_date = date("Y-m-d", strtotime($get_booking->return_date_time));
        $get_booking->return_time = date("H:i", strtotime($get_booking->return_date_time));
        $get_booking->updated_return_date = date("Y-m-d", strtotime($get_booking->updated_return_date_time));
        $get_booking->updated_return_time = date("H:i", strtotime($get_booking->updated_return_date_time));
        return response()->view('admin.booking.edit', $get_booking, 200);
    }

    public function getBookingView(Request $request, Bookings $booking, Company $company)
    {
        if(!$request->id){
            return response()->json([
                'code' => 203,
                'success' => 'Booking id is required !'
            ]);
        }

        $get_booking = $booking->with(['vehicle', 'company', 'airport','payment'])->find($request->id);
        $get_booking->booking_id = $request->id;
        $all_companies = $company->where('airport_id', $get_booking->airport_id)->where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        $get_booking->all_companies = $all_companies;

        $get_booking->dep_date = date("Y-m-d", strtotime($get_booking->dep_date_time));
        $get_booking->dep_time = date("H:i", strtotime($get_booking->dep_date_time));
        $get_booking->updated_dep_date = date("Y-m-d", strtotime($get_booking->updated_dep_date_time));
        $get_booking->updated_dep_time = date("H:i", strtotime($get_booking->updated_dep_date_time));

        $get_booking->return_date = date("Y-m-d", strtotime($get_booking->return_date_time));
        $get_booking->return_time = date("H:i", strtotime($get_booking->return_date_time));
        $get_booking->updated_return_date = date("Y-m-d", strtotime($get_booking->updated_return_date_time));
        $get_booking->updated_return_time = date("H:i", strtotime($get_booking->updated_return_date_time));

        return response()->view('admin.booking.view', $get_booking, 200);
    }

    public function getBookingCancel(Request $request, Bookings $booking, Company $company)
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

        $get_booking->dep_date = date("Y-m-d", strtotime($get_booking->dep_date_time));
        $get_booking->dep_time = date("H:i", strtotime($get_booking->dep_date_time));
        $get_booking->updated_dep_date = date("Y-m-d", strtotime($get_booking->updated_dep_date_time));
        $get_booking->updated_dep_time = date("H:i", strtotime($get_booking->updated_dep_date_time));

        $get_booking->return_date = date("Y-m-d", strtotime($get_booking->return_date_time));
        $get_booking->return_time = date("H:i", strtotime($get_booking->return_date_time));
        $get_booking->updated_return_date = date("Y-m-d", strtotime($get_booking->updated_return_date_time));
        $get_booking->updated_return_time = date("H:i", strtotime($get_booking->updated_return_date_time));

        return response()->view('admin.booking.cancel', $get_booking, 200);
    }

    public function postBookingCancel(Request $request){
      $formtype = $request->formtype;
      if(!$request->booking_id){
          return response()->json([
              'code' => 203,
              'success' => 'Booking id is required !'
          ]);
      }
      if($formtype == 'cancel'){
        $booking = Bookings::where('id',$request->booking_id)->first();
        $booking->booking_status = '3';
        $booking->special_notes = $request->notes;
        if($booking->save()){
          return redirect()->route('bookings.index');
        }
      }

      if($formtype == 'approve'){
        $booking = Bookings::where('id',$request->booking_id)->first();
        $booking->booking_status = '1';
        $booking->special_notes = $request->notes;
        if($booking->save()){
          return redirect()->route('bookings.index');
        }
      }
    }

    public function bookingdelete($booking_id, Request $request){
      $booking = Bookings::where('id',$booking_id)->first();
      if($request->ajax()){
        if($booking){
          $booking->booking_status = '2';
          if($booking->save()){

          }
        } else {
          return redirect()->back();
        }
      }
    }

    public function getBookingSMS(Request $request, Bookings $booking, Company $company)
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

        return response()->view('admin.booking.smsview', $get_booking, 200);
    }

    public function postBookingSMS(Request $request){
      if(!$request->booking_id){
          return response()->json([
              'code' => 203,
              'success' => 'Booking id is required !'
          ]);
      }
        $booking = Bookings::where('id',$request->booking_id)->first();
        $booking->sms_status = '1';
        if($booking->save()){
          return redirect()->route('bookings.index');
        }
    }

    public function getBookingEmail(Request $request, Bookings $booking, Company $company)
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

        return response()->view('admin.booking.emailview', $get_booking, 200);
    }

    public function postBookingEmail(Request $request){
      if(!$request->booking_id){
          return response()->json([
              'code' => 203,
              'success' => 'Booking id is required !'
          ]);
      }
        $booking = Bookings::where('id',$request->booking_id)->first();
        $booking->email_status = '1';
        if($booking->save()){
          return redirect()->route('bookings.index');
        }
    }

    public function getBookingPricePay(Request $request, Bookings $booking, Company $company)
    {
        if(!$request->id){
            return response()->json([
                'code' => 203,
                'success' => 'Booking id is required !'
            ]);
        }
        $get_booking = $booking->with(['vehicle', 'company', 'airport', 'payment'])->find($request->id);
        $get_booking->booking_id = $request->id;
        $all_companies = $company->where('airport_id', $get_booking->airport_id)->where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        $get_booking->all_companies = $all_companies;

        $get_booking->dep_date = date("Y-m-d", strtotime($get_booking->dep_date_time));
        $get_booking->dep_time = date("H:i", strtotime($get_booking->dep_date_time));
        $get_booking->updated_dep_date = date("Y-m-d", strtotime($get_booking->updated_dep_date_time));
        $get_booking->updated_dep_time = date("H:i", strtotime($get_booking->updated_dep_date_time));

        $get_booking->return_date = date("Y-m-d", strtotime($get_booking->return_date_time));
        $get_booking->return_time = date("H:i", strtotime($get_booking->return_date_time));
        $get_booking->updated_return_date = date("Y-m-d", strtotime($get_booking->updated_return_date_time));
        $get_booking->updated_return_time = date("H:i", strtotime($get_booking->updated_return_date_time));

        return response()->view('admin.booking.pricepay', $get_booking, 200);
    }

    public function postBookingPricePay(Request $request){
      $booking = Bookings::where('id',$request->booking_id)->first();
      $payment = Payment::where('id',$request->payment_id)->first();
        if($booking){
          $booking->payment_status = '1';
          $payment->payment_notes = $request->notes;
          $payment->status = $request->status;
          $payment->paid_amount = $request->totalPaidAmount;
          $payment->payment_method = $request->payment_method;
          $payment->transaction_id = $request->transaction_id;
          if($payment->save()){
            $booking->save();
            return redirect()->route('bookings.index');
          }
        } else {
          return redirect()->back();
        }
    }

    public function getChangeStatusHtml(Request $request, Bookings $booking)
    {
        $booking_status =  $booking->select(['id','booking_status'])->find($request->id);
        return response()->view('admin.booking.change-status-model-body', $booking_status, 200);
    }

    public function getChangeBookingStatus(Request $request, Bookings $booking)
    {
        $get_booking = $booking->find($request->booking_id) ?? $booking;
        if($request->has('status') && $request->status){
            $get_booking->booking_status = $request->status;
        }
        $updated_booking = $get_booking->save();
        if($updated_booking){
            return response()->json([
                'code' => 200,
                'path' => route('bookings.index'),
                'success' => 'Booking status updated successfully !'
            ]);
        }

    }

    public function getUpdatedPrice(Request $request, Company $company, Bookings $booking)
    {   
        $response = [];
        $booking_details = $booking->with(['payment'])->find($request->booking_id);
        $company_details = $company->find($request->company);

        $dep_date = $request->dep_date.' '.$request->dep_time.':00';
        $return_date = $request->return_date.' '.$request->return_time_new.':00';

        $dep_date_updated = $request->updated_dep_date.' '.$request->updated_dep_time.':00';
        $return_date_updated = $request->updated_return_date.' '.$request->updated_return_time.':00';

        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $dep_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $return_date);

        $to_updated = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $dep_date_updated);
        $from_updated = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $return_date_updated);

        $diffInDays = $from->diffInDays($to);
        $diffInDaysUpdated = $from_updated->diffInDays($to_updated);
        $plusOne = 1;
        $diffInDaysUpdated = $diffInDaysUpdated + $plusOne;
        $month = $to_updated->month;
        $year = $to_updated->year;

        $get_price = getCompanyPriceByDays([
                    'company' => $company_details,
                    'no_of_days_booking' => $diffInDaysUpdated,
                    'month' => $month,
                    'year' => $year,
                    'discount_amount' => $booking_details->payment->discount_amount,
                    'discount_type' => $booking_details->payment->discount_type,
                    'total_vehicle' => count($request->vehicle)

                ]);
        $base_price = $get_price;
        if($booking_details->cancellation_cover){
            $get_price = $get_price + config('constant.BOOKING.CANCELLATION_CHARGE');
        }
        if($booking_details->sms_confirmation){
            $get_price = $get_price + config('constant.BOOKING.SMS_CONFIRMATION');
        }
        $get_price = $get_price + config('constant.BOOKING.BOOKING_CHARGE');
        $diff_in_price = $get_price - $booking_details->price;

        $response['old_price'] = $booking_details->price;
        $response['new_price'] = $get_price;
        $response['diff_price'] = $diff_in_price;
        $response['no_of_days'] = $diffInDaysUpdated;
        $response['admin_charge'] = config('constant.BOOKING.BOOKING_CHARGE');
        $response['base_price'] = $base_price;
        return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $response
            ]);
    }

}
