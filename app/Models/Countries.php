<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

     protected $append = ['status_name'];

    protected $fillable = [
        'country', 'country_iso_code','currency_iso_code','language_iso_code','currency','language','country_code','status'
    ];


    public function getStatusNameAttribute(){
        return config('constant.STATUS_DETAILS')[$this->status];
    }

    public static function saveCountries($request){

       $find_country =   Countries::firstOrNew($request->only(['country_code']));
       $find_country->country           = $request->country;
       $find_country->currency          = $request->currency;
       $find_country->language          = $request->language;
       $find_country->country_code      = $request->country_code;
       $find_country->country_iso_code  = $request->country_iso_code;
       $find_country->currency_iso_code = $request->currency_iso_code;
       $find_country->language_iso_code = $request->language_iso_code;
       $find_country->status            = config('constant.STATUS.ACTIVE');
       $find_country->save();

       return $find_country;
    }

    public static function updateCountries($request){
      
       $find_country =   Countries::firstOrNew(['id' =>$request->country_id]);
       $find_country->country           = $request->country;
       $find_country->currency          = $request->currency;
       $find_country->language          = $request->language;
       $find_country->country_code      = $request->country_code;
       $find_country->country_iso_code  = $request->country_iso_code;
       $find_country->currency_iso_code = $request->currency_iso_code;
       $find_country->language_iso_code = $request->language_iso_code;
       $find_country->save();
       return $find_country;
    }

     public static function deleteCountry($country_id){
      
       $find_country =   Countries::where(['id' =>$country_id])->first();
       $find_country->status           = config('constant.STATUS.DELETED');
       $find_country->save();

       return $find_country;
    }

}
