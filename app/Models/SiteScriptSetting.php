<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteScriptSetting extends Model
{
    use HasFactory;
    protected $table = "site_script_settings";

    protected $fillable = ['user_id','header_script','footer_script','body_script','booking_script'];
}
