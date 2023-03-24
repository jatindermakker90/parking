<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Airport;
use DataTables;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data            = Airport::where('airport_status','!=',config('constant.STATUS.DELETED'));
      if ($request->ajax()) {
          return Datatables::of($data)
                 // ->addIndexColumn()
                  ->addColumn('status_name',function($row){
                      $modify_url = route('change_airport_status',[$row->id]);
                      if($row->airport_status)
                      $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                      else
                      $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                      return $btn;
                  })
                  ->addColumn('action', function($row){
                         $view_url    =  route('airport.show',[$row->id]);
                         $edit_url    =  route('airport.edit',[$row->id]);
                         $delete_url  =  route('airport.destroy',[$row->id]);
                         $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                         $btn = '<a href="#" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                         $btn .= '<a href="#" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                         $btn .= '<a href="#" class="unapprove btn btn-primary btn-sm mr-2 delete_record" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-check" aria-hidden="true"></i></a>';
                         $btn .= '<a href="#" class="review-details btn btn-success btn-sm mr-2 delete_record" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                         return $btn;
                  })
                  ->addColumn('stars', function($row){
                    $star = '<div class="br-wrapper br-theme-fontawesome-stars"><select id="overall_1" name="overall" style="display: none;"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select><div class="br-widget br-readonly"><a href="#" class="br-selected" data-rating-text="1" data-rating-value="1"></a><a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a><a href="#" data-rating-value="3" data-rating-text="3" class="br-selected"></a><a href="#" data-rating-value="4" data-rating-text="4" class="br-selected"></a><a href="#" data-rating-value="5" data-rating-text="5" class="br-selected br-current"></a><div class="br-current-rating">5</div></div></div>';
                            return $star;
                  })
                  ->rawColumns(['action','status_name','stars'])
                  ->make(true);
      }
      return view('admin.review.index')->with(['title' => 'Review', "header" => "Rating List"]);
    }

    public function reviewchecklistpage(Request $request){
      $data            = Airport::where('airport_status','!=',config('constant.STATUS.DELETED'));
      if ($request->ajax()) {
          return Datatables::of($data)
                 // ->addIndexColumn()
                  ->addColumn('status_name',function($row){
                      $modify_url = route('change_airport_status',[$row->id]);
                      if($row->airport_status)
                      $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                      else
                      $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                      return $btn;
                  })
                  ->addColumn('action', function($row){
                         $view_url    =  route('airport.show',[$row->id]);
                         $edit_url    =  route('airport.edit',[$row->id]);
                         $delete_url  =  route('airport.destroy',[$row->id]);
                         $btn = '<a href="#" class="review-details btn btn-success btn-sm mr-2 delete_record" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-plus" aria-hidden="true"></i></a>';
                         return $btn;
                  })
                  ->rawColumns(['action','status_name'])
                  ->make(true);
      }
      return view('admin.review.checklist')->with(['title' => 'Review', "header" => "Website Booking List"]);
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
