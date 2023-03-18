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
                <input type="date" class="form-control" name ="dep_date" placeholder="Select departure date" id="dep_date" value="<?php echo (isset($request) && $request['dep_date'])  ? $request['dep_date'] : '' ?>">
                <span class="validationFail">Please select departure date</span>
                @if($errors->first('dep_date'))
                <span style="color:red;" class="form-error">Please enter departure date</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('dep_time') ? 'has-error' : '' }} col-4">
                <label for="name">Departure Time</label>
                  <select class="form-control" name="dep_time" id="dep_time">
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
                  <input type="date" class="form-control" name ="return_date" id="return_date" value="<?php echo (isset($request) && $request['return_date'])  ? $request['return_date'] : '' ?>">
                  <span class="validationFail">Please select arrival date</span>
                  @if($errors->first('return_date'))
                    <span style="color:red;" class="form-error">Please enter arrival date</span>
                  @endif
              </div>

              <div class="form-group {{ $errors->has('return_time') ? 'has-error' : '' }} col-4">
                <label for="return_time">Arrival Time</label>
                <select class="form-control last_option" name="return_time" id="return_time">
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
                <span class="validationFail">Please select discount code</span>
              </div>                 
            </div>            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Search Now</button>        
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
              <p>{{$searchedCompanies_value->company_types[0]->name}}</p>
            </div>
          </div>
          <div class="card-body">
            <div>
              <img class="booking-company-logo" src="{{ asset('assets/images/abstract-logo-company-made-with-color_341269-925.jpg') }}" alt="" srcset="">
              @if(!empty($searchedCompanies_value->service_types) && $searchedCompanies_value->service_types->count() > 0 )
                <ul>
                  @foreach($searchedCompanies_value->service_types as $serviceTypeKey => $serviceTypeValue)
                    <li>{{$serviceTypeValue->name}}</li>
                  @endforeach
                </ul>
              @endif
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
                    <label for="mobile">Mobile Number</label>
                    <input type="number" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile">
                    <span class="validationFail">Please select mobile</span>
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
                        <input type="checkbox" name="cancellation_cover">
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
                        <input type="checkbox" name="sms_confirmation">
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
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <label for="vehicle_make">Vehicle Make</label>
                    <input type="text" class="form-control" placeholder="Enter vehicle make" name="vehicle_make" id="vehicle_make">
                    <span class="validationFail">Please select vehicle make</span>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="vehicle_model">Vehicle Model</label>
                    <input type="text" class="form-control" placeholder="Enter vehicle model" name="vehicle_model" id="vehicle_model">
                    <span class="validationFail">Please select vehicle model</span>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="vehicle_colour">Vehicle Colour</label>
                    <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle_colour" id="vehicle_colour">
                    <span class="validationFail">Please select vehicle colour</span>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="vehicle_reg">Vehicle Reg #</label>
                    <input type="text" class="form-control" placeholder="Enter vehicle reg" name="vehicle_reg" id="vehicle_reg">
                    <span class="validationFail">Please select vehicle reg.</span>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="no_of_peopele">No of People</label>
                    <select class="form-control select2" style="width: 100%;" name="no_of_peopele" id="no_of_peopele">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </div>
              </div>
              <div>
                <h3 class="mt-5 mb-4">Flight Information (Optional)</h3>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="drop_off_terminal">Drop-off Terminal</label>
                    <select class="form-control select2" style="width: 100%;" name="drop_off_terminal" id="drop_off_terminal">
                      <option value="tbc">TBC</option>
                      <option value="main_terminal">Main Terminal</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="return_terminal">Return Terminal</label>
                    <select class="form-control select2" style="width: 100%;" name="return_terminal" id="return_terminal">
                      <option value="tbc">TBC</option>
                      <option value="main_terminal">Main Terminal</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="vehicle_colour">Vehicle Colour</label>
                    <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle_colour" id="vehicle_colour">
                    <span class="validationFail">Please select vehicle colour</span>
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
                <hr>
                <h6 class="total-charge font-weight-bold"></h6>
              </div>
            </div>
          </div>
          <!-- <div class="card-footer">
            <button type="button" class="btn btn-primary w-100">Submit</button>        
          </div>   -->
          <!-- /.card-body -->
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
</style>
@stop
@section('js')
<!-- DataTables  & Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function(){
   window.onload = function() {
    history.replaceState("", "", '{{ route("search-booking-companies-get") }}');
  }

  $(document).on('click','.book-now',function(){
      var company_id    = $(this).data('id');
      let filterEle = $("#filter-form");
      
      let airport = filterEle.find("#select_airport option:selected").text();

      let dropOffDate = filterEle.find("#dep_date").val();
      let dropOffTime = filterEle.find("#dep_time").val();

      let returnDate = filterEle.find("#return_date").val();
      let returnfTime = filterEle.find("#return_time").val();

      let companyTab = $(this).parents('.card');

      let imageUrl = companyTab.find('img').attr('src');
      let companyTitle = companyTab.find('.card-header .company-title').text();

      console.log('companyTitle:: ', companyTitle, 'dropOffDate', dropOffDate)
      
      let bookingForm = $("#booking-form");
      let bookingSummaryEle = $("#booking-summary");
      bookingSummaryEle.find(".booking-company-logo").attr('src', imageUrl);
      bookingSummaryEle.find(".company-title").text(companyTitle);
      bookingSummaryEle.find(".drop-off").text(`DROP OFF : ${dropOffDate} at ${dropOffTime}`);
      bookingSummaryEle.find(".pick-up").text(`PICK UP : ${returnDate} at ${returnfTime}`);
      bookingSummaryEle.find(".airport").text(`AIRPORT : ${airport}`);

      bookingSummaryEle.find(".booking-charge").text('BOOKING CHARGE : 1.95');
      bookingSummaryEle.find(".total-charge").text('TOTAL : 94.49');

      bookingForm.find(`input[name='company_id']`).val(company_id);
      $("#company-list").hide();
      bookingForm.css('display', 'flex');

  });

  $(document).on('submit', '#booking_form', function(e) {
    e.preventDefault();
    let validationPass = true; 
    let form = $(this);
    form.find('.submit-button').attr('disabled', true)
    let filterForm = $("#filter-form")

    let filterFormData = filterForm.serialize();
    let formData = form.serialize();
    
    let ajaxUrl = "{{ route('booking-store') }}"
    let combineFormData = filterFormData + '&'+ formData;

    // get array of both 
    let filterFormDataArray = filterForm.serializeArray();
    let bookingFormArray = form.serializeArray();
    let combinedFormDataArray = filterFormDataArray.concat(bookingFormArray);

    console.log('combinedFormDataArray:: ', combinedFormDataArray);

    combinedFormDataArray.forEach(element => {
      if(element.value == ''){
        $(`input[name='${element.name}'], select[name='${element.name}']`).addClass('jqueryValidation');
        $(`input[name='${element.name}'], select[name='${element.name}']`).siblings('.validationFail').show()
      }
      else{
        $(`input[name='${element.name}'], select[name='${element.name}']`).removeClass('jqueryValidation');
        $(`input[name='${element.name}'], select[name='${element.name}']`).siblings('.validationFail').hide()
      }
    });

    combinedFormDataArray.forEach(element => {
      if(element.value == ''){
        validationPass = false;
        return;
      }
    });

    if(!validationPass){
      console.log(`validationPass :: ${validationPass}`);
    }
    else{
      $.ajax({
        type:"POST",
        url: ajaxUrl,
        data: combineFormData,
        success: function(response){
          console.log(`form submited`, response);
          if(response.status_code == 200){
            toastr["success"](response.message);
            setTimeout(() => {
              window.location.href = response.result.path;
            }, 1000);
          }
        },
        error: function(XHR, textStatus, errorThrown) {
          // console.log(XHR.responseJSON.message);
          if(XHR.responseJSON.message != undefined){
              toastr["error"](XHR.responseJSON.message);  
          }else{
              toastr["error"](errorThrown);  
          }
        }
      });
    }




  })

});
</script>
@stop