@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dashboard</h3>
    <div class="card-tools">
    </div>
  </div>
</div>
@stop

@section('content')
<div class="row" id ="info_rows">
</div>
<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between">
      <div class="col-lg-3">
          <label for="country">Type</label>
           <select class="form-control" style="width: 100%;" id ="date_filter">
             @foreach(config('constant.DATE_FILTER') as $key =>  $value)
             <option value ="<?php echo $key; ?>"><?php echo $value; ?></option>
             @endforeach
          </select>
      </div>
    </div>
    <div class="card-tools">
    </div>
  </div>
</div>
<div class="row" id ="rides">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Invoice Chart</h3>
          <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm daterange_commission" title="Date range">
            <i class="far fa-calendar-alt"></i>
          </button>
          <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
        </div>
      </div>
      <div class="card-body">
        <div class="position-relative mb-4" id="commission_master">
          <canvas id="commission_chart" height="400"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
<script type="text/template" id="info_rows_template">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-default" >
      <div class="inner"  style="height: 180px;">
        <canvas id ="<%= id %>"  height="180px"></canvas>
      </div>
      <a  class="small-box-footer" style="height: 30px; color:black;"><%= title %></a>
    </div>
  </div>
</script>
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
@stop
@section('js')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/underscore@1.12.1/underscore-min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
  $('#info_rows').html('');
  var rows_temp     = $('#info_rows_template').html();
  var modified_temp = _.template(rows_temp);

/*  var rides_template  = $('#rides_template').html();
  var modified_rides_temp = _.template(rides_template);
*/
  $('.select2').select2();
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
  
  var mode = 'index'
  var intersect = true
 }); 
</script>
@stop