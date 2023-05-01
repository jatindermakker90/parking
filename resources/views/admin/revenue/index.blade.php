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
            <div class="col-md-4">
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
            <div class="col-md-4">
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
            <div class="col-md-4">
                <div class="form-group">
                  <label>From/To:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservationtime" placeholder="Please select date range">
                  </div>
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
            <th>Airport Companies</th>
            <th>Normal Bookings</th>
            <th>Discounted Bookings</th>
            <th>Total Bookings</th>
            <th>Quote Price</th>
            <th>Discounted Price</th>
            <th>Cancelation Charges</th>
            <th>SMS Charges</th>
            <th>Postal Charges</th>
            <th>Admin Charges</th>
            <th>Extras</th>
            <th>Total Amount</th>
            <th>Commission</th>
            <th>Payed Amount</th>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Booking</h4>
        <button type="button" class="close close-edit-booking-button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <h4 id="editBookingResponse"></h4>
            <form id="edit_booking_form" method="POST" action="#" enctype="multipart/form-data">
                @csrf
                <div id="booking-edit-modal">
                  <!-- insert html from ajax -->
                </div>
                <span id="get_updated_price_warrning">*Please get updated price by the click on "Get extanded Quote" button</span>
                <button type="button" class="btn btn-primary w-100 mt-3" id="edit_booking_button">Update</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-default1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Booking</h4>
        <button type="button" class="close close-view-booking-button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
                <div id="booking-view-modal">

                </div>
                <!-- insert html from ajax -->
                <button type="button" class="btn btn-primary w-100" id="close-view-booking-button">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-default2">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Booking</h4>
        <button type="button" class="close close-cancel-booking-button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
                <div id="booking-cancel-modal">

                </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="change_status_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="change_booking_status_form" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Change Booking Status</h4>
          <button type="button" class="close close-status-button" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary w-100" id="change_booking_status_button">Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
  #get_updated_price_warrning{
    color: red;
    display: none;
    font-size: 20px;
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
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
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
      "searching"   : true,
      "ordering"    : true,
      "info"        : true,
      "autoWidth"   : false,
      "responsive"  : true,
      "processing"  : true,
      "serverSide"  : true,
      
      "ajax"        :"{{ url('admin/companies') }}",
      "columns"     : [
            {
              data: 'DT_RowIndex',         
              name: 'DT_RowIndex',   
              searchable: false,
              orderable: false
            },
            {
              data: 'company_title',
              name: 'company_title', 
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
              data: 'company_phone',
              name: 'company_phone', 
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
              data: 'company_email',
              name: 'company_email', 
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
              data: 'company_url',
              name: 'company_url', 
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
              data: 'airport.airport_name',
              name: 'airport.airport_name', 
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
              data: 'terminal.terminal_name',
              name: 'terminal.terminal_name', 
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
              data: 'logo_id',
              name: 'logo_id', 
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
              data: 'manage_price',
              name: 'manage_price',
              orderable: true,
              render: function ( data, type, row) {
                if(type == 'display'){
                    return data;
                }else if(type === 'sort'){
                    return data;
                }else{
                    return data;
                }
              }
            },
            {
              data: 'company_status',
              name: 'company_status',
              orderable: true,
              render: function ( data, type, row) {
                if(type == 'display'){
                    return data;
                }else if(type === 'sort'){
                    return data;
                }else{
                    return data;
                }
              }
            },
             
            {
              data: 'action',
              name: 'action', 
              orderable: false,
            
            },
      ],
      fnDrawCallback: function (oSettings, json) {

          $("input[data-bootstrap-switch]").bootstrapSwitch({
            // 'state':$(this).prop('checked'),
            onSwitchChange: function(e, state) {
              e.preventDefault();
              var status   = state;
              var href     = $(this).data('href')+"?status="+status;
              let operationButton = $(this).parents('tr').find('.company-operation');
              console.log('status:: ', status, 'operationButton:: ', operationButton);
              if(status){
                let operationStatus = $(this).data('operation');
                if(!operationStatus){
                  e.preventDefault();
                  console.log('status:: ', status, 'operationStatus:: ', operationStatus);
                  Swal.fire({
                    title: `{{ config('constant.ALERTS.OPERATION_PENDING') }}`,
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Go Ahead !`,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                  }).then((result) => {
                    console.log('result:: ', result)
                    if(result.isConfirmed){
                      $(operationButton).trigger('click', 1);
                      // operationsModel.modal('show');
                    }
                    else{
                      window.location.reload();
                    }
                  });

                }
                else{
                  $.get(href, function(data) {
                    var message = null;
                    var response_status  = data.success;
                    if(data.success){
                      message = data.message;
                    }else{
                      message = data.message;
                    }
                    Swal.fire({
                      title: message,
                      showDenyButton: false,
                      showCancelButton: false,
                      confirmButtonText: `OK`,
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowOutsideClick: false
                    }).then((result) => {
                      window.location.reload();
                    });
                  });
                }
              }
              else{
                $.get(href, function(data) {
                  var message = null;
                  var response_status  = data.success;
                  if(data.success){
                    message = data.message;
                  }else{
                    message = data.message;
                  }
                  Swal.fire({
                    title: message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: `OK`,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                  }).then((result) => {
                    window.location.reload();
                  });
                });
              }
            }
          });
          
      } 
  });
  }
  });


  function toSimpleJson(serializedData) {
    var ar1 = serializedData.split("&");
    var json = "{";
    for (var i = 0; i<ar1.length; i++) {
        var ar2 = ar1[i].split("=");
        json += i > 0 ? ", " : "";
        json += "\"" + ar2[0] + "\" : ";
        json += "\"" + (ar2.length < 2 ? "" : ar2[1]) + "\"";
    }
    json += "}";
    return json;
  }
</script>
@stop
