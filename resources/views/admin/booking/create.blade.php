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
              <div class="card-header" style="color:red;">
                  @if($errors->any())
                      {!! implode('', $errors->all('<div>:message</div>')) !!}
                  @endif
              </div>
              <div class="card-header">
                <h3 class="card-title">{{ $header }}</h3>
              </div>
              <div class="card-body">
                <div class="card-body col-sm-6">
                <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" id="product_data" name="product_data" value="{{ $product_list }}">
                  <div class="form-group {{ $errors->has('po_number') ? 'has-error' : '' }}">
                    <label for="name">PO Number</label>
                     <input type="text" class="form-control" style="width: 100%;" name ="po_number" id ="po_number" placeholder="Enter PO Number">
                    @if($errors->first('po_number'))
                    <span class="form-error">Please enter po number</span>
                    @endif
                  </div>
                   <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                    <label for="name">Company Name</label>
                     <select class="form-control select2" style="width: 100%;" name ="user_id" id ="user_id">
                     @foreach($company as $company_key =>  $company_value)
                       <option value ="<?php echo $company_value->id; ?>"><?php echo $company_value->company_name ?? $company_value->name  ?></option>
                     @endforeach
                    </select>
                    @if($errors->first('user_id'))
                    <span class="form-error">Please select company</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('products_id') ? 'has-error' : '' }}">
                    <label for="name">Product Name</label>
                     <select class="form-control select2" style="width: 100%;" name ="products_id" id ="products_id">
                     @foreach($products as $products_key =>  $products_value)
                       <option value ="<?php echo $products_value->id; ?>"><?php echo  $products_value->name  ?></option>
                     @endforeach
                    </select>
                    @if($errors->first('products_id'))
                    <span class="form-error">{{$errors->first('products_id')}}</span>
                    @endif
                  </div>
                 
                  <div class="form-group {{ $errors->has('test_parameter') ? 'has-error' : '' }}">
                    <label for="test_parameter">Test Parameter</label>
                    <select class="form-control select2" style="width: 100%;" name ="test_parameter[]" id ="test_parameter" multiple required="">
                    </select>
                    @if($errors->first('test_parameter'))
                    <span class="form-error">{{$errors->first('test_parameter')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('test_method') ? 'has-error' : '' }}">
                    <label for="test_method">Test Method</label>
                    <select class="form-control select2" style="width:100%;" name ="test_method[]" id ="test_method" multiple required="">
                    </select>
                    @if($errors->first('test_method'))
                    <span class="form-error">{{$errors->first('test_method')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('test_cost') ? 'has-error' : '' }}" id ="main_section_html" >
                   
                  </div>
                  <div class="form-group {{ $errors->has('test_cost') ? 'has-error' : '' }}">
                    <label for="test_cost">Total Test Cost</label>
                    <input type="text" class="form-control"  placeholder="Enter Test Cost" required="" name ="test_cost" id ="test_cost" value ="{{ old('test_cost')??'1000' }}">
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
  let products = JSON.parse($('#product_data').val());
  let product_name = null;
  let  test_cost= [];
  getProductList();
 // console.log(" === products ===",products);
  $(document).on('change','#country',function(){
      var name    = $(this).val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $.get(href, function(response) {
         var response_data = response.result;
      });
  });
  
  $(document).on('change','#products_id',function(){
      var products_id    = $(this).val();
      var name            =  getProductName(products_id);
      var href    = "{{ url('admin/fetch/product/details') }}"+"?products_id="+products_id+"&name="+name;
      getProductList();
  });
  $(document).on('change','#test_parameter',function(){
      var test_method_values    = $(this).val();
      getProductCost();
      console.log("test_cost",test_cost);
  });
  
  function getProductList(){
      $('#test_parameter').html('');
      $('#test_method').html('');
      $('#main_section_html').html('');
      $('#test_cost').val(0);
      var products_id     = $('#products_id').val();
      selected_params     = [];
      selected_method     = [];
      var name            =  getProductName(products_id);
      var href    = "{{ url('admin/fetch/product/details') }}"+"?products_id="+products_id+"&name="+name;
      $.get(href, function(response) {
        var response_data = response.result;
        products = response_data.products;
        console.log('getProductList',response_data);
        $.each(response_data.products, function (index, value) {
          let curent_tp = value.test_parameter.trim();
          let curent_tm = value.test_method.trim();
         // selected_method.push(curent_tm);
          $('#test_parameter').append('<option value ="'+value.test_parameter+'" '+(selected_params.includes(curent_tp) ? "selected" : selected_params.indexOf(curent_tp))+'>'+value.test_parameter+'</option>');
          $('#test_method').append('<option value ="'+value.test_method+'" '+(selected_method.includes(curent_tm) ? "selected" : selected_method.indexOf(curent_tm))+'>'+value.test_method+'</option>');
        });
      });
  }
  function getProductName(products_id){
         product_name = null;
         $.each(products, function (index, value) {
            if(value.id == products_id){
              product_name =  value.name;
            }
         });
        return product_name;
  }
  function getProductCost(){
    let selected_method  = [];
    test_cost = [];
    test_parameter = $('#test_parameter').val();
    if(test_parameter.length){
      $('#main_section_html').html("");
      let cost_html = "<label>Product Test Cost</label><div style='border: 2px solid;padding: 15px;'><br/>";
      $('#test_cost').val(0);
      $.each(test_parameter, function (product_index,product_value){
          $.each(products, function (index, value) {
              if(value.test_parameter == product_value){
                 test_cost.push(value);
                let curent_tm = value.test_method.trim();
                selected_method.push(curent_tm);
                 cost_html += '<label for="test_cost">'+value.test_parameter+' Cost</label>';
                 cost_html += '<input type="text" class="form-control product_class"  placeholder="Enter '+value.test_parameter+' cost" required="" name ="products_'+value.id+'" id ="products_'+value.id+'" value ="'+value.test_cost+'">';
                 $('#main_section_html').html(cost_html);
                 let cost = parseFloat($('#test_cost').val()) + parseFloat(value.test_cost);
                 console.log( " =========== cost =======",cost);
                 $('#test_cost').val(cost);
              }
          });
      });
      cost_html += '</div>';
    }else{
      $('#main_section_html').html("");
    }
    console.log("new selected method",selected_method);
    $('#test_method').val([]).trigger('change');
    $('#test_method').val(selected_method).trigger('change');
    calculateCost();
  }
  $(document).on('input','.product_class',function(){
     $(this).val($(this).val().replace(/[^0-9]./g, ''));
    calculateCost();
  });
  function calculateCost(){
    let cost = 0;
        $.each(test_cost, function (index, value) {
               if(!$('#products_'+value.id).val()){
               cost += parseFloat(0);
               }else{
               cost += parseFloat($('#products_'+value.id).val());
               }
        });
    $('#test_cost').val(cost);
  }
  

});
</script>
@stop