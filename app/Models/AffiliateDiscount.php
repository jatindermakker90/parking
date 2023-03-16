<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateDiscount extends Model
{
    use HasFactory;

    public static function addAffiliate($data){

        $discountAffiliate = new AffiliateDiscount();
        if($data->has('name') && $data->name){
            $discountAffiliate->name = $data->name;
        }
        $discountAffiliate->status  = 1;
        $discountAffiliate->save();
        
        return $discountAffiliate;
    }
}
