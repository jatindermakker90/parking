
<div style="background-color:#0a515e;color:#fff;padding:16px 16px 16px 20px;;font-size:17px;font-weight:600;" >BOOKING REFRENCE - {{ $ref_id }} | AIRPORT - {{ $airport['airport_name'] }} | COMPANY - {{ $company['company_title'] }}</div>
<div style="margin-top: 10px;margin-bottom: 0px;border-width: 400px;border-bottom: 3px solid #ddd; "></div>
<div class="row" style="padding: 10px;">
    <div class="col-md-3 breakWord" style="">
      <i class="fa fa-plane" aria-hidden="true" style="margin-right: 10px;"></i><span style="font-size: 16px;display:inline-block;margin-top: 20px;color: #2e2e2e;"><strong>Booking Details</strong></span>
      <ul class="custom-ul">
        <li>Selected Company: <strong>{{ $company['company_title'] }}</strong></li>
        <li>Selected Airport: <strong>{{ $airport['airport_name'] }}</strong></li>
        <li>Entry Date: <strong>{{ $dep_date }}</strong> </li>
        <li>Exit Date: <strong>{{ $return_date }}</strong> </li>
        <li>No of Days: <strong>{{ $total_days }} Days</strong></li>
        <li>Terminal In: <strong>{{ $drop_off_terminal }}</strong></li>
        <li>Terminal Out: <strong>{{ $return_terminal }}</strong></li>
        <li>Out FLight No: <strong>{{ $return_terminal }}</strong></li>
        <li>Return Flight No: <strong>{{ $flight_number }}</strong></li>
      </ul>
    </div>
    <div class="col-md-3 breakWord">
      <i class="fa fa-user" aria-hidden="true" style="margin-right: 10px;"></i><span style="font-size: 16px;display:inline-block;margin-top: 20px;color: #2e2e2e;"><strong>User Details</strong></span>
      <ul class="custom-ul">
        <li>Name: <strong> @if($title == 'mr') Mr. @elseif($title == 'ms') Ms. @else Mrs. @endif {{ $first_name.' '.$last_name }} </strong> </li>
        <li>Email: <strong>{{ $email }}</strong></li>
        <li>Mobile: <strong>{{ $mobile }}</strong></li>
        <li>Address: <strong>{{ $address }}</strong></li>
        <li>City: <strong>{{ $city_town }}</strong></li>
        <li>Postal Code: <strong>{{ $postcode }}</strong></li>
      </ul>
    </div>
    <div class="col-md-3 breakWord">
      <i class="fa fa-car" aria-hidden="true" style="margin-right: 10px;"></i><span style="font-size: 16px;display:inline-block;margin-top: 20px;color: #2e2e2e;"><strong>Vehicle Details</strong></span>
      @foreach($vehicle as $vehicle_key => $vehicle_value)
        <ul class="custom-ul {{ ((count($vehicle) == $vehicle_key+1) > 0) ? '' : 'border-bottom' }}">
          <li>Make: <strong>{{ $vehicle_value['vehicle_make'] }}</strong></li>
          <li>Model: <strong>{{ $vehicle_value['vehicle_model'] }}</strong></li>
          <li>Color: <strong>{{ $vehicle_value['vehicle_colour'] }}</strong></li>
          <li>Reg No: <strong>{{ $vehicle_value['vehicle_reg'] }}</strong></li>
        </ul>
      @endforeach
    </div>
    <div class="col-md-3 breakWord">
        <i class="fa fa-credit-card-alt" aria-hidden="true" style="margin-right:10px;"></i><span style="font-size: 16px;display:inline-block;margin-top: 20px;color: #2e2e2e;"><strong>Payment Details</strong></span>
        <ul class="custom-ul">
          <li>Cancellation Protection: <strong>N/A</strong></li>
          <li>Levy Charge: <strong>0</strong></li>
          <li>Extra Amount: <strong>0</strong></li>
          <li>Cancellation Charge: <strong>@if(isset($payment['cancellation_charge'])) {{ $payment['cancellation_charge'] }} @else 0 @endif</strong></li>
          <li>Sms Charge: <strong>@if(isset($payment['sms_charge'])) {{ $payment['sms_charge'] }} @else 0 @endif</strong></li>
          <li>Payment Method: <strong>@if(isset($payment['payment_method'])) {{ $payment['payment_method'] }} @else N/A @endif</strong></li>
          <li>Quote Amount: <strong>0</strong></li>
          <li>Discount Amount: <strong>@if(isset($payment['discount_amount'])) {{ $payment['discount_amount'] }} @else 0 @endif</strong></li>
          <li>Paid Amount: <strong>@if(isset($payment['paid_amount'])) {{ $payment['paid_amount'] }} @else 0 @endif </strong></li>
          <li>Payment Status: <strong>@if(isset($payment['status']) == '1') Complete @else InComplete @endif</strong></li>
          <li>Transaction ID: <strong>@if(isset($payment['transaction_id'])) {{ $payment['transaction_id'] }} @else N/A @endif</strong></li>
        </ul>
    </div>
</div>
<!-- <div class="row" style="padding: 10px;">
    <div class="col-md-12">
      <i class="fa fa-server" aria-hidden="true" style="margin-right: 10px;"></i><span style="font-size: 16px;display:inline-block;margin-top: 20px;color: #2e2e2e;"><strong>Other Details</strong></span>
    </div>
    <div class="col-md-3">
      <ul class="custom-ul breakWord">
        <li>IP Before Payment: <strong>123.45.67.88</strong></li>
        <li>IP After Payment: <strong>123.45.67.88</strong></li>
        <li>last Page: <strong>MyPage.php</strong></li>
      </ul>
    </div>
    <div class="col-md-3">
      <ul class="custom-ul breakWord">
        <li>OS: <strong>Ubuntu</strong></li>
        <li>OS Version: <strong>Ubuntu 22</strong></li>
        <li>Browser: <strong>Opera</strong></li>
      </ul>
    </div>
    <div class="col-md-3">
      <ul class="custom-ul breakWord">
        <li>Browser Version: <strong>111.0.1661.62</strong></li>
        <li>Is Robot: <strong>No</strong></li>
        <li>Robot Name: <strong>No</strong></li>
      </ul>
    </div>
    <div class="col-md-3">
      <ul class="custom-ul breakWord">
        <li>Device: <strong>WebKit</strong></li>
        <li>Is Desktop: <strong>Yes</strong></li>
        <li>Is Phone: <strong>No</strong></li>
      </ul>
    </div>
</div> -->
<div style="margin-top: 10px;margin-bottom: 0px;border-width: 400px;border-bottom: 1px solid #ddd; "></div>
<div class="row">
    <div class="col-md-12">
      <span style="font-size: 18px;display:inline-block;margin-left:10px;margin-top: 15px;color: #2e2e2e;"><strong>Notes And Information:</strong></span>
      <p name="special_notes" id="special_notes">{{ $special_notes }}</p>
    </div>
</div>
