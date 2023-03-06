<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DataTables;
use Validator;
use App\Models\User;
use App\Models\Products;

class ProductsController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request){

        $data            = Products::where('status','!=',config('constant.STATUS.DELETED'));
        $product_query   = new Products();
        $product         = $product_query->all();
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status_name',function($row){
                        $modify_url = route('change_product_status',[$row->id]);
                        if($row->status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('products.show',[$row->id]);
                           $edit_url    =  route('products.edit',[$row->id]);
                           $delete_url  =  route('products.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->name.' Product""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','status_name'])
                    ->make(true);
        }
        return view('admin.products.index')->with(['title' => 'Products', "header" => "Products Listing"]);
       
    }

    /**
     * Show the form for creating a new country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.products.create')->with(['title' =>'Products', "header" => "Add Product"]);
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
            'test_parameter'           => 'required',
            'test_method'              => 'required',
            'test_cost'                => 'required',
        ]);
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $save_products = new Products();
        $save_products->name = $request->has('name') ? $request->name : null;
        $save_products->test_parameter = $request->has('test_parameter') ? $request->test_parameter : null;
        $save_products->test_method = $request->has('test_method') ? $request->test_method : null;
        $save_products->test_cost = $request->has('test_cost') ? $request->test_cost : null;
        $save_products->status = 1;
        $save_products->save();

        return redirect()->route('products.index')->with(['success' => 'Product added successfully']);
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
    public function edit($product_id,Request $request)
    {
        $product         = Products::where('id',$product_id)->first();
        $header          = 'Edit '.$product->name. " Product";
        return view('admin.products.edit')->with(['title' =>'Products', "header" => $header,'product' => $product]);
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
            'test_parameter'           => 'required',
            'test_method'              => 'required',
            'test_cost'                => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $save_products = Products::where('id',$product_id)->first();
        $save_products->name = $request->has('name') ? $request->name : null;
        $save_products->test_parameter = $request->has('test_parameter') ? $request->test_parameter : null;
        $save_products->test_method = $request->has('test_method') ? $request->test_method : null;
        $save_products->test_cost = $request->has('test_cost') ? $request->test_cost : null;
        $save_products->status = 1;
        $save_products->save();

        return redirect()->route('products.index')->with(['success' => 'Product updated successfully']);
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
        $message         = "Product deleted fetched successfully";
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

        $message         = "Product status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }


    public function getProductDetails(Request $request){

        $products_id                   = $request->has('products_id') ? $request->products_id : null;
        $products_name                 = $request->has('name') ? $request->name : null;
        $check_product                 = Products::where('id',$products_id)->first();
        $product                       = $check_product ? Products::where('name',$check_product->name)->get() : null;
        $response['products']          = $product;

        return $this->sendSuccess($response,__('messages.WEB_STATUS_MESSAGE.SUCCESS',['model' => 'Product']));   
    }

}
