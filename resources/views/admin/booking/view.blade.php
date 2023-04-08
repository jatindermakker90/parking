
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
      <ul class="custom-ul">
        <li>Make: <strong>{{ $vehicle['vehicle_make'] }}</strong></li>
        <li>Model: <strong>{{ $vehicle['vehicle_model'] }}</strong></li>
        <li>Color: <strong>{{ $vehicle['vehicle_colour'] }}</strong></li>
        <li>Reg No: <strong>{{ $vehicle['vehicle_reg'] }}</strong></li>
      </ul>
    </div>
    <div class="col-md-3 breakWord">
        <i class="fa fa-credit-card-alt" aria-hidden="true" style="margin-right:10px;"></i><span style="font-size: 16px;display:inline-block;margin-top: 20px;color: #2e2e2e;"><strong>Payment Details</strong></span>
        <ul class="custom-ul">
          <li>Quote Amount: <strong>59.00</strong></li>
          <li>Cancellation Protection: <strong>No</strong></li>
          <li>Discount Amount: <strong>0.00</strong></li>
          <li>Levy Charge: <strong>0</strong></li>
          <li>Extra Amount: <strong>3</strong></li>
           <li>Postal Charge: <strong>0</strong></li>
          <li>Cancellation Charge: <strong>0</strong></li>
          <li>Sms Charge: <strong>0</strong></li>
          <li>Payment Method: <strong>talktosolutions</strong></li>
          <li>Transaction ID: <strong>a8f745f2-ead5-ed11-80ed-0050569161f2</strong></li>
          <li>Paid Amount: <strong>63.95 £</strong></li>
          <li>Payment Status: <strong>Completed</strong></li>
          <li>Email Status: <strong>Booking Email Sent</strong></li>
          <li>Is Cash: <strong>No</strong></li>
          <li>Is Amend: <strong>No</strong></li>
        </ul>
    </div>
</div>
<div class="row" style="padding: 10px;">
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
</div>
<div style="margin-top: 10px;margin-bottom: 0px;border-width: 400px;border-bottom: 1px solid #ddd; "></div>
<div class="row">
    <div class="col-md-12">
      <span style="font-size: 18px;display:inline-block;margin-left:10px;margin-top: 15px;color: #2e2e2e;"><strong>Notes And Information:</strong></span>
      <p name="special_notes" id="special_notes">{{ $special_notes }}</p>
    </div>
</div>
