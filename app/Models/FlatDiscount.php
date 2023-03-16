<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatDiscount extends Model
{
    use HasFactory;

    public static function addDiscount($data){

        $flat_discount = new FlatDiscount();
        if($data->has('offer_type') && $data->offer_type){
            $flat_discount->offer_type_id = $data->offer_type;
        }
        if($data->has('flat_code') && $data->flat_code){
            $flat_discount->flat_code_id = $data->flat_code;
        }
        if($data->has('type') && $data->type){
            $flat_discount->type = $data->type;
        }
        if($data->has('amount') && $data->amount){
            $flat_discount->amount = $data->amount;
        }
        $flat_discount->save();
        
        return $flat_discount;
    }
}
