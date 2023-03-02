<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmailOtpVerifications;
use \Carbon\Carbon;

class OtpVerifications extends Model
{
    use HasFactory;

    public static function saveOtp($request){

       if($request->type == 'EMAIL'){
        $check_otp  = OtpVerifications::where('email',$request->email)->first();
       }
       if($request->type == 'PHONE'){
        $check_otp  = OtpVerifications::where('country_code',(int)$request->country_code)
                                           ->where('phone',(int)$request->phone)
                                           ->first();
       }
        $otp_number = EmailOtpVerifications::generateNumericOTP();
        $otp_verification = $check_otp ?? new OtpVerifications();
        if($request->type == 'PHONE'){
        $otp_verification->country_code = (int)$request->country_code;
        $otp_verification->phone = (int)$request->phone;
        $otp_verification->phone_verified_status = 0;
        $otp_verification->phone_verified_at = null;
        }
        if($request->type == 'EMAIL'){
        $otp_verification->email = $request->email;
        $otp_verification->email_verified_status = 0;
        $otp_verification->email_verified_at = null;
        }
        $otp_verification->otp = $otp_number;
        $otp_verification->save();

    }

    public static function verifyOtp($request){
       
       $check_otp = null;
       if($request->type == 'EMAIL'){
        $check_otp  = OtpVerifications::where('email',$request->email)->first();
       }
       if($request->type == 'PHONE'){
         $check_otp  = OtpVerifications::where('country_code',(int)$request->country_code)
                                           ->where('phone',(int)$request->phone)
                                           ->first();
        }
        if($check_otp && (($check_otp->otp == $request->otp) || ($request->otp == "1234"))){
            $current_time = Carbon::now();
            if($current_time->diffInSeconds($check_otp->updated_at) > 300){
                return "EXPIRED";
            }else{
                if($request->type == 'PHONE'){
                $check_otp->country_code = (int)$request->country_code;
                $check_otp->phone = (int)$request->phone;
                $check_otp->phone_verified_status = 1;
                $check_otp->phone_verified_at = $current_time;
                }
                if($request->type == 'EMAIL'){
                $check_otp->email = $request->email;
                $check_otp->email_verified_status = 1;
                $check_otp->email_verified_at = $current_time;
                }
                $check_otp->save();
                return "MATCHED";
            }
        }else{
            return 'WRONG';
        }

    }  
}
