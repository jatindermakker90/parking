<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    use HasFactory;

    protected $table = "paypal";

    protected $fillable = ['user_id','paypal_email','payal_url','test_url','gateway_activation_status','testmode_status'];
}
