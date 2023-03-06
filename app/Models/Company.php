<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    public static function addCompany($data){

        $company = new Company();
        if($data->has('company_title') && $data->company_title){
            $company->company_title = $data->company_title;
        }
        if($data->has('company_email') && $data->company_email){
            $company->company_email = $data->company_email;
        }
        if($data->has('company_phone') && $data->company_phone){
            $company->company_phone = $data->company_phone;
        }
        if($data->has('company_url') && $data->company_url){
            $company->company_url = $data->company_url;
        }
        if($data->has('price_plan') && $data->price_plan){
            $company->price_plan = $data->price_plan;
        }
        if($data->has('sku_id') && $data->sku_id){
            $company->company_sku_id = $data->sku_id;
        }
        if($data->has('sku_tag') && $data->sku_tag){
            $company->company_sku_tag = $data->sku_tag;
        }
        if($data->has('sku_sending_tag') && $data->sku_sending_tag){
            $company->company_sku_sending_tag = $data->sku_sending_tag;
        }
        if($data->has('sequence') && $data->sequence){
            $company->company_sequence = $data->sequence;
        }
        if($data->has('mins_sms') && $data->mins_sms){
            $company->min_sms = $data->mins_sms;
        }
        if($data->has('daily_bookings') && $data->daily_bookings){
            $company->daily_bookings = $data->daily_bookings;
        }
        if($data->has('monthly_bookings') && $data->monthly_bookings){
            $company->monthly_bookings = $data->monthly_bookings;
        }
        if($data->has('comission') && $data->comission){
            $company->company_commission = $data->comission;
        }
        if($data->has('extra_amount') && $data->extra_amount){
            $company->extra_amount = $data->extra_amount;
        }
        if($data->has('levy_charge') && $data->levy_charge){
            $company->levy_charge = $data->levy_charge;
        }
        if($data->has('short_notes') && $data->short_notes){
            $company->short_notes = $data->short_notes;
        }
        if($data->has('parking_procedure_email') && $data->parking_procedure_email){
            $company->parking_procedure_email = $data->parking_procedure_email;
        }
        if($data->has('drop_off_procedure') && $data->drop_off_procedure){
            $company->drop_off_procedure = $data->drop_off_procedure;
        }
        if($data->has('return_procedure') && $data->return_procedure){
            $company->return_procedure = $data->return_procedure;
        }
        if($data->has('company_overview') && $data->company_overview){
            $company->company_overview = $data->company_overview;
        }
        if($data->has('short_description') && $data->short_description){
            $company->short_description = $data->short_description;
        }
        if($data->has('airport_id') && $data->airport_id){
            $company->airport_id = $data->airport_id;
        }
        if($data->has('terminal_id') && $data->terminal_id){
            $company->terminal_id = $data->terminal_id;
        }
        if($data->has('added_by') && $data->added_by){
            $company->added_by = $data->added_by;
        }
        if($data->has('company_logo') && $data->company_logo){
            $company->logo_id = 1;//$data->company_logo;
        }
        if($data->has('protection_status') && $data->protection_status){
            $company->protection_status = $data->protection_status;
        }
        if($data->has('offer_types') && $data->offer_types){
            $company->offer_types = $data->offer_types;
        }
        if($data->has('company_types') && $data->company_types){
            $company->company_types = $data->company_types;
        }
        if($data->has('service_types') && $data->service_types){
            $company->service_types = $data->service_types;
        }
        if($data->has('send_csv') && $data->send_csv){
            $company->send_csv = $data->send_csv;
        }
        if($data->has('add_extra_amount') && $data->add_extra_amount){
            $company->add_extra_status = $data->add_extra_amount;
        }
        if($data->has('is_levy_charge') && $data->is_levy_charge){
            $company->levy_charge_status = $data->is_levy_charge;
        }

        $company->company_status  = 1;
        $company->save();
        
        return $company;
    }

    public static function updateCompany($data){

        $company = Company::where('id',$data->company_id)->first() ?? new Company();
        
        if($data->has('company_title') && $data->company_title){
            $company->company_title = $data->company_title;
        }
        if($data->has('company_email') && $data->company_email){
            $company->company_email = $data->company_email;
        }
        if($data->has('company_phone') && $data->company_phone){
            $company->company_phone = $data->company_phone;
        }
        if($data->has('company_url') && $data->company_url){
            $company->company_url = $data->company_url;
        }
        if($data->has('price_plan') && $data->price_plan){
            $company->price_plan = $data->price_plan;
        }
        if($data->has('sku_id') && $data->sku_id){
            $company->company_sku_id = $data->sku_id;
        }
        if($data->has('sku_tag') && $data->sku_tag){
            $company->company_sku_tag = $data->sku_tag;
        }
        if($data->has('sku_sending_tag') && $data->sku_sending_tag){
            $company->company_sku_sending_tag = $data->sku_sending_tag;
        }
        if($data->has('sequence') && $data->sequence){
            $company->company_sequence = $data->sequence;
        }
        if($data->has('mins_sms') && $data->mins_sms){
            $company->min_sms = $data->mins_sms;
        }
        if($data->has('daily_bookings') && $data->daily_bookings){
            $company->daily_bookings = $data->daily_bookings;
        }
        if($data->has('monthly_bookings') && $data->monthly_bookings){
            $company->monthly_bookings = $data->monthly_bookings;
        }
        if($data->has('comission') && $data->comission){
            $company->company_commission = $data->comission;
        }
        if($data->has('extra_amount') && $data->extra_amount){
            $company->extra_amount = $data->extra_amount;
        }
        if($data->has('levy_charge') && $data->levy_charge){
            $company->levy_charge = $data->levy_charge;
        }
        if($data->has('short_notes') && $data->short_notes){
            $company->short_notes = $data->short_notes;
        }
        if($data->has('parking_procedure_email') && $data->parking_procedure_email){
            $company->parking_procedure_email = $data->parking_procedure_email;
        }
        if($data->has('drop_off_procedure') && $data->drop_off_procedure){
            $company->drop_off_procedure = $data->drop_off_procedure;
        }
        if($data->has('return_procedure') && $data->return_procedure){
            $company->return_procedure = $data->return_procedure;
        }
        if($data->has('company_overview') && $data->company_overview){
            $company->company_overview = $data->company_overview;
        }
        if($data->has('short_description') && $data->short_description){
            $company->short_description = $data->short_description;
        }
        if($data->has('airport_id') && $data->airport_id){
            $company->airport_id = $data->airport_id;
        }
        if($data->has('terminal_id') && $data->terminal_id){
            $company->terminal_id = $data->terminal_id;
        }
        if($data->has('added_by') && $data->added_by){
            $company->added_by = $data->added_by;
        }
        if($data->has('company_logo') && $data->company_logo){
            $company->logo_id = 1;//$data->company_logo;
        }
        if($data->has('protection_status') && $data->protection_status){
            $company->protection_status = $data->protection_status;
        }
        if($data->has('offer_types') && $data->offer_types){
            $company->offer_types = $data->offer_types;
        }
        if($data->has('company_types') && $data->company_types){
            $company->company_types = $data->company_types;
        }
        if($data->has('service_types') && $data->service_types){
            $company->service_types = $data->service_types;
        }
        if($data->has('send_csv') && $data->send_csv){
            $company->send_csv = $data->send_csv;
        }
        if($data->has('add_extra_amount') && $data->add_extra_amount){
            $company->add_extra_status = $data->add_extra_amount;
        }
        if($data->has('is_levy_charge') && $data->is_levy_charge){
            $company->levy_charge_status = $data->is_levy_charge;
        }
        $company->save();
        
        return $company;
    }
}
