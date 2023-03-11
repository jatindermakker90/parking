<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDiscount extends Model
{
    use HasFactory;

    public static function addDiscount($data){

        $add_discount = new AddDiscount();
        if($data->has('start_date') && $data->start_date){
            $add_discount->start_date = $data->start_date;
        }
        if($data->has('end_date') && $data->end_date){
            $add_discount->end_date = $data->end_date;
        }
        if($data->has('name') && $data->name){
            $add_discount->name = $data->name;
        }
        if($data->has('offer_type') && $data->offer_type){
            $add_discount->offer_type_id = $data->offer_type;
        }
        $add_discount->save();
        
        return $add_discount;
    }
}
