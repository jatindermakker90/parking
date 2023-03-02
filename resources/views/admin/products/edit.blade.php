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
                  <div class="form-group {{ $errors->has('test_parameter') ? 'has-error' : '' }}">
                    <label for="test_parameter">Test Parameter</label>
                      <input type="text" class="form-control"  placeholder="Enter Test Parameter" required="" name ="test_parameter" id ="test_parameter" value ="{{ old('test_parameter') ?? $product->test_parameter}}">
                    @if($errors->first('test_parameter'))
                    <span class="form-error">{{$errors->first('test_parameter')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('test_method') ? 'has-error' : '' }}">
                    <label for="test_method">Test Method</label>
                    <input type="text" class="form-control"  placeholder="Enter Test Method" required="" name ="test_method" id ="test_performed" value ="{{ old('test_method') ?? $product->test_method}}">
                    @if($errors->first('test_method'))
                    <span class="form-error">{{$errors->first('test_method')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('test_cost') ? 'has-error' : '' }}">
                    <label for="test_method">Test Cost</label>
                    <input type="text" class="form-control"  placeholder="Enter Test Cost" required="" name ="test_cost" id ="test_cost" value ="{{ old('test_cost')?? $product->test_cost}}">
                    @if($errors->first('test_cost'))
                    <span class="form-error">{{$errors->first('test_cost')}}</span>
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