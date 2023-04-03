<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesOperation extends Model
{
    use HasFactory;

    public function saveAndUpdateOperation($id, $data)
    {
        
        if(!empty($id)){
            $model = CompaniesOperation::where('id',$id)->first();
        }
        else{
            $model = new CompaniesOperation();
        }
        
        if($data->company_id){
            $model->company_id = $data->company_id;
        }
        if($data->operation_type){
            $model->operation_type = $data->operation_type;
        }
        if($data->weekdays){
            $model->weekdays = $data->weekdays;
        }
        
        $model->save();
        return $model;
       
    }
}
