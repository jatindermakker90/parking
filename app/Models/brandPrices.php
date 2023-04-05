<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brandPrices extends Model
{
    use HasFactory;
    protected $table = 'brands_price';
    protected $fillable = [
        'id',
        'brand',
        'status',
        'days_price',    
    ];

    public static function updateBrandPrice($data){

        $brand_prices = brandPrices::where('id',$data->id)->first() ?? new brandPrices();
        
        if($data->has('days_price') && $data->days_price){
            $brand_prices->days_price = $data->days_price;
        }
        if($data->has('status') && $data->status){
            $brand_prices->status = $data->status;
        }
        else{
            $brand_prices->status = 0;
        }
        if($data->has('after_30_days') && $data->after_30_days){
            $brand_prices->after_30_days = $data->after_30_days;
        }
        
        $brand_prices->save();
        
        return $brand_prices;
    }
}
