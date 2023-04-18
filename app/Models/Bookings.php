<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\User;
use App\Models\Company;
use App\Models\Airport;
use App\Models\Review;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    public function airport()
    {
        return $this->belongsTo(Airport::class, 'airport_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function vehicle()
    {
        return $this->hasMany(VehicleDetails::class, 'booking_id', 'id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'id');
    }


    public static function addBooking($data){

        $booking = new Bookings();
        if($data->has('ref_id') && $data->ref_id){
            $booking->ref_id = $data->ref_id;
        }
        if($data->has('select_airport') && $data->select_airport){
            $booking->airport_id = $data->select_airport;
        }
        if($data->has('company_id') && $data->company_id){
            $booking->company_id = $data->company_id;
        }
        if($data->has('dep_date') && $data->dep_date && $data->has('dep_time') && $data->dep_time){
            $booking->dep_date_time = $data->dep_date.' '.$data->dep_time;
            $booking->updated_dep_date_time = $data->dep_date.' '.$data->dep_time;
        }
        if($data->has('return_date') && $data->return_date && $data->has('return_time') && $data->return_time){
            $booking->return_date_time = $data->return_date.' '.$data->return_time;
            $booking->updated_return_date_time = $data->return_date.' '.$data->return_time;
        }
        if($data->has('discount_code') && $data->discount_code){
            $booking->discount_code = $data->discount_code;
        }
        else{
            $booking->discount_code = null;
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
            $booking->cancellation_cover = 1;
        }
        if($data->has('sms_confirmation') && $data->sms_confirmation){
            $booking->sms_confirmation = 1;
        }
        if($data->has('price') && $data->price){
            $booking->price = $data->price;
        }
        // add admin chrges for future data analays
        $booking->admin_charge = config('constant.BOOKING.BOOKING_CHARGE');

        // if($data->has('no_of_peopele') && $data->no_of_peopele){
            $booking->no_of_people = 0;
        // }
        if($data->has('drop_off_terminal') && $data->drop_off_terminal){
            $booking->drop_off_terminal = $data->drop_off_terminal;
        }
        if($data->has('return_terminal') && $data->return_terminal){
             $booking->return_terminal = $data->return_terminal;
        }
        if($data->has('flight_number') && $data->flight_number){
             $booking->flight_number = $data->flight_number;
        }
        if($data->has('total_days') && $data->total_days){
            $booking->total_days = $data->total_days;
        }
        $booking->payment_status = 2;
        $booking->booking_status  = 1;
        $booking->save();
        return $booking;
    }

    public static function updateBooking($data){

        $booking = Bookings::find($data->booking_id) ?? new Bookings();

        if($data->has('company') && $data->company){
            $booking->company_id = $data->company;
        }
        if($data->has('updated_dep_date_time') && $data->updated_dep_date_time){
            $booking->dep_date_time = $data->updated_dep_date_time;
            $booking->updated_dep_date_time = $data->updated_dep_date_time;
        }
        if($data->has('updated_return_date_time') && $data->updated_return_date_time ){
            $booking->return_date_time = $data->updated_return_date_time;
            $booking->updated_return_date_time = $data->updated_return_date_time;
        }
        if($data->has('discount_code') && $data->discount_code){
            $booking->discount_code = $data->discount_code;
        }
        else{
            $booking->discount_code = null;
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
        if($data->has('city_town') && $data->city_town){
            $booking->city_town = $data->city_town;
        }
        if($data->has('address') && $data->address){
            $booking->address = $data->address;
        }
        if($data->has('country') && $data->country){
            $booking->country = $data->country;
        }
        if($data->has('postcode') && $data->postcode){
            $booking->postcode = $data->postcode;
        }
        if($data->has('price') && $data->price){
            $booking->price = $data->price;
        }
        if($data->has('drop_off_terminal') && $data->drop_off_terminal){
            $booking->drop_off_terminal = $data->drop_off_terminal;
        }
        if($data->has('return_terminal') && $data->return_terminal){
            $booking->return_terminal = $data->return_terminal;
        }
        if($data->has('flight_number') && $data->flight_number){
            $booking->flight_number = $data->flight_number;
        }
        if($data->has('admin_charge') && $data->admin_charge){
            $booking->admin_charge = $data->admin_charge;
        }
        if($data->has('total_days') && $data->total_days){
            $booking->total_days = $data->total_days;
        }
        if($data->has('extended_price')){
            $booking->extanded_price = $data->extended_price;
        }
        if($data->has('special_notes') && $data->special_notes){
            $booking->special_notes = $data->special_notes;
        }
        $booking->save();
        return $booking;
    }

    public function review()
    {
        return $this->belongsTo(Review::class, 'id', 'booking_id');
    }
}
