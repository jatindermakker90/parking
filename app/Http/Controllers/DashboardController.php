<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\Company;
use Validator;

class DashboardController extends WebController
{

   public function index(){
      return view('frontend.index');
   }


   public function about(){
      return view('frontend.about');
   }

   public function faq(){
      return view('frontend.faq');
   }

   public function contactUs(){
      return view('frontend.contact_us');
   }

   public function getAirportDetails(Request $request,$airport_id){

    $airport   = Airport::where('id',$airport_id)->first();
    $airport_list   = Airport::where('id','!=',$airport_id)->get();
    $companies = Company::with(['operation', 'airport', 'terminal'])
                    ->where('company_status','!=',config('constant.STATUS.DELETED'))
                    ->whereNotNull('company_status')
                    ->where('airport_id',$airport_id)
                    ->get();
   
    return view('frontend.airport_details')->with(['airport' => $airport,'companies' => $companies,'airport_list' => $airport_list]);
    
   }
}
