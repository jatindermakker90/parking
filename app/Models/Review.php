<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";


    public static function getOverAllRatingByBookingID($id){
      $overall_rating = '';
      $rating = Review::where('booking_id',$id)->first();
      $rating_total = $rating->convenience + $rating->punctuality + $rating->customer_service + $rating->collection_vehicle + $rating->overall;
      $overall_rating = ($rating_total)/5;
      return round($overall_rating);
    }

    public function booking(){
      return $this->hasOne('App\Models\Bookings','id','booking_id');
    }
}
