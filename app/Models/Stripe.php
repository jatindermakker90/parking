<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    use HasFactory;

    protected $table = "stripes";

    protected $fillable = ['user_id','live_private_key','live_public_key','test_private_key','test_public_key','gateway_activation_status','stripe_testmode_status'];
}
