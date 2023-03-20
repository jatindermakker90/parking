<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDetails extends Model
{
    use HasFactory;

    public static function addVehical($data){

        $vehicle_details = new VehicleDetails();
        if($data->has('booking_id') && $data->booking_id){
            $vehicle_details->booking_id  = $data->booking_id; 
        }
        if($data->has('vehicle_make') && $data->vehicle_make){
            $vehicle_details->vehicle_make  = $data->vehicle_make;
        }
        if($data->has('vehicle_model') && $data->vehicle_model){
            $vehicle_details->vehicle_model  = $data->vehicle_model;
        }
        if($data->has('vehicle_colour') && $data->vehicle_colour){
            $vehicle_details->vehicle_colour  = $data->vehicle_colour;
        }
        if($data->has('vehicle_reg') && $data->vehicle_reg){
            $vehicle_details->vehicle_reg  = $data->vehicle_reg;
        }
            
        $vehicle_details->save();
        return $vehicle_details;
    }

    public static function updateVehicle($data){

        $vehicle_details = VehicleDetails::find($data->vehicle_id) ?? new VehicleDetails();
        if($data->has('vehicle_make') && $data->vehicle_make){
            $vehicle_details->vehicle_make  = $data->vehicle_make;
        }
        if($data->has('vehicle_model') && $data->vehicle_model){
            $vehicle_details->vehicle_model  = $data->vehicle_model;
        }
        if($data->has('vehicle_colour') && $data->vehicle_colour){
            $vehicle_details->vehicle_colour  = $data->vehicle_colour;
        }
        if($data->has('vehicle_reg') && $data->vehicle_reg){
            $vehicle_details->vehicle_reg  = $data->vehicle_reg;
        }
            
        $vehicle_details->save();
        return $vehicle_details;
    }
}
