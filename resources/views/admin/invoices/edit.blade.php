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
               <a href ="{{ route('products.index') }}">
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
                <form method="POST" action="{{ route('products.update',[$product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Product Name" required="" name ="name" id ="name" value ="{{ $product->name }}">
                    @if($errors->first('name'))
                    <span class="form-error">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('discpline_name') ? 'has-error' : '' }}">
                    <label for="discpline_name">Discpline Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Discpline Name" required="" name ="discpline_name" id ="discpline_name" value ="{{ $product->discpline_name }}">
                    @if($errors->first('discpline_name'))
                    <span class="form-error">{{$errors->first('discpline_name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                    <label for="group">Group</label>
                    <input type="text" class="form-control"  placeholder="Enter Group" required="" name ="group" id ="group"  value ="{{ $product->group }}">
                    @if($errors->first('group'))
                    <span class="form-error">{{$errors->first('group')}}</span>
                    @endif
                  </div> 
                  <div class="form-group {{ $errors->has('sub_group') ? 'has-error' : '' }}">
                    <label for="currency">Sub Group</label>
                    <input type="text" class="form-control"  placeholder="Enter Sub Group" required="" name ="sub_group" id ="sub_group" value ="{{ $product->sub_group }}">
                    @if($errors->first('sub_group'))
                    <span class="form-error">{{$errors->first('sub_group')}}</span>
                    @endif
                  </div>  
                  <div class="form-group {{ $errors->has('test_performed') ? 'has-error' : '' }}">
                    <label for="test_performed">Specified Test Performed</label>
                    <input type="text" class="form-control"  placeholder="Enter Specified Test Performed" required="" name ="test_performed" id ="test_performed" value ="{{ $product->test_performed }}">
                    @if($errors->first('test_performed'))
                    <span class="form-error">{{$errors->first('test_performed')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('test_method') ? 'has-error' : '' }}">
                    <label for="test_method">Test Method</label>
                    <input type="text" class="form-control"  placeholder="Enter Test Method" required="" name ="test_method" id ="test_performed" value ="{{ $product->test_method }}">
                    @if($errors->first('test_method'))
                    <span class="form-error">{{$errors->first('test_method')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('range_test_detection') ? 'has-error' : '' }}">
                    <label for="range_test_detection">Range of Testing/Limit of detection</label>
                    <input type="text" class="form-control"  placeholder="Enter Range of Testing/Limit of detection" required="" name ="range_test_detection" id ="range_test_detection" value ="{{ $product->range_test_detection }}">
                    @if($errors->first('range_test_detection'))
                    <span class="form-error">{{$errors->first('range_test_detection')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('mu_value') ? 'has-error' : '' }}">
                    <label for="mu_value">MU Value</label>
                    <input type="text" class="form-control"  placeholder="Enter MU Value" required="" name ="mu_value" id ="mu_value" value ="{{ $product->mu_value }}">
                    @if($errors->first('mu_value'))
                    <span class="form-error">{{$errors->first('mu_value')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('test_status') ? 'has-error' : '' }}">
                    <label for="test_status">Status</label>
                    <input type="text" class="form-control"  placeholder="Enter Test Status" required="" name ="test_status" id ="test_status" value ="{{ $product->test_status }}">
                    @if($errors->first('test_status'))
                    <span class="form-error">{{$errors->first('test_status')}}</span>
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