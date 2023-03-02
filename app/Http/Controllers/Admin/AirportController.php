<?php

namespace App\Http\Controllers\Admin;

use PragmaRX\Countries\Package\Countries as CountriesList;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\Airport;
use DataTables;
use Validator;

class AirportController extends WebController
{
    /**
     * Display a listing of the country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

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
                           $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->airport_name.' Airport"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','status_name'])
                    ->make(true);
        }
        return view('admin.airport.index')->with(['title' => 'Airport', "header" => "Airport Listing"]);
       
    }

    /**
     * Show the form for creating a new country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.airport.create')->with(['title' =>'Airport', "header" => "Add Airport"]);
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
            'airport_name'             => 'required',
            'operating_location'       => 'required',
        ]);
   

        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $user         = Auth::user();
        $save_airport = new Airport();
        $save_airport->airport_name = $request->airport_name;
        $save_airport->operating_location = $request->operating_location;
        $save_airport->added_by = $user->id;
        $save_airport->airport_status = config('constant.STATUS.ACTIVE');
        $save_airport->save();

        return redirect()->route('airport.index')->with(['success' => 'Airport added successfully']);
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
    public function edit($airport_id,Request $request)
    {
       
        $airport         = Airport::where('id',$airport_id)->first();
        $header          = 'Edit '.ucwords($airport->airport_name). " Airport";
        return view('admin.airport.edit')->with(['title' =>'Airport', "header" => $header,'airport' => $airport]);
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $airport_id)
    {
        
        $validator = Validator::make($request->all(), [
            'airport_id'               => 'required|exists:airports,id',
            'airport_name'             => 'required',
            'operating_location'       => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $user         = Auth::user();
        $save_airport = Airport::where('id',$airport_id)->first();
        $save_airport->airport_name = $request->airport_name;
        $save_airport->operating_location = $request->operating_location;
        $save_airport->airport_status = config('constant.STATUS.ACTIVE');
        $save_airport->save();

        return redirect()->route('airport.index')->with(['success' => 'Airport updated successfully']);
    }

    /**
     * Remove the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($airport_id,Request $request)
    {
        Airport::where('id',$airport_id)->delete();
       //$save_countries = Countries::deleteCountry($country_id);
        $message         = "Airport deleted successfully";
        return $this->sendSuccess([],$message,200);
    }

    /**
     * update the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeAirportStatus($airport_id,Request $request)
    {

        $request->merge(['airport_id' => $airport_id]);

        $validator = Validator::make($request->all(), [
            'airport_id'       => 'required|exists:airports,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $airport = Airport::where('id',$airport_id)->first();
        if($request->has('status') && ($status == 'true')){
         $airport->airport_status = config('constant.STATUS.ACTIVE');
         $airport->save();
        }
        if($status == 'false'){
         $airport->airport_status = config('constant.STATUS.INACTIVE');
         $airport->save();
        }

        $message         = "Airport status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }

    
}
