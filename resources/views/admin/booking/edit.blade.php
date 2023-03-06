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
                <form method="POST" action="{{ route('bookings.update',[$booking->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                      <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" id="product_data" name="product_data" value="{{ $product_list }}">
                      <input type="hidden" id="mapping_data" name="mapping_data" value="{{ $booking_mapping }}">
                      <input type="hidden" id="booking" name="booking" value="{{ $booking }}">
                    <div class="form-group {{ $errors->has('po_number') ? 'has-error' : '' }}">
                      <label for="name">PO Number</label>
                       <input type="text" class="form-control" style="width: 100%;" name ="po_number" id ="po_number" placeholder="Enter PO Number" value="{{ $booking->po_number }}">
                      @if($errors->first('po_number'))
                      <span class="form-error">Please enter po number</span>
                      @endif
                    </div>
                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                     <label for="name">Company Name</label>
                     <select class="form-control select2" style="width: 100%;" name ="user_id" id ="user_id">
                     @foreach($company as $company_key =>  $company_value)
                       <option value ="<?php echo $company_value->id; ?>" <?php $company_value->id == $booking->user_id ? 'selected' : ''?>><?php echo $company_value->company_name ?? $company_value->name  ?></option>
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
                       <option value ="<?php echo $products_value->id; ?>" <?php $products_value->id == $booking->products_id ? 'selected' : ''?>><?php echo  $products_value->name  ?></option>
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
                    <label for="test_method">Test Cost</label>
                    <input type="text" class="form-control"  placeholder="Enter Test Cost" required="" name ="test_cost" id ="test_cost" value ="{{ old('test_cost')?? $booking->test_cost}}">
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
 
  let products = JSON.parse($('#product_data').val());
  let mapping_data = JSON.parse($('#mapping_data').val());
  let booking_data = JSON.parse($('#booking').val());
  let selected_params = booking_data.test_parameter.split(" , ");
  let selected_method = booking_data.test_method.split(" , ");
console.log("booking_data",booking_data);
  let product_name = null;
  let  test_cost= [];
  getInitProductList();
  getInitProductCost();


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
  function getInitProductList(){
      var products_id     = $('#products_id').val();
      var name            =  getProductName(products_id);
      let cost_data       = [];
      let mt_data       = [];
      var href    = "{{ url('admin/fetch/product/details') }}"+"?products_id="+products_id+"&name="+name;
      $.get(href, function(response) {
        var response_data = response.result;
        products = response_data.products;
        console.log('getProductList mapping_data',mapping_data);
        $.each(response_data.products, function (index, value) {
          let curent_tp = value.test_parameter.trim();
          let curent_tm = value.test_method.trim();
          $('#test_parameter').append('<option value ="'+value.test_parameter+'" '+(selected_params.includes(curent_tp) ? "selected" : selected_params.indexOf(curent_tp))+'>'+value.test_parameter+'</option>');
          $('#test_method').append('<option value ="'+value.test_method+'" '+(selected_method.includes(curent_tm) ? "selected" : selected_method.indexOf(curent_tm))+'>'+value.test_method+'</option>');
        });
      });

      $('.select2').select2();
     
  }
  function getInitProductCost(){
    test_cost = [];
    test_parameter = $('#test_parameter').val();
    console.log(" ========== value =======",test_parameter);
    if(mapping_data.length){
      $('#main_section_html').html("");
      let cost_html = "<label>Product Test Cost</label><div style='border: 2px solid;padding: 15px;'><br/>";
      $('#test_cost').val(0);
      let cost = 0;
      $.each(mapping_data, function (product_index,product_value){
                 cost_html += '<label for="test_cost">'+product_value.test_parameter+' Cost</label>';
                 cost_html += '<input type="text" class="form-control product_class"  placeholder="Enter '+product_value.test_parameter+' cost" name ="products_'+product_value.products_id+'" id ="products_'+product_value.products_id+'" value ="'+product_value.test_cost+'">';
                 $('#main_section_html').html(cost_html);
                 test_cost.push({"id":product_value.products_id});
                 cost = parseFloat($('#test_cost').val()) + parseFloat(product_value.test_cost);
                 console.log( " =========== cost =======",cost);
                 $('#test_cost').val(cost);
      });
      cost_html += '</div>';
    }else{
      $('#main_section_html').html("");
    }
    if(booking_data)
    $("#test_cost").val(booking_data.test_cost);
   // calculateCost();
  }
  function getProductList(){
      $('#test_parameter').html('');
      $('#main_section_html').html('');
      $('#test_method').html('');
      $('#test_cost').val(0);
      var products_id     = $('#products_id').val();
      var name            =  getProductName(products_id);
      var href    = "{{ url('admin/fetch/product/details') }}"+"?products_id="+products_id+"&name="+name;
      $.get(href, function(response) {
        var response_data = response.result;
        products = response_data.products;
       // console.log('getProductList',response_data);
        $.each(response_data.products, function (index, value) {

          $('#test_parameter').append($('<option/>', { 
                value: value.test_parameter,
                text : value.test_parameter 
          }));
          $('#test_method').append($('<option/>', { 
                value: value.test_method,
                text : value.test_method 
          }));
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
    test_cost = [];
    let selected_method = [];
    test_parameter = $('#test_parameter').val();
    console.log(" ========== value =======",test_parameter);
    if(test_parameter.length){
      $('#main_section_html').html("");
      let cost_html = "<label>Product Test Cost</label><div style='border: 2px solid;padding: 15px;'><br/>";
      $('#test_cost').val(0);
      $.each(test_parameter, function (product_index,product_value){
          $.each(products, function (index, value) {
              if(value.test_parameter == product_value){
                 let curent_tm = value.test_method.trim();
                 test_cost.push(value);
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
    let cost = 0;
     $(this).val($(this).val().replace(/[^0-9]./g, ''));
  /*  let test_cost = [];
    $(".product_class").each(function() {
        test_cost.push($(this).val());
    });*/
    calculateCost();
  });
  function calculateCost(){
    console.log("calculateCost",test_cost);
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