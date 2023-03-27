<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseCompany extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }


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

    public static function closeCompanyUpdate($data)
    {
        $closeCompany = CloseCompany::where('id',$data->id)->first() ?? new CloseCompany();
        if($data->has('company_id') && $data->company_id){
            $closeCompany->company_id = $data->company_id;
        }
        if($data->has('date') && $data->date){
            $closeCompany->date = $data->date;
        }
        if($data->has('modal_journey_type') && $data->modal_journey_type){
            $closeCompany->journey_type = $data->modal_journey_type;
        }
        if($data->has('modal_status') && $data->modal_status){
            $closeCompany->status = config('constant.CLOSE_COMPANY_STATUS.'.$data->modal_status);
        }
        $closeCompany->save();
        return $closeCompany;
    }
}
