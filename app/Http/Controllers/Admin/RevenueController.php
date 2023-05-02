<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_query = Company::with(['operation', 'airport', 'terminal'])
        ->where('company_status','!=',config('constant.STATUS.DELETED'))
        ->whereNotNull('company_status')
        ->get();
        $user = Auth::user();

        if ($request->ajax()) {
        return Datatables::of($data_query)
                ->addIndexColumn()
                ->addColumn('normal_booking',function($row){
                    $normalbooking_count = 0;
                    $normalbooking_count = Bookings::where('company_id',$row->id)->where('discount_code','=',null)->count();
                    return $normalbooking_count;
                })
                ->addColumn('discounted_booking',function($row){
                    $discountedbooking_count = 0;
                    $discountedbooking_count = Bookings::where('company_id',$row->id)->where('discount_code','!=',null)->count();
                    return $discountedbooking_count;
                })
                ->addColumn('total_booking',function($row){
                    $totalbooking_count = 0;
                    $totalbooking_count = Bookings::where('company_id',$row->id)->count();
                    return $totalbooking_count;
                })
                ->addColumn('quote_price',function($row){
                    $quote_price = 0;
                    $quote_price = Bookings::where('company_id',$row->id)->where('discount_code','=',null)->sum('price');
                    if($quote_price != 0){
                        $quote_price = number_format($quote_price,2);
                    }
                    return $quote_price;
                })
                ->addColumn('discount_price',function($row){
                    $discount_price = 0;
                    $discount_price = Bookings::where('company_id',$row->id)->where('discount_code','!=',null)->sum('price');
                    if($discount_price != 0){
                        $discount_price = number_format($discount_price,2);
                    }
                    return $discount_price;
                })
                ->addColumn('cancellation_charge',function($row){
                    $cancellation_charge = 0;
                    $temp = 0;
                    $booking_ids = Bookings::where('company_id',$row->id)->get();
                    foreach($booking_ids as $booking_id){
                        $temp = Payment::select('cancellation_charge')->where('booking_id',$booking_id->id)->pluck('cancellation_charge')->first();
                        $cancellation_charge = $cancellation_charge + $temp;
                    }
                    if($cancellation_charge != 0){
                        $cancellation_charge = number_format($cancellation_charge,2);
                    }
                    return $cancellation_charge;
                })
                ->addColumn('sms_charge',function($row){
                    $sms_charge = 0;
                    $temp = 0;
                    $booking_ids = Bookings::where('company_id',$row->id)->get();
                    foreach($booking_ids as $booking_id){
                        $temp = Payment::select('sms_charge')->where('booking_id',$booking_id->id)->pluck('sms_charge')->first();
                        $sms_charge = $sms_charge + $temp;
                    }
                    if($sms_charge != 0){
                        $sms_charge = number_format($sms_charge,2);
                    }
                    return $sms_charge;
                })
                ->addColumn('postal_charge',function($row){
                    $postal_charge = 0;
                    return $postal_charge;
                })
                ->addColumn('admin_charge',function($row){
                    $admin_charge = 0;
                    $admin_charge = Bookings::where('company_id',$row->id)->sum('admin_charge');
                    if($admin_charge != 0){
                        $admin_charge = number_format($admin_charge,2);
                    }
                    return $admin_charge;
                })
                ->addColumn('extras',function($row){
                    $extras = 0;
                    return $extras;
                })
                ->addColumn('total_amount',function($row){
                    $total_amount = 0;
                    $temp = 0;
                    $booking_ids = Bookings::where('company_id',$row->id)->get();
                    foreach($booking_ids as $booking_id){
                        $temp = Payment::select('total_price')->where('booking_id',$booking_id->id)->pluck('total_price')->first();
                        $total_amount = $total_amount + $temp;
                    }
                    if($total_amount != 0){
                        $total_amount = number_format($total_amount,2);
                    }
                    return $total_amount;
                })
                ->addColumn('commission',function($row){
                    $commission = 0;
                    return $commission;
                })
                ->addColumn('payout_amount',function($row){
                    $payout_amount = 0;
                    return $payout_amount;
                })
                ->rawColumns([
                    'extras',
                    'total_amount'
                    ])
                ->make(true);
            }
      $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
      $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
      return view('admin.revenue.index')->with([
          'title' => 'Bookings Revenue',
          "header" => "Revenue  List",
          "airports" => $airports,
          "companies" => $companies
      ]);
    }

    public function getairportrevenuepage(Request $request){
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
                  ->editColumn('email', function($row){
                      if($row->email_status){
                          return '<button type="button" title="Email" class="btn btn-sm btn-success email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                      }else{
                          return '<button type="button" title="Email" class="btn btn-sm btn-danger email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                      }
                  })
                  ->rawColumns([
                      'customer',
                      'price',
                      'cancellation_cover',
                      'sms_confirmation',
                      'discount_code',
                      'email',
                  ])
                  ->make(true);
      }
      $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
      $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
      return view('admin.revenue.airport-revenue')->with([
          'title' => 'Bookings Revenue',
          "header" => "Airport Revenue List",
          "airports" => $airports,
          "companies" => $companies
      ]);
    }

    public function getrevenuelistpage(Request $request){
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
                  ->editColumn('email', function($row){
                      if($row->email_status){
                          return '<button type="button" title="Email" class="btn btn-sm btn-success email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                      }else{
                          return '<button type="button" title="Email" class="btn btn-sm btn-danger email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                      }
                  })
                  ->rawColumns([
                      'customer',
                      'price',
                      'cancellation_cover',
                      'sms_confirmation',
                      'discount_code',
                      'email',
                  ])
                  ->make(true);
      }
      $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
      $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
      return view('admin.revenue.revenue-list')->with([
          'title' => 'Web Booking',
          "header" => "Revenue List",
          "airports" => $airports,
          "companies" => $companies
      ]);
    }

    public function getdailybookingpage(Request $request){
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
                  ->editColumn('email', function($row){
                      if($row->email_status){
                          return '<button type="button" title="Email" class="btn btn-sm btn-success email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-check" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                      }else{
                          return '<button type="button" title="Email" class="btn btn-sm btn-danger email-send" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" style="padding: 0px 4px 0px 4px;"><i class="fa fa-times" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"></i></button>';
                      }
                  })
                  ->rawColumns([
                      'customer',
                      'price',
                      'cancellation_cover',
                      'sms_confirmation',
                      'discount_code',
                      'email',
                  ])
                  ->make(true);
      }
      $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
      $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
      return view('admin.revenue.daily-booking')->with([
          'title' => 'Website Booking List',
          "header" => "Daily Booking List",
          "airports" => $airports,
          "companies" => $companies
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
