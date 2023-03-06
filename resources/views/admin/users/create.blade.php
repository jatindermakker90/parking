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
               <a href ="{{ route('users.index') }}">
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
              <div class="card-header" style="color:red;">
                  @if($errors->any())
                      {!! implode('', $errors->all('<div>:message</div>')) !!}
                  @endif
              </div>
              <div class="card-header">
                <h3 class="card-title">{{ $header }}</h3>
              </div>
              <div class="card-body row col-12">
                 <div class="col-sm-6">
                  <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Company Name" name ="company_name" id ="company_name" value ="{{ old('company_name')??''}}">
                    @if($errors->first('company_name'))
                    <span class="form-error">{{$errors->first('company_name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="country_iso_code">Email</label>
                    <input type="text" class="form-control"  placeholder="Enter Email" required="" name ="email" id ="email" value ="{{ old('email')??''}}">
                    @if($errors->first('email'))
                    <span class="form-error">{{$errors->first('email')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                    <label for="phone_number">Phone Number</label>
                     <input type="hidden" class="form-control" name ="country" id ="user_country">
                    <input type="text" class="form-control"  placeholder="Enter Phone Number" required="" name ="phone_number" id ="phone_number" value ="{{ old('phone_number')??''}}">
                    @if($errors->first('phone_number'))
                    <span class="form-error">{{$errors->first('phone_number')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('country_code') ? 'has-error' : '' }}">
                    <label for="country">Country</label>
                    <select class="form-control select2" style="width: 100%;" name ="country_code" id ="country">
                    @foreach($countries as $countries_key =>  $countries_value)
                       <option value ="<?php echo $countries_value->country_code; ?>"><?php echo "(+".$countries_value->country_code.") ".$countries_value->country  ?></option>
                     @endforeach
                    </select>
                    @if($errors->first('country_code'))
                    <span class="form-error">{{$errors->first('country_code')}}</span>
                    @endif  
                  </div> 
                  <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                    <label for="country">State</label>
                    <select class="form-control select2" style="width: 100%;" name ="state" id ="state">
                    </select>
                    @if($errors->first('state'))
                    <span class="form-error">{{$errors->first('state')}}</span>
                    @endif  
                  </div> 
                  <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                    <label for="street_address">City</label>
                    <input type="text" class="form-control"  placeholder="Enter City" required="" name ="city" id ="city" value ="{{ old('city')??''}}">
                    @if($errors->first('city'))
                    <span class="form-error">{{$errors->first('city')}}</span>
                    @endif
                  </div>
                 </div>
                 <div class="col-sm-6">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Person Name </label>
                    <input type="text" class="form-control"  placeholder="Enter Person Name" name ="name" id ="name" value ="{{ old('name')??''}}">
                    @if($errors->first('name'))
                    <span class="form-error">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('landline') ? 'has-error' : '' }}">
                    <label for="name">Landline Number </label>
                    <input type="text" class="form-control"  placeholder="Enter Landline Number" name ="landline" id ="landline" value ="{{ old('landline')??''}}">
                    @if($errors->first('landline'))
                    <span class="form-error">{{$errors->first('landline')}}</span>
                    @endif
                  </div>   
                  <div class="form-group {{ $errors->has('pan_number') ? 'has-error' : '' }}">
                    <label for="pan_number">Pan No.</label>
                    <input type="text" class="form-control"  placeholder="Enter Pan number" required="" name ="pan_number" id ="pan_number" value ="{{ old('pan_number')??''}}">
                    @if($errors->first('pan_number'))
                    <span class="form-error">{{$errors->first('pan_number')}}</span>
                    @endif
                  </div> 
                  <div class="form-group {{ $errors->has('gst_number') ? 'has-error' : '' }}">
                    <label for="gstin">GST number</label>
                    <input type="text" class="form-control"  placeholder="Enter GST number" required="" name ="gst_number" id ="gstin" value ="{{ old('gst_number')??''}}">
                    @if($errors->first('gst_number'))
                    <span class="form-error">{{$errors->first('gst_number')}}</span>
                    @endif
                  </div> 
                  <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
                    <label for="street_address">Company Address</label>
                    <input type="text" class="form-control"  placeholder="Enter Company Address" required="" name ="street_address" id ="street_address" value ="{{ old('street_address')??''}}">
                    @if($errors->first('street_address'))
                    <span class="form-error">Please enter company address</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" class="form-control"  placeholder="Enter Zipcode" required="" name ="zipcode" id ="zipcode" value ="{{ old('zipcode')??''}}">
                    @if($errors->first('zipcode'))
                    <span class="form-error">{{$errors->first('zipcode')}}</span>
                    @endif
                  </div>
                 </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id ="submitButton" style="text-align:left;">Submit</button>
                </div>
              </form>
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
  $('.select2').select2();
  getStateDetails();
  $(document).on('change','#country',function(){

      var name    = $(this).val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $.get(href, function(response) {
         var response_data = response.result;
         console.log("=== issue =======",response_data);
         $('#state').html('');
         $.each(response_data.states, function (index, value) {
            $('#state').append($('<option/>', { 
                value: value,
                text : value 
            }));
         });
         $('#user_country').val(response_data.country_iso_code);
      });
  });

  function getStateDetails(){
      var name    = $('#country').val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $('#state').html('');
      $.get(href, function(response) {
         var response_data = response.result;
         console.log("=== issue =======",response_data);
         $.each(response_data.states, function (index, value) {
            $('#state').append($('<option/>', { 
                value: value,
                text : value 
            }));
         }); 
         $('#user_country').val(response_data.country_iso_code);
        /* $('#language_iso_code').val(response_data.language_iso_code);
         $('#country_iso_code').val(response_data.country_iso_code);
         $('#country_code').val(response_data.country_code);
         $('#currency').val(response_data.currency);
         $('#language').val(response_data.languages);
         $('#language_iso_code').val(response_data.language_iso_code);*/
      });
  }


});
</script>
@stop