<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountOfferType extends Model
{
    use HasFactory;

    public static function addOfferType($data){

        $discountOfferType = new DiscountOfferType();
        if($data->has('name') && $data->name){
            $discountOfferType->name = $data->name;
        }
        $discountOfferType->status  = 1;
        $discountOfferType->save();
        
        return $discountOfferType;
    }
}
