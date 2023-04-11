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
        // dd($data);
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
            // echo $key;
            $brand_id = $company_price_brand->brand_id[$key]['id'];
            $get_brand_price = BrandPrices::find($brand_id);
            if($get_brand_price->count() > 0){
                $get_brand_price->days_price = json_decode($get_brand_price->days_price, true);
                foreach ($get_brand_price->days_price as $k => $value) {
                    if(key($value) == $key){
                       $booking_price = $value[$key];
                   }
                }
                if($company_details->add_extra_status == 1){
                    $booking_price = $booking_price + $company_details->extra_amount;
                }
                if($company_details->levy_charge_status == 1){
                    $booking_price = $booking_price + $company_details->levy_charge;
                }
                
            }
            // dd($booking_price, $company_details->toArray());
        }
        return $booking_price;
    }
}