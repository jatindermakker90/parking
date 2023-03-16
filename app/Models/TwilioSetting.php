<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwilioSetting extends Model
{
    use HasFactory;

    protected $table = "twilio_settings";

    protected $fillable = ['user_id','twilio_acc_id','twilio_auth_token','twilio_form_number','twilio_box'];
}
