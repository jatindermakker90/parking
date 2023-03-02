<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\User;

class Bookings extends Model
{
    use HasFactory;


    protected $appends = ['product_name'];

    public function getProductNameAttribute(){
        $product = Products::where('id',$this->attributes['products_id'])->first();
        return $product ? $product->name : 'NA';
    }


}
