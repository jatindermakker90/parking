<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalExpress extends Model
{
    use HasFactory;

    protected $table = "paypal_express";

    protected $fillable = ['user_id','live_email','test_email','live_url','test_url','live_private_key','live_public_key','test_private_key','test_public_key','gateway_activation_status','testmode_status'];
}
