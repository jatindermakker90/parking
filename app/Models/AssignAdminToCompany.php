<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignAdminToCompany extends Model
{
    use HasFactory;


    public static function insert($request)
    {
        $model = new AssignAdminToCompany();
        $model->user_id = $request->user_id;
        $model->company_id = $request->company_id;
        $model->save();
        return $model; 
    }
}
