<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use DataTables;
use Validator;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Airport;
use App\Models\Company;
use App\Models\Bookings;
use App\Models\Payment;
use Illuminate\Http\Request;

class InvoiceController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request){
        $data_query = Company::with(['operation', 'airport', 'terminal'])
        ->where('company_status','!=',config('constant.STATUS.DELETED'))
        ->whereNotNull('company_status')
        ->get();
        //$user = Auth::user();

        if ($request->ajax()) {
        return Datatables::of($data_query)
                ->addIndexColumn()
                ->addColumn('total_booking',function($row){
                    $totalbooking_count = 0;
                    $totalbooking_count = Bookings::where('company_id',$row->id)->count();
                    return $totalbooking_count;
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
                    'total_amount',
                    ])
                ->make(true);
            }
      $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
      $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
      return view('admin.invoices.index')->with([
          'title' => 'Invoice',
          "header" => "Invoice Manager",
          "airports" => $airports,
          "companies" => $companies
      ]);
    }

    public function checkairportbasecompany(Request $request){
        if ($request->ajax()) {
            $companies = Company::select('id', 'company_title')->where('airport_id', $request->airport_id)->get();
            
            $response['companies']         = $companies;
            $message                       = "Companies fetched successfully";
            return $this->sendSuccess($response,$message,200);
        }
    }

    public function companyIDBaseMetaData(Request $request){
        if ($request->ajax()) {
            $companies = Company::where('id', $request->selected_company)->first();
            $message = "Information Reterived";
            return $this->sendSuccess($companies,$message,200);
        }
    }

    public function companyIDBaseData(Request $request){
        if ($request->ajax()) {
            $booking = Bookings::with(['vehicle', 'company', 'airport', 'payment']);

            if($request->selected_company && $request->selected_company != null){
                $booking->where('company_id', $request->selected_company);
            }

            if($request->start_date && $request->start_date != null){
                $booking->where('dep_date_time','>=',$request->start_date);
            }
            if($request->end_date && $request->end_date != null){
                $booking->where('return_date_time','<=',$request->end_date);
            }

            $booking->where('payment_status',1)->orderBy('id', 'desc');
            $booking_data = $booking->get();
            return Datatables::of($booking_data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){
                        return date("d-m-Y", strtotime($row->created_at));;
                    })
                    ->editColumn('dep_date_time', function($row){
                        return date("d-m-Y", strtotime($row->updated_dep_date_time));;
                    })
                    ->editColumn('return_date_time', function($row){
                        return date("d-m-Y", strtotime($row->updated_return_date_time));;
                    })
                    ->addColumn('price', function($row){
                        return number_format($row->price,2);
                    })
                    ->make(true);
            // return $this->sendSuccess($response,$message,200);
        }
    }

    /**
     * Show the form for creating a new country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.invoices.create')->with(['title' =>'Invoice', "header" => "Add Invoice"]);
    }

    /**
     * Store a newly created country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        $validator = Validator::make($request->all(), [
            'full_name'                     => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $save_products = new Invoice();
       
        $save_products->save();

        return redirect()->route('invoices.index')->with(['success' => 'Invoice added successfully']);
    }

    /**
     * Display the specified country resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified country resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($n_id,Request $request)
    {
        $invoice         = Invoice::where('id',$product_id)->first();
        $header          = 'Edit '.$invoice->name. " Invoice";
        return view('admin.invoices.edit')->with(['title' =>'Invoice', "header" => $header,'product' => $invoice]);
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $invoice_id)
    {
        
        return redirect()->route('invoices.index')->with(['success' => 'Invoice updated successfully']);
    }

    /**
     * Remove the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice_id,Request $request)
    {
        Invoice::where('id',$invoice_id)->delete();
        $message         = "Invoice deleted fetched successfully";
        return $this->sendSuccess([],$message,200);
    }

    /**
     * update the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProductsStatus($invoice_id,Request $request)
    {

        $request->merge(['invoice_id' => $invoice_id]);

        $validator = Validator::make($request->all(), [
            'invoice_id'       => 'required|exists:invoices,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $products = Invoice::where('id',$product_id)->first();
        if($request->has('status') && ($status == 'true')){
         $products->inoice_status = config('constant.STATUS.ACTIVE');
         $products->save();
        }
        if($status == 'false'){
         $products->inoice_status = config('constant.STATUS.INACTIVE');
         $products->save();
        }

        $message         = "Invoice status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }
}
