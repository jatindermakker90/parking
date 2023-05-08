<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use DataTables;
use Validator;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Airport;
use App\Models\Company;
use Illuminate\Http\Request;

class InvoiceController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request){

        $data            = Invoice::where('inoice_status','!=',config('constant.STATUS.DELETED'));
        $product_query   = new Invoice();
        $product         = $product_query->all();
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addColumn('status_name',function($row){
                        $modify_url = route('change_invoice_status',[$row->id]);
                        if($row->inoice_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('invoice.show',[$row->id]);
                           $edit_url    =  route('invoices.edit',[$row->id]);
                           $delete_url  =  route('invoices.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                          // $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           //$btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->country.' Country""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','status_name'])
                    ->make(true);
        }
        $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
        return view('admin.invoices.index')->with(['title' => 'Invoice', "header" => "Invoice Listing","airports" => $airports,"companies" => $companies]);
       
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
