<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DataTables;
use Validator;
use App\Models\User;
use App\Models\Products;
use App\Models\Bookings;
use App\Models\Invoice;
use App\Models\BookingCostMapping;

class BookingsController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request){

        $data            = Bookings::select('bookings.*','users.company_name as user_name','products.name as product_name')
                                   ->join('users','users.id','=','bookings.user_id')
                                   ->join('products','products.id','=','bookings.products_id')
                                   ->where('bookings.status','!=',config('constant.STATUS.DELETED'));
        
        if ($request->ajax()) {
         
            if($request->has('start_date') && $request->start_date){
                $data->whereDate('bookings.created_at','>=',$request->start_date);
            }
            if($request->has('end_date') && $request->end_date){
                $data->whereDate('bookings.created_at','<',$request->end_date);
            }
            if($request->has('search_text') && trim($request->search_text)){
                $search = trim($request->search_text);
                $data->where(function ($query) use ($search){
                  $query->where('po_number', 'LIKE', "%{$search}%");
                  $query->orWhere('booking_code','LIKE',"%{$search}%");
                });
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status_name',function($row){
                        $modify_url = route('change_booking_status',[$row->id]);
                        if($row->status){
                            $btn = '<a href="'.$modify_url.'" class="view btn btn-success btn-sm mr-2 print_invoice" data-id ="'.$row->id.'"><i class="fa fa-print" aria-hidden="true"></i></a>';
                            $btn .= '<a href="'.$modify_url.'" class="view btn btn-info btn-sm mr-2 print_all_invoice" data-id ="'.$row->id.'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                        }
                        else{
                        $btn = '<a href="'.$modify_url.'" class="view btn btn-success btn-sm mr-2 print_invoice" data-id ="'.$row->id.'"><i class="fa fa-print" aria-hidden="true"></i></a>';
                        $btn .= '<a href="'.$modify_url.'" class="view btn btn-info btn-sm mr-2 print_all_invoice" data-id ="'.$row->id.'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                        }
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('bookings.show',[$row->id]);
                           $edit_url    =  route('bookings.edit',[$row->id]);
                           $delete_url  =  route('bookings.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->id.' Booking""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','status_name'])
                    ->make(true);
        }
        return view('admin.booking.index')->with(['title' => 'Booking', "header" => "Booking Listing"]);
       
    }

    /**
     * Show the form for creating a new country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::where('status',config('constant.STATUS.ACTIVE'))->groupby('name')->get();
        $company = User::whereHas('roles',function($query){
                               $query->where('key','customer');
                            })
                        ->where('user_status',config('constant.STATUS.ACTIVE'))
                        ->get();
        return view('admin.booking.create')->with(['title' =>'Booking', "header" => "Add Booking",'products' => $products,'company' => $company,'product_list' => ($products ? json_encode($products) : null)]);
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
            //'test_method'              => 'required',
            'test_cost'                => 'required',
            'products_id'              => 'required',
            'po_number'                => 'required',
            'user_id'                  => 'required',
        ]);
      
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $company = User::where('id',$request->user_id)->first();
        $count   = Bookings::count();
        //$booking_code = strtoupper(substr($company->company_name, 0, 1)."".date('dmy')."".($count+1));
        $booking_code = "S".date('dmy')."".($count+1);
        $save_bookings = new Bookings();
        $save_bookings->booking_code = $booking_code;
        $save_bookings->po_number = $request->has('po_number') ? $request->po_number : null;
        $save_bookings->user_id = $request->has('user_id') ? $request->user_id : null;
        $save_bookings->products_id = $request->has('products_id') ? $request->products_id : null;
        $save_bookings->test_parameter = count($request->test_parameter) ? implode(" , ",$request->test_parameter) : null;
        $save_bookings->test_method = count($request->test_method) ? implode(" , ",$request->test_method) : null;
        $save_bookings->test_cost = $request->has('test_cost') ? $request->test_cost : null;
        $save_bookings->save();
        if(count($request->test_parameter)){
            $product_data = Products::where('id',trim($request->products_id))->first();
            foreach($request->test_parameter as $key => $value){
                $check_products = Products::where('test_parameter',trim($value))->where('name',$product_data->name)->first();
                if($check_products){
                    $key = "products_".$check_products->id;
                    $save_booking_mapping = new BookingCostMapping();
                    $save_booking_mapping->booking_id = $save_bookings->id;
                    $save_booking_mapping->products_id = $check_products->id;
                    $save_booking_mapping->products_name = $check_products->name;
                    $save_booking_mapping->test_parameter = $check_products->test_parameter;
                    $save_booking_mapping->test_cost = $request->$key;
                    $save_booking_mapping->save();
                }
            }
        }
        return redirect()->route('bookings.index')->with(['success' => 'Booking added successfully']);
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
    public function edit($booking_id,Request $request)
    {
        $booking   = Bookings::where('id',$booking_id)->first();
        $booking_mapping   = BookingCostMapping::where('booking_id',$booking_id)->get();
        $test_parameter = array_map('trim', explode(",", $booking->test_parameter));
        $products     = Products::where('status',config('constant.STATUS.ACTIVE'))->groupby('name')->get();
        $product_list = Products::whereIn('name',$booking_mapping->pluck('products_name'))
                                ->where('status',config('constant.STATUS.ACTIVE'))
                                ->get();
        $company = User::whereHas('roles',function($query){
                               $query->where('key','customer');
                            })
                        ->where('user_status',config('constant.STATUS.ACTIVE'))
                        ->get();
        $header          = 'Edit '.$booking->name. " Booking";
        return view('admin.booking.edit')->with(['title' =>'Booking', "header" => $header,'booking' => $booking,'products'=>$products,'company' => $company,'test_parameter' => $test_parameter,'booking_mapping' => $booking_mapping,'product_list' => $product_list]);
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'booking_id'               => 'required|exists:bookings,id',
            'test_method'              => 'required',
            'test_cost'                => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $save_bookings = Bookings::where('id',$booking_id)->first();
        $save_bookings->user_id = $request->has('user_id') ? $request->user_id : null;
        $save_bookings->po_number = $request->has('po_number') ? $request->po_number : null;
        $save_bookings->products_id = $request->has('products_id') ? $request->products_id : null;
        $save_bookings->test_parameter = count($request->test_parameter) ? implode(" , ",$request->test_parameter) : null;
        $save_bookings->test_method = count($request->test_method) ? implode(" , ",$request->test_method) : null;
        $save_bookings->test_cost = $request->has('test_cost') ? $request->test_cost : null;
        $save_bookings->save();
        if(count($request->test_parameter)){
            $product_data = Products::where('id',trim($request->products_id))->first();
            BookingCostMapping::where('booking_id',$booking_id)->delete();
            foreach($request->test_parameter as $key => $value){
                $check_products = Products::where('test_parameter',trim($value))->where('name',$product_data->name)->first();
                if($check_products){
                    $key = "products_".$check_products->id;
                    $save_booking_mapping = BookingCostMapping::where('booking_id',$booking_id)->where('products_id',$check_products->id)->first() ?? new BookingCostMapping();
                    $save_booking_mapping->booking_id = $save_bookings->id;
                    $save_booking_mapping->products_id = $check_products->id;
                    $save_booking_mapping->products_name = $check_products->name;
                    $save_booking_mapping->test_parameter = $check_products->test_parameter;
                    $save_booking_mapping->test_cost = $request->$key;
                    $save_booking_mapping->save();
                }
            }
        }

        return redirect()->route('bookings.index')->with(['success' => 'Booking updated successfully']);
    }

    /**
     * Remove the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($booking_id,Request $request)
    {
        Bookings::where('id',$booking_id)->delete();
        $message         = "Booking deleted fetched successfully";
        return $this->sendSuccess([],$message,200);
    }

    /**
     * update the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeBookingsStatus($booking_id,Request $request)
    {

        $request->merge(['booking_id' => $booking_id]);

        $validator = Validator::make($request->all(), [
            'booking_id'       => 'required|exists:bookings,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;
        $get_all = $request->has('get_all') ? $request->get_all : null;

        $bookings = Bookings::where('id',$booking_id)->first();
        $mapping  = BookingCostMapping::where('booking_id',$booking_id)->get();
        $user            = User::where('id',$bookings->user_id)->first();
        $products        = Products::where('id',$bookings->products_id)->first();
        if($get_all == "all_data"){
          $all_products =  Bookings::where('po_number',$bookings->po_number)->get();
        }else{
          $all_products =  Bookings::whereIn('id',[$booking_id])->get();
        }
        $invoice         = Invoice::count();
        $message         = "Booking status updated successfully";
        return $this->sendSuccess(['details' => $bookings,'mapping' => $mapping,'user' => $user,'invoice' => $invoice,'products' => $products,'all_products' => $all_products],$message,200);   
    }

}
