<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBrandPrice extends Model
{
    use HasFactory;
    protected $table = 'brand_price_detail';

    public function saveBrandPrice($data)
    {
        $model = new CompanyBrandPrice();
        if($data->has('id') && $data->id){
            $model->company_id = $data->id;
        }
        if($data->has('month') && $data->month){
            $model->month = $data->month;
        }
        if($data->has('year') && $data->year){
            $model->year = $data->year;
        }
        
        $model->save();

        return $model;
    }


    public function updateCompanyBrands($data)
    {
        $model = CompanyBrandPrice::where('id',$data->id)->first() ?? new CompanyBrandPrice();
        if($data->has('days_price') && $data->days_price){
            $model->brand_id = json_encode($data->days_price);
        }
        $model->save();

        return $model;
    }
}
