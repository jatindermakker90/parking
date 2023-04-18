<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";


    public function savePayment($data)
    {
        $model = new Payment();

        if($data->has('booking_id') && $data->booking_id){
            $model->booking_id = $data->booking_id;
        }
        if($data->has('ref_id') && $data->ref_id){
            $model->booking_ref_id = $data->ref_id;
        }
        if($data->has('base_price') && $data->base_price){
            $model->base_price = $data->base_price;
        }
        if($data->has('cancellation_cover') && $data->cancellation_cover){
            $model->cancellation_charge = config('constant.BOOKING.CANCELLATION_CHARGE');
        }
        if($data->has('sms_confirmation') && $data->sms_confirmation){
            $model->sms_charge = config('constant.BOOKING.SMS_CONFIRMATION');
        }
        if($data->has('price') && $data->price){
            $model->total_price = $data->price;
        }
        if($data->has('discount_amount') && $data->discount_amount){
            $model->discount_amount = $data->discount_amount;
        }
        if($data->has('discount_type') && $data->discount_type){
            $model->discount_type = $data->discount_type;
        }
        $model->payment_date = now()->format('Y-m-d H:i:s');
        $model->booking_charge = config('constant.BOOKING.BOOKING_CHARGE');
        $model->status = 2;
        $model->save();
        return $model;
    }

    public function updatePayment($data)
    {
        
        $model = Payment::find($data->payment_id) ?? new Payment();

        if($data->has('base_price') && $data->base_price){
            $model->base_price = $data->base_price;
        }
        if($data->has('price') && $data->price){
            $model->total_price = $data->price;
        }
        if($data->has('payment_method_get')){
            $model->payment_method = $data->payment_method_get;
        }
        if($data->has('transaction_id_get') && $data->transaction_id_get){
            $model->transaction_id = $data->transaction_id_get;
        }
        $model->status = 2;
        $model->save();
        return $model;
    }
}
