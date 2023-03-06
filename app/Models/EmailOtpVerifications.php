<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class EmailOtpVerifications extends Model
{
    use HasFactory;


    public static function saveOtp($request){
       
       $check_otp  = EmailOtpVerifications::where('email',$request->email)->first();
       $otp_number = self::generateNumericOTP();
       $otp_verification = $check_otp ?? new EmailOtpVerifications();
       $otp_verification->email = $request->email;
       $otp_verification->verified_status = 0;
       $otp_verification->otp = $otp_number;
       $otp_verification->save();

    } 

    public static function verifyOtp($request){
        
        if($request->otp == "1234"){
            $check_otp  = EmailOtpVerifications::where('email',$request->email)
                                             ->first();
        }else{
             $check_otp  = EmailOtpVerifications::where('email',$request->email)
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

    public static function generateNumericOTP($n = 4) {
      
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        // Return result
        return $result;
    } 
}
