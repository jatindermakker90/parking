<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDiscount extends Model
{
    use HasFactory;

    public static function addAssignDiscount($data){

        $assign_discount = new AssignDiscount();
        if($data->has('airport') && $data->airport){
            $assign_discount->airport_id = $data->airport;
        }
        if($data->has('company') && $data->company){
            $assign_discount->company_id = $data->company;
        }
        if($data->has('offer_type') && $data->offer_type){
            $assign_discount->offer_type_id = $data->offer_type;
        }
        $assign_discount->save();
        
        return $assign_discount;
    }
}
