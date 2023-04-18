<?php
use App\Models\Company;
use App\Models\brandPrices as BrandPrices;
use App\Models\CompanyBrandPrice;

if (! function_exists('getCompanyPriceByDays')) {
    /**
     * Format text.
     *
     * @param  string  $text
     * @return string
     */
    function getCompanyPriceByDays($data)
    {
        $company_details = $data['company'];
        $company_price_brand = CompanyBrandPrice::where([
                                'company_id' => $company_details->id, 
                                'month' => $data['month'],
                                'year' => $data['year'] 
                            ])->first();
        $booking_price = null;
        if($company_price_brand != null && $company_price_brand->count() > 0){
            $company_price_brand->brand_id = json_decode($company_price_brand->brand_id, true);
            $key = 'day_'.$data['no_of_days_booking'];
            $brand_id = $company_price_brand->brand_id[$key]['id'];
            $get_brand_price = BrandPrices::find($brand_id);
            if($get_brand_price->count() > 0){
                $get_brand_price->days_price = json_decode($get_brand_price->days_price, true);
                foreach ($get_brand_price->days_price as $k => $value) {
                    if(key($value) == $key){
                       $booking_price = $value[$key];
                   }
                }
                if(isset($data['total_vehicle']) && !empty($data['total_vehicle'])){
                    $booking_price = $booking_price * $data['total_vehicle'];
                }
                if($company_details->add_extra_status == 1){
                    $booking_price = $booking_price + $company_details->extra_amount;
                }
                if($company_details->levy_charge_status == 1){
                    $booking_price = $booking_price + $company_details->levy_charge;
                }
                if(!empty($data['discount_amount'])){
                    $booking_price = getPriceAfterDiscount($booking_price, $data['discount_amount'], $data['discount_type']);
                }
            }
        }
        return $booking_price;
    }
}

if (! function_exists('getPriceAfterDiscount')) {
    function getPriceAfterDiscount($price, $discount_price, $discount_type){
        $new_price = $price;
        if($discount_type == 'amount'){
            $new_price = $price - (int)$discount_price;
        }
        if($discount_type == 'percentage'){
            $new_price = ($price*(int)$discount_price)/100;
            $new_price = number_format((float)$new_price, 2, '.', '');
        }
        return $new_price;
    }
}