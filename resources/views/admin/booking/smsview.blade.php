
<div style="background-color:#0a515e;color:#fff;padding:16px 16px 16px 20px;;font-size:17px;font-weight:600;" >BOOKING REFRENCE - {{ $ref_id }} | AIRPORT - {{ $airport['airport_name'] }} | COMPANY - {{ $company['company_title'] }}</div>
<div style="margin-top: 10px;margin-bottom: 0px;border-width: 400px;border-bottom: 3px solid #ddd; "></div>
<form action="{{ route('post-booking-sms') }}" method="post" style="margin-top: 5px;">
  @csrf
  <input type="hidden" name="booking_id" value="{{ $id }}">
  <div class="row" style="padding-bottom: 50px;">
    <div class="form-control">
      <input type="hidden" name="mobile" value="{{ $mobile }}">
      Would you like to send message to this client: {{ $mobile }}
    </div>
    <div class="form-control" style="margin-top: 10px;">
      <label><input type="checkbox" name="force" value="1"> &nbsp;Force resend even if sent before</label>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4" style="margin-left:7px;">
      <input type="submit" class="btn btn-success" name="submit" value="Send Message">
    </div>
  </div>
</form>
