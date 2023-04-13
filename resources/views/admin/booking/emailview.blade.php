
<div style="background-color:#0a515e;color:#fff;padding:16px 16px 16px 20px;;font-size:17px;font-weight:600;" >BOOKING REFRENCE - {{ $ref_id }} | AIRPORT - {{ $airport['airport_name'] }} | COMPANY - {{ $company['company_title'] }}</div>
<div style="margin-top: 10px;margin-bottom: 0px;border-width: 400px;border-bottom: 3px solid #ddd; "></div>
<form action="{{ route('post-booking-email') }}" method="post" style="margin-top: 5px;">
  @csrf
  <input type="hidden" name="booking_id" value="{{ $id }}">
  <div class="row">
    <div class="col-sm-2">
      <div class="checkbox">
      <label><input type="checkbox" name="client" value="1">Client</label>
    </div>
    </div>
    <div class="col-sm-3">
      <div class="checkbox">
      <label><input type="checkbox" name="company" value="2">Company</label>
    </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-4" style="margin-left:7px;">
      <input type="submit" class="btn btn-success" name="submit" value="Send Now">
    </div>
  </div>
</form>
