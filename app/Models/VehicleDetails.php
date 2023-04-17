<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VehicleDetails extends Model
{
    use HasFactory;

    public static function addVehical($data){

        if($data->has('vehicle') && $data->vehicle){
            $insert_data = [];
            foreach ($data->vehicle as $key => $value) {
                $vehicle_details = new VehicleDetails();
                if($data->has('booking_id') && $data->booking_id){
                    $vehicle_details->booking_id  = $data->booking_id; 
                }
                if(!empty($value['vehicle_make'])){
                    $vehicle_details->vehicle_make  = $value['vehicle_make'];
                }
                if(!empty($value['vehicle_model'])){
                    $vehicle_details->vehicle_model  = $value['vehicle_model'];
                }
                if(!empty($value['vehicle_colour'])){
                    $vehicle_details->vehicle_colour  = $value['vehicle_colour'];
                }
                if(!empty($value['vehicle_reg'])){
                    $vehicle_details->vehicle_reg  = $value['vehicle_reg'];
                }
                if(!empty($value['no_of_peopele'])){
                    $vehicle_details->no_of_people  = $value['no_of_peopele'];
                }
                $insert_data[] = $vehicle_details->attributesToArray();
            }
            $result = VehicleDetails::insert($insert_data);
            
            return $result;
        }
    }

    public static function updateVehicle($data){
        $deleteAllVehicle = VehicleDetails::where('booking_id', $data->booking_id)->delete();
        // dd($deleteAllVehicle);
        
        if($data->has('vehicle') && $data->vehicle){
            $insert_data = [];
            foreach ($data->vehicle as $key => $value) {
                $vehicle_details = new VehicleDetails();
                if($data->has('booking_id') && $data->booking_id){
                    $vehicle_details->booking_id  = $data->booking_id; 
                }
                if(!empty($value['vehicle_make'])){
                    $vehicle_details->vehicle_make  = $value['vehicle_make'];
                }
                if(!empty($value['vehicle_model'])){
                    $vehicle_details->vehicle_model  = $value['vehicle_model'];
                }
                if(!empty($value['vehicle_colour'])){
                    $vehicle_details->vehicle_colour  = $value['vehicle_colour'];
                }
                if(!empty($value['vehicle_reg'])){
                    $vehicle_details->vehicle_reg  = $value['vehicle_reg'];
                }
                if(!empty($value['no_of_peopele'])){
                    $vehicle_details->no_of_people  = $value['no_of_peopele'];
                }
                $insert_data[] = $vehicle_details->attributesToArray();
            }
            $result = VehicleDetails::insert($insert_data);   
            return $result;
        }
        
        
        
        // if($data->has('vehicle') && $data->vehicle){
        //     $result = [];
        //     foreach ($data->vehicle as $key => $value) {
        //         // $vehicle_details = VehicleDetails::find($value['vehicle_id']) ?? new VehicleDetails();
        //         if(!empty($value['vehicle_make'])){
        //             $vehicle_details->vehicle_make  = $value['vehicle_make'];
        //         }
        //         if(!empty($value['vehicle_model'])){
        //             $vehicle_details->vehicle_model  = $value['vehicle_model'];
        //         }
        //         if(!empty($value['vehicle_colour'])){
        //             $vehicle_details->vehicle_colour  = $value['vehicle_colour'];
        //         }
        //         if(!empty($value['vehicle_reg'])){
        //             $vehicle_details->vehicle_reg  = $value['vehicle_reg'];
        //         }
        //         if(!empty($value['no_of_peopele'])){
        //             $vehicle_details->no_of_people  = $value['no_of_peopele'];
        //         }
        //         $vehicle_details->save();
        //         $result[] =  $vehicle_details;
        //     }
            
        //     return $result;
        // }



        // $vehicle_details = VehicleDetails::find($data->vehicle_id) ?? new VehicleDetails();
        // if($data->has('vehicle_make') && $data->vehicle_make){
        //     $vehicle_details->vehicle_make  = $data->vehicle_make;
        // }
        // if($data->has('vehicle_model') && $data->vehicle_model){
        //     $vehicle_details->vehicle_model  = $data->vehicle_model;
        // }
        // if($data->has('vehicle_colour') && $data->vehicle_colour){
        //     $vehicle_details->vehicle_colour  = $data->vehicle_colour;
        // }
        // if($data->has('vehicle_reg') && $data->vehicle_reg){
        //     $vehicle_details->vehicle_reg  = $data->vehicle_reg;
        // }
            
        // $vehicle_details->save();
        // return $vehicle_details;
    }
}
