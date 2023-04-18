@extends('adminlte::page')
@section('title', config('adminlte.title'))
@section('content_header')
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <a href ="{{ route('bookings.index') }}">
               <button type="button" class="btn btn-block btn-danger">Back</button>
               </a>
            </ol>
          </div>
        </div>
      </div>
@stop
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <form method="POST" action="{{ route('search-booking-companies') }}" enctype="multipart/form-data" id="filter-form">
        <div class="card-header">
          <h3 class="card-title">{{ $header }}</h3>
        </div>
        <div class="card-body">
          <div class="col-12">
            <div class="form-row">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="no_of_days_booking" id="no_of_days_booking">
              <div class="form-group {{ $errors->has('select_airport') ? 'has-error' : '' }} col-4">
                <label for="name">Select Airport</label>
                <select class="form-control select2" name ="select_airport" id ="select_airport">
                  <option value="">Select airport</option>
                  @foreach ($airports as $airport_key => $airport_value)
                    <option value="{{ $airport_value->id }}" <?php echo (isset($request) && $request['select_airport'] == $airport_value->id)  ? 'selected' : '' ?>>{{ $airport_value->airport_name }}</option>
                  @endforeach
                </select>
                <span class="validationFail">Please select airport</span>
                @if($errors->first('select_airport'))
                <span style="color:red;" class="form-error">Please select airport</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('dep_date') ? 'has-error' : '' }} col-4">
                <label for="name">Departure Date</label>
                <input type="date" class="form-control" min="{{ now()->format('Y-m-d')  }}" name ="dep_date" placeholder="Select departure date" id="dep_date" value="<?php echo (isset($request) && $request['dep_date'])  ? $request['dep_date'] : '' ?>">
                <span class="validationFail">Please select departure date</span>
                @if($errors->first('dep_date'))
                <span style="color:red;" class="form-error">Please enter departure date</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('dep_time') ? 'has-error' : '' }} col-4">
                <label for="name">Departure Time</label>
                  <select class="form-control select2" name="dep_time" id="dep_time">
                    <option value="">Select time</option>
                    @foreach(config('constant.TIME_INTERVAL') as $time_key => $time_value)
                      <option value="{{$time_value}}" <?php echo (isset($request) && $request['dep_time'] == $time_value)  ? 'selected' : '' ?>>{{$time_value}}</option>
                    @endforeach
                  </select>
                  <span class="validationFail">Please select departure time</span>
                  @if($errors->first('dep_time'))
                    <span style="color:red;" class="form-error">Please enter departure time</span>
                  @endif
              </div>

              <div class="form-group {{ $errors->has('return_date') ? 'has-error' : '' }} col-4">
                <label for="return_date">Arrival Date</label>
                  <input type="date" class="form-control" min="{{ now()->format('Y-m-d')  }}" name ="return_date" id="return_date" value="<?php echo (isset($request) && $request['return_date'])  ? $request['return_date'] : '' ?>">
                  <span class="validationFail">Please select arrival date</span>
                  @if($errors->first('return_date'))
                    <span style="color:red;" class="form-error">Please enter arrival date</span>
                  @endif
              </div>

              <div class="form-group {{ $errors->has('return_time') ? 'has-error' : '' }} col-4">
                <label for="return_time">Arrival Time</label>
                <select class="form-control last_option select2" name="return_time" id="return_time">
                  <option value="">Select time</option>
                  @foreach(config('constant.TIME_INTERVAL') as $time_key => $time_value)
                    <option value="{{$time_value}}" <?php echo (isset($request) && $request['return_time'] == $time_value)  ? 'selected' : '' ?>>{{$time_value}}</option>
                  @endforeach
                </select>
                <span class="validationFail">Please select arrival time</span>
                @if($errors->first('return_time'))
                  <span style="color:red;" class="form-error">Please enter arrival time</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('discount_code') ? 'has-error' : '' }} col-4">
                <label for="discount_code">Discount Code</label>
                <input type="text" class="form-control"  placeholder="Enter Test Cost" name ="discount_code" id ="discount_code" value="<?php echo (isset($request) && $request['discount_code'])  ? $request['discount_code'] : '' ?>">
                <input type="hidden" name="discount_amount" id="discount_amount" value="<?php echo (isset($request) && $request['discount_amount'])  ? $request['discount_amount'] : '' ?>">
                <input type="hidden" name="discount_type" id="discount_type" value="<?php echo (isset($request) && $request['discount_type'])  ? $request['discount_type'] : '' ?>">
                <span class="validationFail">Please select discount code</span>
                <span class="isValid"></span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" class="btn btn-primary" id="filter_form_submit">Search Now</button>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>

@if(!empty($searchedCompanies) && $searchedCompanies->count() > 0)
  <div class="row" id="company-list">
    @foreach($searchedCompanies as $searchedCompanies_key => $searchedCompanies_value)
      <div class="col-3 company" data-id="{{ $searchedCompanies_value->id }}">
        <div class="card">
          <div class="card-header text-center">
            <div>
              <p class="m-0 text-success"><i class="fas fa-window-close mr-1"></i>Cancellation Cover Available</p>
              <h6 class="company-title font-weight-bold">{{ $searchedCompanies_value->company_title }}</h6>
              <p>{{$searchedCompanies_value->company_types[0]->name ?? ''}}</p>
            </div>
          </div>
          <div class="card-body">
            <div>
              <img class="booking-company-logo mb-3" src="{{ env('IMAGE_URL').$searchedCompanies_value->logo_id }}" alt="" srcset="">
              @if(!empty($searchedCompanies_value->service_types) && $searchedCompanies_value->service_types->count() > 0 )
                <ul>
                  @foreach($searchedCompanies_value->service_types as $serviceTypeKey => $serviceTypeValue)
                    <li>{{$serviceTypeValue->name}}</li>
                  @endforeach
                </ul>
              @endif
              <div class="company-price">&pound; <span>{{ $searchedCompanies_value->final_booking_price ?? 0 }}</span></div>
              <input type="hidden" id="price_with_admin_charge" value="{{ $searchedCompanies_value->price_with_admin_charge ?? '' }}">
            </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary w-100 book-now" data-id="{{ $searchedCompanies_value->id }}">Book Now</button>
          </div>
        </div>
      </div>
    @endforeach
    <!-- /.card -->
  </div>
@endif
  <div class="row" id="booking-form">
      <div class="col-8">
        <div class="card">
          <form action="{{ route('bookings.store') }}" method="post" id="booking_form">
            <input type="hidden" name="company_id" id="company_id">
            <input type="hidden" name="select_airport" id="booking_airport_id">
            <input type="hidden" name="dep_date" id="booking_dep_date">
            <input type="hidden" name="dep_time" id="booking_dep_time">
            <input type="hidden" name="return_date" id="booking_return_date">
            <input type="hidden" name="return_time" id="booking_return_time">
            <input type="hidden" name="discount_code" id="booking_discount_code">
            <input type="hidden" name="discount_amount" id="booking_discount_amount">
            <input type="hidden" name="discount_type" id="booking_discount_type">
            <input type="hidden" name="base_price" id="booking_base_price">
            <div class="card-header text-center">
              <h3 class="card-title">Fill Your Deatils</h3>
            </div>
            <div class="card-body">
             <div>
              <div>
                <h3 class="mb-4">Contact Details</h3>
              </div>
              <div class="row">
                <div class="col-2">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <select class="form-control select2" style="width: 100%;" name="title" id="title">
                      <option value="mr">Mr.</option>
                      <option value="ms">Ms.</option>
                      <option value="mrs">Mrs.</option>
                    </select>
                    <span class="validationFail">Please select title</span>
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name" id="first_name">
                    <span class="validationFail">Please select first name</span>
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" placeholder="Enter last name" name="last_name" id="last_name">
                    <span class="validationFail">Please select last name</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" id="email">
                    <span class="validationFail">Please select email</span>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="mobile">Contact Number</label>
                    <input type="number" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile">
                    <span class="validationFail">Please enter contact number </span>
                  </div>
                </div>
              </div>
              <div>
                <h3 class="mt-5 mb-4">Optional Servivce</h3>
              </div>
              <div class="row">
                <div class="col-4 optional-service-column-1">
                  <div class="checkbox mb-3">
                    <div class="checker font-weight-bold">
                      <span class="mr-2">
                        <input type="checkbox" class="cancellation_cover" name="cancellation_cover">
                      </span>
                      Cancellation Cover
                    </div>
                  </div>
                  <p class="m-0">Cancellation protection is extra protection & peace of mind if you need to cancel your booking.</p>
                </div>
                <div class="col-4 optional-service-column-2">
                  <div class="checkbox mb-3">
                    <div class="checker font-weight-bold">
                      <span class="mr-2">
                        <input type="checkbox" class="sms_confirmation" name="sms_confirmation">
                      </span>
                      Sms Confirmation
                    </div>
                  </div>
                  <p class="m-0">Select this option and you will receive your parking order confirmation Via sms text message.</p>
                </div>
              </div>
              <div>
                <h3 class="mt-5 mb-4">Vehicle Details</h3>
              </div>
              <div id="vehicle-details-row">
                <div class="row" id="0">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_make">Vehicle Make</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle make" name="vehicle[0][vehicle_make]" id="vehicle_make">
                      <span class="validationFail">Please select vehicle make</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_model">Vehicle Model</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle model" name="vehicle[0][vehicle_model]" id="vehicle_model">
                      <span class="validationFail">Please select vehicle model</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_colour">Vehicle Colour</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle[0][vehicle_colour]" id="vehicle_colour">
                      <span class="validationFail">Please select vehicle colour</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_reg">Vehicle Reg</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle reg" name="vehicle[0][vehicle_reg]" id="vehicle_reg">
                      <span class="validationFail">Please select vehicle reg.</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="no_of_peopele">No of People</label>
                      <select class="form-control select2" style="width: 100%;" name="vehicle[0][no_of_peopele]" id="no_of_peopele">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="form-group">
                  <label for=""></label>
                  <button type="button" class="btn btn-default add-vehicle-button">Add Vehicle</button>
                </div>
              </div>
              <div>
                <h3 class="mt-5 mb-4">Flight Information (Optional)</h3>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="drop_off_terminal">Drop-off Terminal</label>
                    @if(isset($terminal))
                    <select class="form-control select2" style="width: 100%;" name="drop_off_terminal" id="drop_off_terminal">
                      <option value="tbc">TBC</option>
                    @foreach ($terminal as $terminal_value)
                      <option value="{{ $terminal_value->terminal_name }}">{{ $terminal_value->terminal_name }}</option>
                    @endforeach
                    </select>
                    @endif
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="return_terminal">Return Terminal</label>
                    @if(isset($terminal))
                    <select class="form-control select2" style="width: 100%;" name="return_terminal" id="return_terminal">
                      <option value="tbc">TBC</option>
                    @foreach ($terminal as $terminal_value)
                      <option value="{{ $terminal_value->id }}">{{ $terminal_value->terminal_name }}</option>
                    @endforeach
                    </select>
                    @endif
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="flight_number">Return Flight Number</label>
                    <input type="text" class="form-control" placeholder="We need only flight number" name="flight_number" id="flight_number">
                    <span class="validationFail">Please select flight number, If you have.</span>
                  </div>
                </div>
              </div>
             </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary w-100 submit-button">Submit</button>
            </div>
          </form>
          <!-- /.card-body -->
        </div>
      </div>
    <!-- /.card -->
      <div class="col-4" id="booking-summary">
        <div class="card">
          <div class="card-header text-center">
            <h3 class="card-title">Your Booking Summary</h3>
          </div>
          <div class="card-body">
            <div>
              <img class="booking-company-logo" src="{{ asset('assets/images/abstract-logo-company-made-with-color_341269-925.jpg') }}" alt="" srcset="">
              <div>
                <h6 class="company-title font-weight-bold"></h6>
                <h6 class="drop-off font-weight-bold"></h6>
                <h6 class="pick-up font-weight-bold"></h6>
                <h6 class="airport font-weight-bold"></h6>
                <hr>
                <h6 class="booking-charge font-weight-bold"></h6>
                <h6 class="cancellation_cover_charge font-weight-bold"></h6>
                <h6 class="sms_confirmation_charge font-weight-bold"></h6>
                <h6 class="booking-discount-amount font-weight-bold text-success"></h6>
                <hr>
                <h6 class="total-charge font-weight-bold"></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
@stop
@section('css')
<style>
  .booking-company-logo{
    width: 100%;
    height: 150px;
    object-fit: contain;
  }
  #booking-form{
    display: none;
  }
  .optional-service-column-1, .optional-service-column-2{
    border: 1px solid orange;
    padding: 17px 20px 17px 20px;
  }
  .optional-service-column-1{
    margin-right: 20px;
  }
  .jqueryValidation{
    border: 1px solid red !important;
  }
  .validationFail{
    color: red;
    display: none;
  }
  .cancellation_cover_charge{
    display: none;
  }
  .sms_confirmation_charge{
    display: none;
  }
  .isValid{
    display: none;
  }
  .company-price{
    color: #fecd08;
    font-size: 32px;
    font-weight: 500;
    text-align: center;
  }
  .add-vehicle-button{
    margin-top: 30px;
  }
  #vehicle-details-row .row{
    padding: 21px 21px;
    position: relative;
  }
  #vehicle-details-row .vehicle-row:hover{
    background-color: #adadad63;
    border-radius: 10px;
    box-shadow: #615f5fbf 0px 10px 11px;
  }
  .border-bottom{
    border-bottom: 1px solid black;
    margin-bottom: 16px;
  }
  .remove-Vehicle-button{
    position: absolute;
    right: 9px;
    top: 0px;
    font-size: 26px;
    color: red;
  }
  .remove-Vehicle-button:hover{
    color: red;
  }
</style>
@stop
@section('js')
<!-- DataTables  & Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('.select2').select2();
  $(document).on('change', '#filter-form #return_date', (e)=>{
    let departureDate = $("#filter-form #dep_date").val();
    if(!departureDate){
      console.log(`please select departure date`);
      $("#filter-form #dep_date").addClass('jqueryValidation');
      $("#filter-form #dep_date").siblings('.validationFail').show();
      e.target.value = '';
    }
    else{
      $("#filter-form #dep_date").removeClass('jqueryValidation');
      $("#filter-form #dep_date").siblings('.validationFail').hide();
    }
  })

  $(document).on('change', '#filter-form #dep_date', (e)=>{
    $(e.target).removeClass('jqueryValidation');
    $(e.target).siblings('.validationFail').hide();
    let returnDate = moment(e.target.value).add(7, 'days').format('YYYY-MM-DD');
    console.log(`dep date:: `, returnDate)
    $("#filter-form #return_date").val(`${returnDate}`);
  })

  $(document).keypress(function(e){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      e.preventDefault();
      $("#filter_form_submit").trigger('click');
      return;
      // alert('You pressed a "enter" key in somewhere');
    }
  });

  $(document).on('click', '#filter_form_submit', (e)=>{
    e.preventDefault();
    let filterForm = $('#filter-form');
    let airport = filterForm.find("#select_airport").val();
    let departureDate = filterForm.find("#dep_date").val();
    let departureTime = filterForm.find("#dep_time").val();
    let returnDate = filterForm.find("#return_date").val();
    let returnTime = filterForm.find("#return_time").val();
    if(!airport){
      filterForm.find("#select_airport").addClass('jqueryValidation');
      filterForm.find("#select_airport").siblings('.validationFail').show();
    }
    else{
      filterForm.find("#select_airport").removeClass('jqueryValidation');
      filterForm.find("#select_airport").siblings('.validationFail').hide();
    }

    if(!departureDate){
      filterForm.find("#dep_date").addClass('jqueryValidation');
      filterForm.find("#dep_date").siblings('.validationFail').show();
    }
    else{
      filterForm.find("#dep_date").removeClass('jqueryValidation');
      filterForm.find("#dep_date").siblings('.validationFail').hide();
    }

    if(!departureTime){
      filterForm.find("#dep_time").addClass('jqueryValidation');
      filterForm.find("#dep_time").siblings('.validationFail').show();
    }
    else{
      filterForm.find("#dep_time").removeClass('jqueryValidation');
      filterForm.find("#dep_time").siblings('.validationFail').hide();
    }

    if(!returnDate){
      filterForm.find("#return_date").addClass('jqueryValidation');
      filterForm.find("#return_date").siblings('.validationFail').show();
    }
    else{
      filterForm.find("#return_date").removeClass('jqueryValidation');
      filterForm.find("#return_date").siblings('.validationFail').hide();
    }

    if(!returnTime){
      filterForm.find("#return_time").addClass('jqueryValidation');
      filterForm.find("#return_time").siblings('.validationFail').show();
    }
    else{
      filterForm.find("#return_time").removeClass('jqueryValidation');
      filterForm.find("#return_time").siblings('.validationFail').hide();
    }
    if(!departureDate && !returnDate){
      return;
    }
    console.log('departureDate:: ', departureDate, 'returnDate:: ', returnDate);
    let start_date = `${departureDate} ${departureTime}:00`;
    let end_date = `${returnDate} ${returnTime}:00`;
    let ajaxUrl = "{{ route('compare-two-date') }}"
    $.ajax({
      type:"POST",
      url: ajaxUrl,
      data: {"start_date": start_date,"end_date": end_date},
      success: function(response){
        console.log(` date comparision:: `, response);
        if(response.data == false){
          toastr["error"]('Arrival date time shouldn\'t be less then to Departure date time');
          filterForm.find("#return_date").addClass('jqueryValidation');
          filterForm.find("#return_time").addClass('jqueryValidation');
        }
        else{
          filterForm.find("#return_date").removeClass('jqueryValidation');
          filterForm.find("#return_time").removeClass('jqueryValidation');

          if(!airport || !departureDate || !departureTime || !returnDate || !returnTime){
            console.log(`form not submit`)
            return;
          }
          else{
            $("#filter-form").find('#no_of_days_booking').val(response.diffInDays);
            console.log(`form submit`)
            $("#filter-form").submit();
          }
        }
      }
    });
  })

  $(document).on('click','.book-now',function(e){
    var company_id    = $(this).data('id');

    let bookingForm = $("#booking-form");
    let bookingSummaryEle = $("#booking-summary");

    let filterEle = $("#filter-form");
    filterEle.find(`input, select, button`).attr('disabled', true);
    let airport = filterEle.find("#select_airport option:selected").text();

    let dropOffDate = filterEle.find("#dep_date").val();
    let dropOffTime = filterEle.find("#dep_time").val();

    let returnDate = filterEle.find("#return_date").val();
    let returnfTime = filterEle.find("#return_time").val();

    let companyTab = $(this).parents('.card');

    let companyPrice = $(companyTab).find(".company-price span").text().trim('');
    let companyPriceWithAdminChareg = $(companyTab).find("#price_with_admin_charge").val().trim('');
    let bookingCharge = "{{ config('constant.BOOKING.BOOKING_CHARGE') }}";

    console.log('companyPrice:: ', companyPrice);

    let imageUrl = companyTab.find('img').attr('src');
    let companyTitle = companyTab.find('.card-header .company-title').text();

    bookingSummaryEle.find(".booking-company-logo").attr('src', imageUrl);
    bookingSummaryEle.find(".company-title").text(companyTitle);
    bookingSummaryEle.find(".drop-off").text(`DROP OFF : ${dropOffDate} at ${dropOffTime}`);
    bookingSummaryEle.find(".pick-up").text(`PICK UP : ${returnDate} at ${returnfTime}`);
    bookingSummaryEle.find(".airport").text(`AIRPORT : ${airport}`);
    bookingSummaryEle.find(".booking-charge").text(`BOOKING CHARGE : ${bookingCharge}`);
    bookingSummaryEle.find(".booking-discount-amount").text(`DISCOUNT : ${filterEle.find('#discount_amount').val()}`);
    bookingSummaryEle.find(".total-charge").text(`TOTAL : ${companyPriceWithAdminChareg}`);

    bookingForm.find(`input[name='company_id']`).val(company_id);
    bookingForm.find(`input[name='select_airport']`).val(filterEle.find('#select_airport').val());
    bookingForm.find(`input[name='dep_date']`).val(filterEle.find('#dep_date').val());
    bookingForm.find(`input[name='dep_time']`).val(filterEle.find('#dep_time').val());
    bookingForm.find(`input[name='return_date']`).val(filterEle.find('#return_date').val());
    bookingForm.find(`input[name='return_time']`).val(filterEle.find('#return_time').val());
    bookingForm.find(`input[name='discount_code']`).val(filterEle.find('#discount_code').val());
    bookingForm.find(`input[name='discount_amount']`).val(filterEle.find('#discount_amount').val());
    bookingForm.find(`input[name='discount_type']`).val(filterEle.find('#discount_type').val());
    bookingForm.find(`input[name='base_price']`).val(companyPrice);

    $("#company-list").hide();
    bookingForm.css('display', 'flex');
  });

  $(document).on('change', '.cancellation_cover', (e)=>{
    let totalBookingCharge = $("#booking-summary .total-charge").text().slice(8);
    let cancellation_charge = "{{ config('constant.BOOKING.CANCELLATION_CHARGE') }}";
    if(e.target.checked){
      let newTotalCharge = parseFloat(totalBookingCharge) + parseFloat(cancellation_charge);
      $("#booking-summary .total-charge").text(`TOTAL : ${newTotalCharge.toFixed(2)}`);
      $("#booking-summary .cancellation_cover_charge").text('CANCELLATION CHARGE : 2').show();
    }
    else{
      let newTotalCharge = parseFloat(totalBookingCharge) - parseFloat(cancellation_charge);
      $("#booking-summary .total-charge").text(`TOTAL : ${newTotalCharge.toFixed(2)}`);
      $("#booking-summary .cancellation_cover_charge").text('').hide();
    }
  })

  $(document).on('change', '.sms_confirmation', (e)=>{
    let totalBookingCharge = $("#booking-summary .total-charge").text().slice(8);
    let confirmattion_charge = "{{ config('constant.BOOKING.SMS_CONFIRMATION') }}";
    if(e.target.checked){
      let newTotalCharge = parseFloat(totalBookingCharge) + parseFloat(confirmattion_charge);
      $("#booking-summary .total-charge").text(`TOTAL : ${newTotalCharge.toFixed(2)}`);
      $("#booking-summary .sms_confirmation_charge").text('SMS CONFIRMATION CHARGE : 0.99').show();
    }
    else{
      let newTotalCharge = parseFloat(totalBookingCharge) - parseFloat(confirmattion_charge);
      $("#booking-summary .total-charge").text(`TOTAL : ${newTotalCharge.toFixed(2)}`);
      $("#booking-summary .sms_confirmation_charge").text('').hide();
    }
  });

  $(document).on('submit', '#booking_form', function(e) {
    e.preventDefault();

    let validationPass = true;
    let excludeElementValidation = ['discount_code', 'cancellation_cover', 'sms_confirmation', 'flight_number']
    let form = $(this);

    let getFinalPrice = $("#booking-summary .total-charge").text().slice(8);

    let formData = form.serialize();
    formData = formData +'&price='+getFinalPrice;

    console.log('formData:: ', formData, 'formDataArray:: ', form.serializeArray());

    let ajaxUrl = "{{ route('booking-store') }}"

    // get array of both
    let bookingFormArray = form.serializeArray();
    let combinedFormDataArray = bookingFormArray;


    combinedFormDataArray.forEach(element => {
      if($.inArray(element.name, excludeElementValidation) == -1){
        if(element.value == ''){
          form.find(`input[name="${element.name}"], select[name="${element.name}"]`).addClass('jqueryValidation');
          form.find(`input[name="${element.name}"], select[name="${element.name}"]`).siblings('.validationFail').show()
        }
        else{
          form.find(`input[name="${element.name}"], select[name="${element.name}"]`).removeClass('jqueryValidation');
          form.find(`input[name="${element.name}"], select[name="${element.name}"]`).siblings('.validationFail').hide()
        }
      }
    });

    combinedFormDataArray.forEach(element => {
      if($.inArray(element.name, excludeElementValidation) == -1){
        if(element.value == ''){
          validationPass = false;
          return;
        }
      }
    });

    if(!validationPass){
      console.log(`validationPass :: ${validationPass}`);
    }
    else{
      Swal.fire({
        title: "Terms and Conditions",
        html: "<div>Lorem ipsum dolor sit amet. Qui expedita iusto in dolore aspernatur ut Quis beatae. Vel blanditiis quis aut veniam ducimus ut eaque recusandae sed labore soluta sit soluta ducimus sit accusamus odio. Eos totam porro rem ratione quis sed magnam exercitationem. Sed dolorum incidunt aut expedita natus sit sint eaque et dolor obcaecati rem blanditiis nihil qui voluptatem dolorem.</div><br><div>Eum eligendi cumque est aspernatur quos id numquam velit. Et voluptatem quisquam eum consequatur enim qui placeat minus. Est recusandae aperiam et illum Quis sed ratione eius non saepe excepturi et amet excepturi est aliquid cupiditate.</div><br><div>Et quia eaque sed quis nihil qui cupiditate aperiam 33 perspiciatis nemo ex maxime voluptatum et nesciunt recusandae. Ut quidem dolorem ea beatae deleniti qui impedit sint.</div><br><div>Et sunt dolor qui sint inventore sed labore inventore qui dolorem reprehenderit. Ut atque facilis qui exercitationem distinctio ab sunt quasi aut saepe error est iusto saepe. Aut reprehenderit quia eos ipsum dicta et sint omnis ad quas dolor ut amet voluptas sit quas quos. In error accusantium sed placeat voluptatum et voluptatem voluptatem ut perferendis enim est vero autem et reiciendis nihil quo assumenda quia.</div><br><div>Hic aliquid consequatur et sint laborum in laudantium molestias? Et dignissimos sint aut itaque distinctio eos blanditiis dolore et suscipit voluptatem.</div>",
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Accept`,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
        width: '1024px'
      }).then((result) => {
        console.log('result:: ', result)
        if(result.isConfirmed){
          form.find('.submit-button').attr('disabled', true);
          $.ajax({
            type:"POST",
            url: ajaxUrl,
            data: formData,
            success: function(response){
              if(response.status_code == 200){
                toastr["success"](response.message);
                setTimeout(() => {
                  window.location.href = response.result.path;
                }, 1000);
              }
            },
            error: function(XHR, textStatus, errorThrown) {
              if(XHR.responseJSON.message != undefined){
                  toastr["error"](XHR.responseJSON.message);
              }else{
                  toastr["error"](errorThrown);
              }
            }
          });
        }
        else{
        }
      });
    }
  })

  $(document).on('change', '#discount_code', (e) => {
    e.preventDefault();
    let couponCode = $(e.target).val().trim();
    let airport_id = $("#select_airport").val().trim();
    if(!airport_id){
      $("#select_airport").siblings(".validationFail").show();
      $(e.target).val(null);
      return;
    }
    else{
      $("#select_airport").siblings(".validationFail").hide();
    }
    if(!couponCode){
      $(e.target).siblings(".isValid").text(null).hide();
      return;
    }
    let formData = {
      "coupon" : couponCode,
      "airport_id": airport_id
    }
    let ajaxUrl = "{{ route('validate-coupon-code') }}";
    $.ajax({
      type:"POST",
      url: ajaxUrl,
      data: formData,
      success: function(response){
        if(response.code == 200){
          $(e.target).siblings(".isValid").text(response.messsage).css('color', 'green').show();
          $(e.target).siblings("input#discount_amount").val(response.data.amount);
          $(e.target).siblings("input#discount_type").val(response.data.discount_type);
        }
        if(response.code == 203){
          $(e.target).siblings(".isValid").text(response.messsage).css('color', 'red').show();
          $(e.target).siblings("input#discount_amount").val(null);
          $(e.target).siblings("input#discount_type").val(null);
        }
      },
      error: function(XHR, textStatus, errorThrown) {
        if(XHR.responseJSON.message != undefined){
            toastr["error"](XHR.responseJSON.message);
        }else{
            toastr["error"](errorThrown);
        }
      }
    });
  });

  $(document).on('click', '.add-vehicle-button', async (e)=>{
    e.preventDefault();
    console.log(`start clonning`);
    let parentElement = $("#vehicle-details-row");
    let childrens = $(parentElement).children();
    let basePrice = $("#booking_form #booking_base_price").val();
    let getFinalPrice = $("#booking-summary .total-charge").text().slice(8);
    let extendedPrice = parseFloat(basePrice) + parseFloat(getFinalPrice);
    extendedPrice = extendedPrice.toFixed(2);

    let childrensId = [];
    $(childrens).map((index, ele)=>{
      let id = $(ele).attr('id');
      childrensId.push(parseInt(id));
    });
    let lastId = await getLargestNumberInArray(childrensId);
    console.log(`childrensId:: `, childrensId, 'lastId:: ', lastId);
    if(lastId == 0){
      $(parentElement).find(`#${lastId}`).addClass('vehicle-row');
    }
    let plusOne = 1;
    let id = lastId + plusOne;
    let html = `<div class="row vehicle-row" id="${id}">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_make">Vehicle Make</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle make" name="vehicle[${id}][vehicle_make]" id="vehicle_make">
                      <span class="validationFail">Please select vehicle make</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_model">Vehicle Model</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle model" name="vehicle[${id}][vehicle_model]" id="vehicle_model">
                      <span class="validationFail">Please select vehicle model</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_colour">Vehicle Colour</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle[${id}][vehicle_colour]" id="vehicle_colour">
                      <span class="validationFail">Please select vehicle colour</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="vehicle_reg">Vehicle Reg</label>
                      <input type="text" class="form-control" placeholder="Enter vehicle reg" name="vehicle[${id}][vehicle_reg]" id="vehicle_reg">
                      <span class="validationFail">Please select vehicle reg.</span>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="no_of_peopele">No of People</label>
                      <select class="form-control select2" style="width: 100%;" name="vehicle[${id}][no_of_peopele]" id="no_of_peopele">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>
                  </div>
                  <a href="javascript:void(0);" title="Remove Vehicle" class="remove-Vehicle-button" onclick="removeVehicle(event, ${id})"><i class="fa-solid fa fa-trash"></i></a>
                </div>`;
    $(parentElement).find(`#${lastId}`).addClass('border-bottom');
    $(parentElement).append(html);
    $("#booking-summary .total-charge").text(`TOTAL : ${extendedPrice}`);
  })
});
function getLargestNumberInArray(array){
  return new Promise((resolve, reject) => {
    var largest= 0;

    for (i=0; i<array.length; i++){
        if (array[i]>largest) {
            largest=array[i];
        }
    }
    resolve(largest);
  })
}
function removeVehicle(e, id){
  e.preventDefault();
  
  let basePrice = $("#booking_form #booking_base_price").val();
  let getFinalPrice = $("#booking-summary .total-charge").text().slice(8);
  let deductedPrice = parseFloat(getFinalPrice) - parseFloat(basePrice);
  deductedPrice = deductedPrice.toFixed(2);
  let mainParents = $(e.target).parents(`#vehicle-details-row`)
  $(e.target).parents(`#${id}`).remove();
  $("#booking-summary .total-charge").text(`TOTAL : ${deductedPrice}`);

  let mainParentsChilds = $(mainParents).children();
  if($(mainParentsChilds).length == 1){
    $(mainParentsChilds).removeClass('vehicle-row');
  }
  $(mainParentsChilds).last().removeClass('border-bottom')
  console.log('target:: ', $(e.target).parents(`#${id}`), 'mainParentchild', mainParentsChild.length);

}
</script>
@stop
