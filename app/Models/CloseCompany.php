<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseCompany extends Model
{
    use HasFactory;


    public static function closeCompanySave($data)
    {
        $closeCompany = new CloseCompany();
        if($data->has('company_id') && $data->company_id){
            $closeCompany->company_id = $data->company_id;
        }
        if($data->has('date') && $data->date){
            $closeCompany->date = $data->date;
        }
        if($data->has('journey_type') && $data->journey_type){
            $closeCompany->journey_type = $data->journey_type;
        }
        if($data->has('status') && $data->status){
            $closeCompany->status = config('constant.CLOSE_COMPANY_STATUS.'.$data->status);
        }
        $closeCompany->save();
        return $closeCompany;
     }
}
