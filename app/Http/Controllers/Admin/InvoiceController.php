<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use DataTables;
use Validator;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;

class InvoiceController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request){

        $data            = Invoice::where('status','!=',config('constant.STATUS.DELETED'));
        $product_query   = new Invoice();
        $product         = $product_query->all();
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addColumn('status_name',function($row){
                        $modify_url = route('change_product_status',[$row->id]);
                        if($row->status)
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
        return view('admin.invoices.index')->with(['title' => 'Invoice', "header" => "Invoice Listing"]);
       
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
            'name'                     => 'required',
            'discpline_name'           => 'required',
            'group'                    => 'required',
            'sub_group'                => 'required',
            'test_performed'           => 'required',
            'test_method'              => 'required',
            'range_test_detection'     => 'required',
            'mu_value'                 => 'required',
            'test_status'              => 'required',
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
        $product         = Invoice::where('id',$product_id)->first();
        $header          = 'Edit '.$product->name. " Invoice";
        return view('admin.products.edit')->with(['title' =>'Invoice', "header" => $header,'product' => $product]);
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $validator = Validator::make($request->all(), [
            'product_id'               => 'required|exists:products,id',
            'name'                     => 'required',
            'discpline_name'           => 'required',
            'group'                    => 'required',
            'sub_group'                => 'required',
            'test_performed'           => 'required',
            'test_method'              => 'required',
            'range_test_detection'     => 'required',
            'mu_value'                 => 'required',
            'test_status'              => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $save_products = Products::where('id',$product_id)->first();
        $save_products->name = $request->has('name') ? $request->name : null;
        $save_products->discpline_name = $request->has('discpline_name') ? $request->discpline_name : null;
        $save_products->group = $request->has('group') ? $request->group : null;
        $save_products->sub_group = $request->has('sub_group') ? $request->sub_group : null;
        $save_products->test_performed = $request->has('test_performed') ? $request->test_performed : null;
        $save_products->test_method = $request->has('test_method') ? $request->test_method : null;
        $save_products->range_test_detection = $request->has('range_test_detection') ? $request->range_test_detection : null;
        $save_products->mu_value = $request->has('mu_value') ? $request->mu_value : null;
        $save_products->test_status = $request->has('test_status') ? $request->test_status : null;
        $save_products->save();

        return redirect()->route('products.index')->with(['success' => 'Invoice updated successfully']);
    }

    /**
     * Remove the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id,Request $request)
    {
        Products::where('id',$product_id)->delete();
        $message         = "Invoice deleted fetched successfully";
        return $this->sendSuccess([],$message,200);
    }

    /**
     * update the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProductsStatus($product_id,Request $request)
    {

        $request->merge(['product_id' => $product_id]);

        $validator = Validator::make($request->all(), [
            'product_id'       => 'required|exists:products,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $products = Products::where('id',$product_id)->first();
        if($request->has('status') && ($status == 'true')){
         $products->status = config('constant.STATUS.ACTIVE');
         $products->save();
        }
        if($status == 'false'){
         $products->status = config('constant.STATUS.INACTIVE');
         $products->save();
        }

        $message         = "Invoice status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }
}
