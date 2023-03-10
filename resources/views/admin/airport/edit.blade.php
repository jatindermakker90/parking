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
               <a href ="{{ route('airport.index') }}">
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
                <form method="POST" action="{{ route('airport.update',[$airport->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="airport_id" value="{{ $airport->id }}">
                    <div class="form-group {{ $errors->has('airport_name') ? 'has-error' : '' }}">
                    <label for="airport_name">Airport Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Airport Name" required="" name ="airport_name" id ="airport_name"  value ="{{ $airport->airport_name ?? old('airport_name') }}">
                    @if($errors->first('airport_name'))
                    <span class="form-error">{{$errors->first('airport_name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('operating_location') ? 'has-error' : '' }}">
                    <label for="airport_name">Operating Location</label>
                    <input type="text" class="form-control"  placeholder="Enter Operating Location" required="" name ="operating_location" id ="operating_location"  value ="{{ $airport->operating_location ?? old('operating_location') }}">
                    @if($errors->first('operating_location'))
                    <span class="form-error">{{$errors->first('operating_location')}}</span>
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
  
  $(document).on('change','#country',function(){

      var name    = $(this).val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $.get(href, function(response) {
         var response_data = response.result;
         //console.log(response_data);
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