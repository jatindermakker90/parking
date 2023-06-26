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
      $companies = Company::with(['operation', 'airport', 'terminal'])
                    ->where('company_status','!=',config('constant.STATUS.DELETED'))
                    ->whereNotNull('company_status')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();

      return view('frontend.index',compact('companies'));
   }


   public function about(){
       $companies = Company::with(['operation', 'airport', 'terminal'])
                    ->where('company_status','!=',config('constant.STATUS.DELETED'))
                    ->whereNotNull('company_status')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();
      return view('frontend.about',compact('companies'));
   }

   public function faq(){
      return view('frontend.faq');
   }

   public function terms(){
      return view('frontend.terms_conditions');
   }

   public function parking(){
        $companies = Company::with(['operation', 'airport', 'terminal'])
                    ->where('company_status','!=',config('constant.STATUS.DELETED'))
                    ->whereNotNull('company_status')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();
      return view('frontend.parking',compact('companies'));
   }

   public function contactUs(){
      return view('frontend.contact');
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
