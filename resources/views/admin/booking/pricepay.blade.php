
<div style="background-color:#0a515e;color:#fff;padding:16px 16px 16px 20px;;font-size:17px;font-weight:600;" >BOOKING REFRENCE - {{ $ref_id }} | AIRPORT - {{ $airport['airport_name'] }} | COMPANY - {{ $company['company_title'] }}</div>
<div style="margin-top: 10px;margin-bottom: 0px;border-width: 400px;border-bottom: 3px solid #ddd; "></div>
<form action="{{ route('post-booking-pricepay') }}" method="post" style="margin-top: 5px;">
  @csrf
    <div class="row" style="margin-left: -5px; margin-right: -5px;">
      <input type="hidden" name="booking_id" value="{{ $id }}">
      <input type="hidden" name="payment_id" value="{{ $payment['id'] }}">
    <div class="col-sm-12">
    <label>Booking Status</label>
    <span class="btn btn-primary btn-sm">
    In-Complete </span>
    </div>
    </div>
    <hr>
    <div class="row" style="margin-left: -5px; margin-right: -5px;">
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Title</label>
        @if($title == 'mr')
        <input type="text" class="form-control" name="title" disabled="disabled" value="Mr.">
        @elseif($title == 'ms')
        <input type="text" class="form-control" name="title" disabled="disabled" value="Ms.">
        @else
        <input type="text" class="form-control" name="title" disabled="disabled" value="Mrs.">
        @endif
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Firstname</label>
        <input type="text" class="form-control" name="FirstName" disabled="disabled" required="" value="{{ $first_name }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Lastname</label>
        <input type="text" class="form-control" name="Lastname" disabled="disabled" required="" value="{{ $last_name }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Email</label>
        <input type="text" class="form-control" name="email" disabled="disabled" required="" value="{{ $email }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Mobile</label>
        <input type="text" class="form-control" name="mobile" disabled="disabled" required="" value="{{ $mobile }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Quote Amount</label>
        <input type="text" class="form-control" name="quoteAmount" readonly="" required="" value="{{ $price }}">
      </div>
    </div>
    <div class="row" style="margin-left: -5px; margin-right: -5px; margin-top: 10px;">
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Ref No</label>
        <input type="text" class="form-control" name="ref_no" disabled="disabled" required="" value="{{ $ref_id }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Entry date/time</label>
        <input type="text" class="form-control" name="entry_date" disabled="disabled" required="" value="{{ $updated_dep_date }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Exit date/time</label>
        <input type="text" class="form-control" name="exit_date" disabled="disabled" required="" value="{{ $updated_dep_time }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Depart Term</label>
        <input type="text" class="form-control" name="terminal_in" disabled="disabled" required="" value="{{ $drop_off_terminal }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Arrive Term</label>
        <input type="text" class="form-control" name="terminal_out" disabled="disabled" required="" value="{{ $return_terminal }}">
      </div>
      <div class="col-sm-2" style="margin-top:0px;">
        <label>Arrive Flight #</label>
        <input type="text" class="form-control" name="return_flight_no" disabled="disabled" required="" value="{{ $flight_number }}">
      </div>
    </div>
    <div class="my-3 py-3 border border-2 border-primary rounded rounded-3">
      @foreach($vehicle as $vehicle_key => $vehicle_value)
        <div class="row" style="margin-left: -5px; margin-right: -5px; margin-top: 10px;">
          <div class="col-sm-3" style="margin-top:0px;">
            <label>Make</label>
            <input type="text" class="form-control" name="make" disabled="disabled" required="" value="{{ $vehicle_value['vehicle_make'] }}">
          </div>
          <div class="col-sm-3" style="margin-top:0px;">
            <label>Model</label>
            <input type="text" class="form-control" name="model" disabled="disabled" required="" value="{{ $vehicle_value['vehicle_model'] }}">
          </div>
          <div class="col-sm-3" style="margin-top:0px;">
            <label>Color</label>
            <input type="text" class="form-control" name="color" disabled="disabled" required="" value="{{ $vehicle_value['vehicle_colour'] }}">
          </div>
          <div class="col-sm-3" style="margin-top:0px;">
            <label>Reg no</label>
            <input type="text" class="form-control" name="regno" disabled="disabled" required="" value="{{ $vehicle_value['vehicle_reg'] }}">
          </div>
        </div>
      @endforeach
    </div>
    <div class="row" style="margin-left: -5px; margin-right: -5px; margin-top: 10px;">
    <div class="col-sm-2" style="margin-top:0px;">
    <label>Amount To Be Payed</label>
    <input type="text" class="form-control" name="totalPaidAmount" required="" placeholder="" value="{{ $payment['total_price'] }}">
    </div>
    <div class="col-sm-2" style="margin-top:0px;">
    <label>Payment Method</label>
    <select class="form-control last_option" name="payment_method" id="payment_method_get">
        @foreach(config('constant.PAYMENT_METHODS') as $time_key => $time_value)
            <option value="{{$time_key}}">{{$time_value}}</option>
        @endforeach
    </select>
    </div>
    <div class="col-sm-2" style="margin-top:0px;">
    <label>Payment Status</label>
    <select class="form-control" id="status" name="status">
    <option value="1" selected="selected">Completed</option>
    <option value="2">In-Complete</option>
    <option value="3">Pending</option>
    </select>
    </div>
    <div class="col-sm-4" style="margin-top:0px;">
    <label>Transaction ID</label>
    <input type="text" class="form-control" name="transaction_id" required="" id="transaction_id" placeholder="Please enter Transaction ID">
    </div>
    </div>
    <div class="row" style="margin-left: -5px; margin-right: -5px;">
    <div class="col-sm-12" style="margin-top:20px;">
    <label>Special Notes</label>
    <textarea class="form-control" name="notes" rows="2" cols="10"></textarea>
    </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-sm-4" style="margin-left:7px;">
    <input type="submit" class="btn btn-success" name="submit" value="Activate Now" id="activateNow">
    </div>
    </div>
</form>
