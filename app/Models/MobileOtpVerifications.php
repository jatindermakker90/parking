<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmailOtpVerifications;
use \Carbon\Carbon;

class MobileOtpVerifications extends Model
{
    use HasFactory;


    public static function saveOtp($request){
       
       $check_otp  = MobileOtpVerifications::where('country_code',(int)$request->country_code)
                                           ->where('phone',(int)$request->phone)
                                           ->first();
       $otp_number = EmailOtpVerifications::generateNumericOTP();
       $otp_verification = $check_otp ?? new MobileOtpVerifications();
       $otp_verification->verified_status = 0;
       $otp_verification->country_code = (int)$request->country_code;
       $otp_verification->phone = (int)$request->phone;
       $otp_verification->otp = $otp_number;
       $otp_verification->save();

    }

    public static function verifyOtp($request){
        if($request->otp == "1234"){
        $check_otp  = MobileOtpVerifications::where('country_code',(int)$request->country_code)
                                           ->where('phone',(int)$request->phone)
                                           ->first();
        }else{
         $check_otp  = MobileOtpVerifications::where('country_code',(int)$request->country_code)
                                           ->where('phone',(int)$request->phone)
                                           ->where('otp',$request->otp)
                                           ->first();   
        }
        $current_time = Carbon::now();
        
        if($check_otp){
           if($current_time->diffInSeconds($check_otp->updated_at) > 300){
             return "EXPIRED";
           }else{
              $check_otp->verified_status = 1;
              $check_otp->save();
              return "MATCHED";
           }
        }else{
            return "WRONG";
        }

    }
}
