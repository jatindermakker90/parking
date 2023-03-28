@extends('adminlte::page')
@section('title', config('adminlte.title'))
@section('content_header')
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Search:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id ="search_text"><i class="fa fa-search"></i></span>
                      </div>
                      <input type="text" class="form-control float-right" placeholder="Type your keywords here" id ="search">
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="search_select_airport">Airport:</label>
                    <select class="form-control select2" name ="search_select_airport" id ="search_select_airport">
                    <option value="">All</option>
                    @foreach ($airports as $airport_key => $airport_value)
                      <option value="{{ $airport_value->id }}">{{ $airport_value->airport_name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="search_select_company">Company:</label>
                    <select class="form-control select2" name ="search_select_company" id ="search_select_company">
                    <option value="">All</option>
                    @foreach ($companies ?? '' as $company_key => $company_value)
                      <option value="{{ $company_value->id }}">{{ $company_value->company_title }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <label for="search_type">Type:</label>
                    <select class="form-control select2" name ="search_type" id ="search_type">
                    <option value="">All</option>
                    <option value="">Booking Date</option>
                    <option value="">Departure Date</option>
                    <option value="">Arrival Date</option>
                </select>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <label for="search_booking_status">Status:</label>
                    <select class="form-control select2" name ="search_booking_status" id ="search_booking_status">
                      <option value="">Status</option>
                      @foreach(config('constant.BOOKING_STATUS') as $status_key => $status_value)
                        <option value="{{$status_value}}">{{$status_key}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                  <label>From/To:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservationtime" placeholder="Please select date range">
                  </div>
                  <!-- /.input group -->
                </div>
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
      <!-- /.card-header -->
      <div class="card-body">
        <table id="data_collection" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Ref No.</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Date Added</th>
            <th>Dep Date/Time</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>

@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
  .jqueryValidation{
    border: 1px solid red !important;
  }
  .validationFail{
    color: red;
    display: none;
  }
  .tab-pane{
    padding-top: 30px;
    padding-bottom: 30px;
  }
</style>

@stop
@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
function closeStatusModel(){
  $("#change_status_modal").modal('show');
}
$(document).ready(function(){
    $('.select2').select2();
    let changeStatusModel = $('#change_status_modal').modal({
      keyboard: false
    })
    var today = new Date();
    var time   = $('#reservationtime').val();
    var start_time = null;
    var end_time   = null;
    var search = null;
    var selected_airport = null;
    var selected_company = null;
    var booking_status = null;

    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = mm + '/' + dd + '/' + yyyy;
    searchData();

  $('#reservationtime').daterangepicker({
       timePicker: false,
       autoUpdateInput: false,
       locale: {
        format: 'MM/DD/YYYY',
        cancelLabel: 'Clear'
      }
  },function(start, end) {
      console.log("Start time",start.format('Y-M-D'));
       console.log("end time",end.format('Y-M-D'));
       start_time = `${start.format('Y-M-D')} 00:00:00`;
       end_time   = `${end.format('Y-M-D')} 23:59:59`;
       $("#reservationtime").val(start.format('MM/DD/YYYY')+"-"+end.format('MM/DD/YYYY'));
       $('#data_collection').dataTable().fnDestroy();
      //  searchData(start.format('Y-M-D'),end.format('Y-M-D'),$('#search').val());
       searchData();
  });

  $(document).on('click','.cancelBtn',function(){
       $("#reservationtime").val("");
       start_time = "";
       end_time = "";
       $('#data_collection').dataTable().fnDestroy();
       searchData();
  });

  $(document).on('click','#search_text',function(){
        search = $('#search').val();
        $('#data_collection').dataTable().fnDestroy();
        searchData();
  });

  $(document).on('change', '#search_select_airport', (e) => {
    selected_airport = $(e.target).val();
    $('#data_collection').dataTable().fnDestroy();
    searchData();
  })

  $(document).on('change', '#search_select_company', (e) => {
    selected_company = $(e.target).val();
    $('#data_collection').dataTable().fnDestroy();
    searchData();
  })

  $(document).on('change', '#search_booking_status', (e) => {
    booking_status = $(e.target).val();
    $('#data_collection').dataTable().fnDestroy();
    searchData();
  })

  function searchData(){
     let start_date      = start_time ?? '';
     let end_date        = end_time ?? '';
     let search_text     = search ?? '';
     let selectedAirport = selected_airport ?? '';
     let selectedCompany = selected_company ?? '';
     let bookingStatus   = booking_status ?? '';
     $('#data_collection').DataTable({
      "paging"      : true,
      "pageLength"  : 10,
      "lengthChange": false,
      "searching"   : false,
      "ordering"    : true,
      "info"        : true,
      "autoWidth"   : false,
      "responsive"  : true,
      "processing"  : true,
      "serverSide"  : true,
      "ajax"        :"{{ url('admin/review/checklist') }}?start_date="+start_date+"&end_date="+end_date+"&search_text="+search_text+"&selected_airport="+selectedAirport+"&selected_company="+selectedCompany+"&booking_status="+bookingStatus,
      "columns"     : [
            // {
            //   data: 'DT_RowIndex',
            //   name: 'DT_RowIndex',
            //   searchable: false,
            //   orderable: false
            // },
            {
              data: 'ref_id',
              name: 'ref_id',
              orderable: true,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'customer',
              name: 'customer',
              orderable: true,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'mobile',
              name: 'mobile',
              orderable: true,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'created_at',
              name: 'created_at',
              orderable: true,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'dep_date_time',
              name: 'dep_date_time',
              orderable: true,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'status',
              name: 'status',
              orderable: true,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searchable: false
            },
      ],
    });
}
    });
</script>
@stop
