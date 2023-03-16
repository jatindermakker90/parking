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
      <form method="POST" action="{{ route('search-booking-companies') }}" enctype="multipart/form-data">
      @csrf     
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
                @if($errors->first('select_airport'))
                <span style="color:red;" class="form-error">Please select airport</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('dep_date') ? 'has-error' : '' }} col-4">
                <label for="name">Departure Date</label>
                <input type="date" class="form-control" name ="dep_date" placeholder="Select departure date">
                @if($errors->first('dep_date'))
                <span style="color:red;" class="form-error">Please enter departure date</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('dep_time') ? 'has-error' : '' }} col-4">
                <label for="name">Departure Time</label>
                  <select class="form-control" name="dep_time" id="dep_time">
                    <option value="">Select time</option>
                    @foreach(config('constant.TIME_INTERVAL') as $time_key => $time_value)
                      <option value="{{$time_value}}">{{$time_value}}</option>
                    @endforeach
                  </select>
                  @if($errors->first('dep_time'))
                    <span style="color:red;" class="form-error">Please enter departure time</span>
                  @endif
              </div>
              
              <div class="form-group {{ $errors->has('return_date') ? 'has-error' : '' }} col-4">
                <label for="return_date">Arrival Date</label>
                  <input type="date" class="form-control" name ="return_date">
                  @if($errors->first('return_date'))
                    <span style="color:red;" class="form-error">Please enter arrival date</span>
                  @endif
              </div>

              <div class="form-group {{ $errors->has('return_time') ? 'has-error' : '' }} col-4">
                <label for="return_time">Arrival Time</label>
                <select class="form-control last_option" name="return_time" id="return_time">
                  <option value="">Select time</option>
                  @foreach(config('constant.TIME_INTERVAL') as $time_key => $time_value)
                    <option value="{{$time_value}}">{{$time_value}}</option>
                  @endforeach
                </select>
                @if($errors->first('return_time'))
                  <span style="color:red;" class="form-error">Please enter arrival time</span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('discount_code') ? 'has-error' : '' }} col-4">
                <label for="discount_code">Discount Code</label>
                <input type="text" class="form-control"  placeholder="Enter Test Cost" name ="discount_code" id ="discount_code">           
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
      <div class="col-3">
        <div class="card">     
          <div class="card-header text-center">
            <div>
                <p class="m-0 text-success"><i class="fas fa-window-close mr-1"></i>Cancellation Cover Available</p>
                <h6 class="font-weight-bold">{{ $searchedCompanies_value->company_title }}</h6>
                <p>{{$searchedCompanies_value->company_types[0]->name}}</p>
              </div>
            <!-- <h3 class="card-title">{{ $searchedCompanies_value->company_title }}</h3> -->
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
          <!-- /.card-body -->
        </div>
      </div>
    @endforeach
    <!-- /.card -->
  </div>
@endif
  <div class="row" id="booking-form">
      <div class="col-8">
        <div class="card">
          <form action="" method="post">
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
                    <input type="text" class="form-control" placeholder="Enter title" name="title" id="title">
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name" id="first_name">
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" placeholder="Enter last name" name="last_name" id="last_name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" id="email">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="number" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile">
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
                        <input type="checkbox" name="is_levy_charge" value="1">
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
                        <input type="checkbox" name="is_levy_charge" value="1">
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
             </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary w-100">Submit</button>        
            </div>
          </form>     
          <!-- /.card-body -->
        </div>
      </div>
    <!-- /.card -->
      <div class="col-4">
        <div class="card">
          <div class="card-header text-center">
            <h3 class="card-title">Your Booking Summary</h3>
          </div>
          <div class="card-body">
            <div>
            
            </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary w-100">Submit</button>        
          </div>  
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
</style>
@stop
@section('js')
<!-- DataTables  & Plugins -->
 
<script type="text/javascript">
$(document).ready(function(){
   window.onload = function() {
    history.replaceState("", "", '{{ route("search-booking-companies-get") }}');
  }

  $(document).on('click','.book-now',function(){
      var company_id    = $(this).data('id');
      console.log(`company_id:: ${company_id}`);
      $("#company-list").hide();
      $("#booking-form").css('display', 'flex');
      // var href    = "{{ url('admin/fetch/terminal/details') }}"+"?airport_id="+airport_id;
      // $.get(href, function(response) {
      //     $('#terminal_id').html('<option value="">Select terminal</option>');
      //     var response_data = response.result;
      //     $.each(response_data.terminal, function (index, value) {
      //       $('#terminal_id').append('<option value ="'+value.id+ '">'+value.terminal_name+'</option>');
      //     });
      // });
  });

});
</script>
@stop