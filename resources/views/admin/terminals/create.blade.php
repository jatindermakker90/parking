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
               <a href ="{{ route('terminals.index') }}">
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
                <form method="POST" action="{{ route('terminals.store') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group {{ $errors->has('terminal_name ') ? 'has-error' : '' }}">
                    <label for="terminal_name ">Terminal Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Terminal Name" required="" name ="terminal_name" id ="terminal_name"  value ="{{ old('terminal_name ') }}">
                    @if($errors->first('terminal_name '))
                    <span class="form-error">{{$errors->first('terminal_name  ')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('airport_id') ? 'has-error' : '' }}">
                    <label for="airport_id">Airport Name</label>
                    <select class="form-control select2" style="width: 100%;" name ="airport_id" id ="airport_id" required>
                    @foreach($airports as $airport_key => $airport_value)
                    <option value ="{{ $airport_value->id }}">{{ $airport_value->airport_name }}</option>
                    @endforeach
                    </select>
                    @if($errors->first('airport_id'))
                    <span class="form-error">{{$errors->first('airport_id')}}</span>
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
    //console.log('heeloo');
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