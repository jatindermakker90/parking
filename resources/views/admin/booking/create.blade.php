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
      <div class="card-header">
        <h3 class="card-title">{{ $header }}</h3>
      </div>
      <div class="card-body">
        <div class="col-12">
        <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data">
          <div class="form-row">          
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="form-group {{ $errors->has('select_airport') ? 'has-error' : '' }} col-4">
              <label for="name">Select Airport</label>
               <select class="form-control select2" name ="select_airport" id ="select_airport">
                <option value=""></option>
                @foreach ($airports as $airport_key => $airport_value)
                  <option value="{{ $airport_value->id }}">{{ $airport_value->airport_name }}</option>
                @endforeach               
              </select>
              @if($errors->first('select_airport'))
              <span style="color:red;" class="form-error">Please select airport</span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('dep_date') ? 'has-error' : '' }} col-4">
              <label for="name">Departure Date</label>
               <input type="text" class="form-control" name ="dep_date">
              @if($errors->first('dep_date'))
              <span style="color:red;" class="form-error">Please enter departure date</span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('dep_time') ? 'has-error' : '' }} col-4">
              <label for="name">Departure Time</label>
                <select class="form-control" name="dep_time" id="dep_time">
                  <option value="00:00">00:00</option>
                  <option value="00:15">00:15</option>
                  <option value="00:30">00:30</option>
                  <option value="00:45">00:45</option>
                </select>
                @if($errors->first('dep_time'))
                  <span style="color:red;" class="form-error">Please enter departure time</span>
                @endif
            </div>
             
            <div class="form-group {{ $errors->has('return_date') ? 'has-error' : '' }} col-4">
              <label for="return_date">Arrival Date</label>
                <input type="text" class="form-control" name ="return_date">
                @if($errors->first('return_date'))
                  <span style="color:red;" class="form-error">Please enter arrival date</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('return_time') ? 'has-error' : '' }} col-4">
              <label for="return_time">Arrival Time</label>
              <select class="form-control last_option" name="return_time" id="return_time">
                <option value="00:00">00:00</option>
                <option value="00:15">00:15</option>
                <option value="00:30">00:30</option>
                <option value="00:45">00:45</option>
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
        <div class="row">  
          <div class="col-4" style="background-color: red;">
            Company search result area
          </div>
          <div class="col-4" style="background-color: black;">
            Company search result area  
          </div>
          <div class="col-4" style="background-color: blue;">
            Company search result area
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
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