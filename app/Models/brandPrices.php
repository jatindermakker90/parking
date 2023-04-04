<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brandPrices extends Model
{
    use HasFactory;
    protected $table = 'brands_price';
    protected $fillable = [
        'id',
        'brand',
        'status',
        'days_price',    
    ];
}
