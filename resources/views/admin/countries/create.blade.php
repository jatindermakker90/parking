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
               <a href ="{{ route('countries.index') }}">
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
                <div class="card-body col-sm-6">
                <form method="POST" action="{{ route('countries.store') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="country">Country</label>
                    <select class="form-control select2" style="width: 100%;" name ="country" id ="country">
                    @foreach($countries as $countries_key => $countries_value)
                    <option value ="{{ $countries_value->name->common }}">{{ $countries_value->name->common }}</option>
                    @endforeach
                    </select>
                    @if($errors->first('country'))
                    <span class="form-error">{{$errors->first('country')}}</span>
                    @endif
                  </div>  
                  <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="country_iso_code">Country Iso Code</label>
                    <input type="text" class="form-control"  placeholder="Enter Country Iso Code" required="" name ="country_iso_code" id ="country_iso_code" value ="{{ old('country_iso_code') }}">
                    @if($errors->first('country_iso_code'))
                    <span class="form-error">{{$errors->first('country_iso_code')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="country_code">Country Code</label>
                    <input type="text" class="form-control"  placeholder="Enter Country Code" required="" name ="country_code" id ="country_code" value ="{{ old('country_code') }}">
                    @if($errors->first('country_code'))
                    <span class="form-error">{{$errors->first('country_code')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="currency">Currency</label>
                    <input type="text" class="form-control"  placeholder="Enter Currency" required="" name ="currency" id ="currency"  value ="{{ old('currency') }}">
                    @if($errors->first('currency'))
                    <span class="form-error">{{$errors->first('currency')}}</span>
                    @endif
                  </div> 
                  <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="currency">Language Iso Code</label>
                    <input type="text" class="form-control"  placeholder="Enter Language Iso Code" required="" name ="language_iso_code" id ="language_iso_code" value ="{{ old('language_iso_code') }}">
                    @if($errors->first('language_iso_code'))
                    <span class="form-error">{{$errors->first('language_iso_code')}}</span>
                    @endif
                  </div>  
                  <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="currency">Language</label>
                    <input type="text" class="form-control"  placeholder="Enter Language" required="" name ="language" id ="language" value ="{{ old('language') }}">
                    @if($errors->first('language'))
                    <span class="form-error">{{$errors->first('language')}}</span>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
  setTimeout(function(){
    $('#country').trigger('change');
  },1000);
  $(document).on('change','#country',function(){
      var name    = $(this).val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $.get(href, function(response) {
         var response_data = response.result;
         console.log(response_data);
         $('#language_iso_code').val(response_data.language_iso_code);
         $('#country_iso_code').val(response_data.country_iso_code);
         $('#country_code').val(response_data.country_code);
         $('#currency').val(response_data.currency);
         $('#language').val(response_data.languages);
         $('#language_iso_code').val(response_data.language_iso_code);
      });
  });

});
</script>
@stop