<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\User;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'bookings';


     public static function addBooking($data){

        $booking = new Bookings();
        if($data->has('company_title') && $data->company_title){
            $booking->company_title = $data->company_title;
        }
        if($data->has('select_airport') && $data->select_airport){
            $booking->airport_id = $data->select_airport;
        }
        if($data->has('dep_date') && $data->dep_date && $data->has('dep_time') && $data->dep_time){
            $booking->dep_date_time = $data->dep_date.' '.$data->dep_time;
        }
        if($data->has('return_date') && $data->return_date && $data->has('return_time') && $data->return_time){
            $booking->return_date_time = $data->return_date.' '.$data->return_time;
        }
        if($data->has('discount_code') && $data->discount_code){
            $booking->discount_code = $data->discount_code;
        }
        if($data->has('title') && $data->title){
            $booking->title = $data->title;
        }
        if($data->has('first_name') && $data->first_name){
            $booking->first_name = $data->first_name;
        }
        if($data->has('last_name') && $data->last_name){
            $booking->last_name = $data->last_name;
        }
        if($data->has('email') && $data->email){
            $booking->email = $data->email;
        }
        if($data->has('mobile') && $data->mobile){
            $booking->mobile = $data->mobile;
        }
        if($data->has('cancellation_cover') && $data->cancellation_cover){
            $booking->cancellation_cover = $data->cancellation_cover;
        }
        if($data->has('sms_confirmation') && $data->sms_confirmation){
            $booking->sms_confirmation = $data->sms_confirmation;
        }
        if($data->has('no_of_peopele') && $data->no_of_peopele){
            $booking->no_of_people = $data->no_of_peopele;
        }
        if($data->has('drop_off_terminal') && $data->drop_off_terminal){
            $booking->drop_off_terminal = $data->drop_off_terminal;
        }
        if($data->has('return_terminal') && $data->return_terminal){
             $booking->return_terminal = $data->return_terminal;
        }
        $booking->booking_status  = 1;
        $booking->save();
        return $booking;
        
        
        
        
        
        
       
    }
}
