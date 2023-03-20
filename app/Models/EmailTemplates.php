<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    use HasFactory;

    protected $table = "email_templates";

    protected $fillable = ['user_id','client_email_template','client_cancel_email_template','company_confirm_email_template','company_cancel_email_template','review_email_template'];
}
