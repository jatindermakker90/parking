<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Airport;
use DataTables;
use App\Models\Company;
use App\Models\Bookings;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = Bookings::with('review','company')->where('is_review_status','1')->get();
      //print_r($data); die();
      if ($request->ajax()) {
          return Datatables::of($data)
                 // ->addIndexColumn()
                 ->addColumn('company', function($row){
                     return $company = $row->company->company_title;
                 })
                 ->addColumn('review_date', function($row){
                     return $review_date = $row->review->review_date;
                 })
                 ->addColumn('publish_date', function($row){
                     return $publish_date = $row->review->publish_date;
                 })
                 ->addColumn('name', function($row){
                     return $name = $row->first_name.' '.$row->last_name;
                 })
                  ->addColumn('action', function($row){
                         $view_url    =  route('airport.show',[$row->id]);
                         $edit_url    =  route('airport.edit',[$row->id]);
                         $delete_url  =  route('airport.destroy',[$row->id]);
                         $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                         $btn = '<a href="#" class="edit btn btn-warning btn-sm mr-2" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                         $btn .= '<a href="#" class="delete btn btn-danger btn-sm mr-2 delete_record" title="Delete" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                         if($row->review->is_approve == 0){
                           $btn .= '<a href="#" class="unapprove btn btn-primary btn-sm mr-2 delete_record" title="Approve" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-check" aria-hidden="true"></i></a>';
                         } else {
                           $btn .= '<a href="#" class="unapprove btn btn-primary btn-sm mr-2 delete_record" title="Unapprove" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-ban" aria-hidden="true"></i></a>';
                         }
                         $btn .= '<a href="#" class="review-details btn btn-success btn-sm mr-2 delete_record" title="Review Details" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                         return $btn;
                  })
                  ->addColumn('stars', function($row){
                    $total_rating = Review::getOverAllRatingByBookingID($row->id);
                    switch($total_rating){
                      case 1:
                      $star = '<div class="br-wrapper br-theme-fontawesome-stars">
                      <div class="br-widget br-readonly"><a href="#" class="br-selected" data-rating-text="1" data-rating-value="1"></a><a href="#" data-rating-value="2" data-rating-text="2"></a><a href="#" data-rating-value="3" data-rating-text="3"></a><a href="#" data-rating-value="4" data-rating-text="4"></a><a href="#" data-rating-value="5" data-rating-text="5"></a><div class="br-current-rating">5</div></div></div>';
                      break;
                      case 2:
                      $star = '<div class="br-wrapper br-theme-fontawesome-stars">
                      <div class="br-widget br-readonly"><a href="#" class="br-selected" data-rating-text="1" data-rating-value="1"></a><a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a><a href="#" data-rating-value="3" data-rating-text="3"></a><a href="#" data-rating-value="4" data-rating-text="4"></a><a href="#" data-rating-value="5" data-rating-text="5"></a><div class="br-current-rating">5</div></div></div>';
                      break;
                      case 3:
                      $star = '<div class="br-wrapper br-theme-fontawesome-stars">
                      <div class="br-widget br-readonly"><a href="#" class="br-selected" data-rating-text="1" data-rating-value="1"></a><a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a><a href="#" data-rating-value="3" data-rating-text="3" class="br-selected"></a><a href="#" data-rating-value="4" data-rating-text="4"></a><a href="#" data-rating-value="5" data-rating-text="5"></a><div class="br-current-rating">5</div></div></div>';
                      break;
                      case 4:
                      $star = '<div class="br-wrapper br-theme-fontawesome-stars">
                      <div class="br-widget br-readonly"><a href="#" class="br-selected" data-rating-text="1" data-rating-value="1"></a><a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a><a href="#" data-rating-value="3" data-rating-text="3" class="br-selected"></a><a href="#" data-rating-value="4" data-rating-text="4" class="br-selected"></a><a href="#" data-rating-value="5" data-rating-text="5"></a><div class="br-current-rating">5</div></div></div>';
                      break;
                      case 5:
                      $star = '<div class="br-wrapper br-theme-fontawesome-stars">
                      <div class="br-widget br-readonly"><a href="#" class="br-selected" data-rating-text="1" data-rating-value="1"></a><a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a><a href="#" data-rating-value="3" data-rating-text="3" class="br-selected"></a><a href="#" data-rating-value="4" data-rating-text="4" class="br-selected"></a><a href="#" data-rating-value="5" data-rating-text="5" class="br-selected"></a><div class="br-current-rating">5</div></div></div>';
                      break;
                      default:
                      $star = '';
                    }
                      return $star;
                  })
                  ->rawColumns(['company','review_date','publish_date','name','action','status_name','stars'])
                  ->make(true);
      }
      return view('admin.review.index')->with(['title' => 'Review', "header" => "Rating List"]);
    }

    public function reviewchecklistpage(Request $request){
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
                  ->editColumn('status', function($row){
                      if($row->is_review_status == 1){
                          return 'Review Given';
                      }
                      else{
                          return 'Review Not Given';
                      }
                  })
                  ->addColumn('action', function($row){
                    $view_url    =  route('review_insert',[$row->ref_id]);
                    if($row->is_review_status == 1){
                      $btn = '<button type="button" class="edit-booking btn btn-success btn-sm mr-2" title="Review Done"><i class="fa fa-check" aria-hidden="true"></i></button>';
                    } else {
                      $btn = '<a href="'.$view_url.'" class="edit-booking btn btn-danger btn-sm mr-2" title="Insert Review" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'"><i class="fa fa-plus" data-id="'.$row->id.'" data-ref-id="'.$row->ref_id.'" aria-hidden="true"></i></a>';
                    }
                      return $btn;
                  })
                  ->rawColumns([
                      'action',
                      'customer',
                      'status'
                  ])
                  ->make(true);
      }
      $airports   = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
      $companies  = Company::where('company_status','!=',config('constant.STATUS.DELETED'))->get();
      return view('admin.review.checklist')->with([
          'title' => 'Website Booking List',
          "header" => "Review Checklist",
          "airports" => $airports,
          "companies" => $companies
      ]);
    }

    public function reviewinsertpage($ref_id,Request $request){
      $data = Bookings::where('ref_id',$ref_id)->first();
      return view('admin.review.insert')->with([
          'title' => 'Insert Reviews',
          "header" => "Rating Insert",
          'data' => $data
      ]);
    }

    public function postreview($ref_id,Request $request){
      print_r($request->all());
      // $data = Bookings::where('ref_id',$ref_id)->first();
      // return view('admin.review.insert')->with([
      //     'title' => 'Inse1rt Reviews',
      //     "header" => "Rating Insert",
      //     'data' => $data
      // ]);
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
        $validator = Validator::make($request->all(), [
            'review_date'    => 'required',
            'publish_date'       => 'required',
            'review_title'    => 'required',
        ]);

        if($validator->fails()){
           return redirect()->back()->withErrors($validator);
        }

        $save_review = new Review();
        $save_review->booking_id = $request->booking_id;
        $save_review->review_date = $request->review_date;
        $save_review->publish_date = $request->publish_date;
        $save_review->is_recommend = ($request->recommend == 'yes') ? 1 : 0;
        $save_review->comments = $request->comments;
        $save_review->convenience = $request->convenience;
        $save_review->punctuality = $request->punctuality;
        $save_review->customer_service = $request->customer_service;
        $save_review->collection_vehicle = $request->collection_vehicle;
        $save_review->overall = $request->overall;

        if($save_review->save()){
            $update_status = Bookings::where('id',$save_review->booking_id)->update(['is_review_status' => '1']);
        }
        return redirect()->route('review_checklist')->with(['success' => 'Review added successfully']);
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
