<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;

    protected $table = "email_settings";

    protected $fillable = ['user_id','smtp2go_api_key','smtp2go_api_key','smtp2go_base_url','smtp_host', 'smtp_username',
    'smtp_password', 'smtp_port',
    'smtp_debug_status', 'smtp_ssl_status',
    'review_smtp_host', 'review_smtp_username',
    'review_smtp_passowrd', 'review_smtp_port',
    'review_smtp_debug_status', 'review_smtp_ssl_status',
    'from_email_confirmation', 'from_email_amend',
    'from_email_cancel', 'email_cc',
    'email_bcc', 'contact_email',
    'noreply_confirmation', 'noreply_amend',
    'noreply_cancel', 'default_smtp_gateway'];
}
