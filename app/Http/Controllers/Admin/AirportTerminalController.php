<?php

namespace App\Http\Controllers\Admin;

use PragmaRX\Countries\Package\Countries as CountriesList;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\Airport;
use App\Models\AirportTerminal;
use DataTables;
use Validator;

class AirportTerminalController extends WebController
{
    /**
     * Display a listing of the country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $data            = AirportTerminal::join('airports', 'airports.id', '=', 'airport_terminals.airport_id')
                                          ->select('airport_terminals.*','airport_name')
                                          ->where('terminal_status','!=',config('constant.STATUS.DELETED'));
        if ($request->ajax()) {
            return Datatables::of($data)
                   // ->addIndexColumn()
                    ->addColumn('status_name',function($row){
                        $modify_url = route('change_airport_terminal_status',[$row->id]);
                        if($row->terminal_status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('terminals.show',[$row->id]);
                           $edit_url    =  route('terminals.edit',[$row->id]);
                           $delete_url  =  route('terminals.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->terminal_name.' Airport Terminal"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','status_name'])
                    ->make(true);
        }
        return view('admin.terminals.index')->with(['title' => 'Airport Terminal', "header" => "Airport Terminal Listing"]);
       
    }

    /**
     * Show the form for creating a new country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $airports = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        return view('admin.terminals.create')->with(['title' =>'Airport Terminal', "header" => "Add Airport Terminal",'airports' => $airports]);
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
            'terminal_name'    => 'required',
            'airport_id'       => 'required',
        ]);
   

        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $user         = Auth::user();
        $save_airport = new AirportTerminal();
        $save_airport->terminal_name = $request->terminal_name;
        $save_airport->airport_id = $request->airport_id;
        $save_airport->added_by = $user->id;
        $save_airport->terminal_status = config('constant.STATUS.ACTIVE');
        $save_airport->save();

        return redirect()->route('terminals.index')->with(['success' => 'Terminal added successfully']);
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
    public function edit($terminal_id,Request $request)
    {
       
        $airports        = Airport::where('airport_status',config('constant.STATUS.ACTIVE'))->get();
        $terminal        = AirportTerminal::where('id',$terminal_id)->first();
        $header          = 'Edit '.ucwords($terminal->terminal_name). " Airport Terminal";
        return view('admin.terminals.edit')->with(['title' =>'Airport Terminal', "header" => $header,'airports' => $airports,'terminal' => $terminal]);
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $terminal_id)
    {
        
        $validator = Validator::make($request->all(), [
            'terminal_name'    => 'required',
            'airport_id'       => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $user         = Auth::user();
        $save_airport = AirportTerminal::where('id',$terminal_id)->first();
        $save_airport->terminal_name = $request->terminal_name;
        $save_airport->airport_id = $request->airport_id;
        $save_airport->added_by = $user->id;
        $save_airport->terminal_status = config('constant.STATUS.ACTIVE');
        $save_airport->save();

        return redirect()->route('terminals.index')->with(['success' => 'Airport Terminal updated successfully']);
    }

    /**
     * Remove the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($terminal_id,Request $request)
    {
        AirportTerminal::where('id',$terminal_id)->delete();
       //$save_countries = Countries::deleteCountry($country_id);
        $message         = "Airport Terminal deleted successfully";
        return $this->sendSuccess([],$message,200);
    }

    /**
     * update the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeAirportTerminalStatus($terminal_id,Request $request)
    {

        $request->merge(['terminal_id' => $terminal_id]);

        $validator = Validator::make($request->all(), [
            'terminal_id'       => 'required|exists:airport_terminals,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $airport = AirportTerminal::where('id',$terminal_id)->first();
        if($request->has('status') && ($status == 'true')){
         $airport->terminal_status = config('constant.STATUS.ACTIVE');
         $airport->save();
        }
        if($status == 'false'){
         $airport->terminal_status = config('constant.STATUS.INACTIVE');
         $airport->save();
        }

        $message         = "Terminal status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }

    
}
