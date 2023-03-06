<?php

namespace App\Http\Controllers\Admin;

use PragmaRX\Countries\Package\Countries as CountriesList;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use App\Models\Countries;
use DataTables;
use Validator;

class CountriesController extends WebController
{
    /**
     * Display a listing of the country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $data            = Countries::where('status','!=',config('constant.STATUS.DELETED'));
        $countries_query = new CountriesList();
        $countries       = $countries_query->all();
        if ($request->ajax()) {
            return Datatables::of($data)
                   // ->addIndexColumn()
                    ->addColumn('status_name',function($row){
                        $modify_url = route('change_countries_status',[$row->id]);
                        if($row->status)
                        $btn = '<input type="checkbox" name="change_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        else
                        $btn = '<input type="checkbox" name="change_status" data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="ACTIVE" data-off-text="INACTIVE" data-href ="'.$modify_url.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                           $view_url    =  route('countries.show',[$row->id]);
                           $edit_url    =  route('countries.edit',[$row->id]);
                           $delete_url  =  route('countries.destroy',[$row->id]);
                           $btn  = '<a href="'.$view_url.'" class="view btn btn-success btn-sm mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                           $btn = '<a href="'.$edit_url.'" class="edit btn btn-warning btn-sm mr-2"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                           $btn .= '<a href="'.$delete_url.'" class="delete btn btn-danger btn-sm mr-2 delete_record" data-type ="'.$row->country.' Country""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                           return $btn;
                    })
                    ->rawColumns(['action','status_name'])
                    ->make(true);
        }
        return view('admin.countries.index')->with(['title' => 'Countries', "header" => "Countries Listing"]);
       
    }

    /**
     * Show the form for creating a new country resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries_query = new CountriesList();
        $countries       = $countries_query->all();
        return view('admin.countries.create')->with(['title' =>'Countries', "header" => "Add Countries",'countries' => $countries]);
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
            'country'                => 'required',
            'country_iso_code'       => 'required',
            'country_code'           => 'required',
            'currency'               => 'required',
            'language_iso_code'      => 'required',
            'language'               => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }
        $save_countries = Countries::saveCountries($request);

        return redirect()->route('countries.index')->with(['success' => 'Country added successfully']);
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
    public function edit($country_id,Request $request)
    {
        $countries_query = new CountriesList();
        $countries       = $countries_query->all();
        $country         = Countries::where('id',$country_id)->first();
        $header          = 'Edit '.$country->country. " Country";
        return view('admin.countries.edit')->with(['title' =>'Countries', "header" => $header,'country' => $country,'countries' => $countries]);
    }

    /**
     * Update the specified country resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $country_id)
    {
        $validator = Validator::make($request->all(), [
            'country_id'             => 'required|exists:countries,id',
            'country'                => 'required',
            'country_iso_code'       => 'required|unique:countries,country_iso_code,'.$country_id,
            'country_code'           => 'required|unique:countries,country_code,'.$country_id,
            'currency'               => 'required|unique:countries,currency,'.$country_id,
          //  'language_iso_code'      => 'required|unique:countries_info,language_iso_code,'.$country_id,
            //'language'               => 'required',
        ]);
   
        if($validator->fails()){
           return redirect()->back()->withErrors($validator);      
        }

        $save_countries = Countries::updateCountries($request);

        return redirect()->route('countries.index')->with(['success' => 'Country updated successfully']);
    }

    /**
     * Remove the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($country_id,Request $request)
    {
        Countries::where('id',$country_id)->delete();
       //$save_countries = Countries::deleteCountry($country_id);
        $message         = "Country deleted fetched successfully";
        return $this->sendSuccess([],$message,200);
    }

    /**
     * update the specified country resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeCountriesStatus($country_id,Request $request)
    {

        $request->merge(['country_id' => $country_id]);

        $validator = Validator::make($request->all(), [
            'country_id'       => 'required|exists:countries,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->getMessageBag()->first());       
        }

        $status = $request->has('status') ? $request->status : null;

        $countries = Countries::where('id',$country_id)->first();
        if($request->has('status') && ($status == 'true')){
         $countries->status = config('constant.STATUS.ACTIVE');
         $countries->save();
        }
        if($status == 'false'){
         $countries->status = config('constant.STATUS.INACTIVE');
         $countries->save();
        }

        $message         = "Country status updated successfully";
        return $this->sendSuccess([],$message,200);   
    }

    /**
     * get the specified country details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCountriesDetails(Request $request){

        $name                          = $request->has('name') ? $request->name : null;
        $countries_query               = new CountriesList();
        $countries                     = $countries_query->where('name.common', $name)->first();
        if($countries->isEmpty()){
        $find_countries                = Countries::where('country_code',$name)->first();
        $countries                     = CountriesList::where('name.common', $find_countries->country)->first();
        }
        $response['country_iso_code']  = $countries->cca3;
        $response['states']      = $countries->hydrateStates()->states->pluck('name', 'postal')->toArray();
        $response['country_code']      = $countries->calling_codes->first();
        $response['currency']          = $countries->currencies->first();
        $response['languages']         = $countries->languages->first();
        $response['language_iso_code'] = $countries->languages->first() ? ucwords($countries->languages->keys()->first()) : '';

        $message         = "Country details fetched successfully";
        return $this->sendSuccess($response,$message,200);  
    }

    
}
