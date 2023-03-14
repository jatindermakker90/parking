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
  <div class="row">
  <!-- <div class="col-12"> -->
    @foreach($searchedCompanies as $searchedCompanies_key => $searchedCompanies_value)
      <div class="col-3">
        <div class="card">     
          <div class="card-header">
            <h3 class="card-title">{{ $searchedCompanies_value->company_title }}</h3>
          </div>
          <div class="card-body">
            
            
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary w-100">Book Now</button>        
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    @endforeach
    <!-- /.card -->
  <!-- </div> -->
  <!-- /.col -->
</div>
@endif
@stop
@section('css')

@stop
@section('js')
<!-- DataTables  & Plugins -->
<script type="text/javascript">
$(document).ready(function(){


});
</script>
@stop