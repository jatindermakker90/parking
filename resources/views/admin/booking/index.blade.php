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
              <a href ="{{ route('bookings.create') }}">
              <button type="button" class="btn btn-block btn-primary"> + Add Booking</button>
              </a>
            </ol>
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
                    <label>Airport:</label>
                    <select class="form-control select2" name ="select_airport" id ="select_airport">
                    <option value="">All</option>
                    @foreach ($airports as $airport_key => $airport_value)
                      <option value="{{ $airport_value->id }}">{{ $airport_value->airport_name }}</option>
                    @endforeach               
                </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Company:</label>
                    <select class="form-control select2" name ="select_airport" id ="select_airport">
                    <option value="">All</option>
                    @foreach ($companies ?? '' as $company_key => $company_value)
                      <option value="{{ $company_value->id }}">{{ $company_value->company_title }}</option>
                    @endforeach               
                </select>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <label>Type:</label>
                    <select class="form-control select2" name ="select_airport" id ="select_airport">
                    <option value="">All</option>
                    <option value="">Booking Date</option>
                    <option value="">Departure Date</option>
                    <option value="">Arrival Date</option>                               
                </select>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control select2" name ="select_airport" id ="select_airport">
                      <option value="">All</option>
                      <option value="">Active</option>
                      <option value="">InActive</option>
                      <option value="">Cancelled</option>                              
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
            <th>Customer</th>
            <th>Company</th>
            <th>Contact</th>
            <th>Added On</th>
            <th>Dep Date/time</th>
            <th>Return Data/time</th>
            <th>Days</th>
            <th>Vehicle Reg No.</th>
            <th>Price</th>
            <th>CNC</th>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Booking</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <h4 id="editBookingResponse"></h4>
            <form id="edit_booking_form" method="POST" action="#" enctype="multipart/form-data">
                @csrf
                <div id="booking-edit-modal">

                </div>
                <!-- insert html from ajax -->
                <button type="button" class="btn btn-primary w-100" id="edit_booking_button">Update</button>
            </form>
        </div>
      </div>
    </div>
  </div>
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

$(document).ready(function(){
    var today = new Date();
    var time   = $('#reservationtime').val();
    var start_time = null;
    var end_time   = null;
    var search = $('#search').val();
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
       start_time = start.format('Y-M-D');
       end_time   = end.format('Y-M-D');
       $("#reservationtime").val(start.format('MM/DD/YYYY')+"-"+end.format('MM/DD/YYYY'));
       $('#data_collection').dataTable().fnDestroy();
       searchData(start.format('Y-M-D'),end.format('Y-M-D'),$('#search').val());
  });
  
  $(document).on('click','.cancelBtn',function(){
       $("#reservationtime").val("");
       start_time = "";
       end_time = "";
       $('#data_collection').dataTable().fnDestroy();
       searchData(null,null,$('#search').val());
  });

  $(document).on('click','#search_text',function(){
        $('#data_collection').dataTable().fnDestroy();
        searchData(start_time,end_time,$('#search').val());
  });

  function searchData(start = null,end = null,search = null){
     let start_date      = start ?? '';
     let end_date        = end ?? '';
     let search_text     = search ?? '';
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
      "ajax"        :"{{ url('admin/bookings') }}?start_date="+start_date+"&end_date="+end_date+"&search_text="+search_text,
      "columns"     : [
            // {
            //   data: 'DT_RowIndex',         
            //   name: 'DT_RowIndex',   
            //   searchable: false,
            //   orderable: false
            // },
            {
              data: 'ref_no',
              name: 'ref_no', 
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
              data: 'company.company_title',
              name: 'company.company_title', 
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
              data: 'return_date_time',
              name: 'return_date_time', 
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
              data: 'days',
              name: 'days', 
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
              data: 'vehicle.vehicle_reg',
              name: 'vehicle.vehicle_reg', 
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
              data: 'price',
              name: 'price', 
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
              data: 'cnc',
              name: 'cnc', 
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
              data: 'booking_status',
              name: 'booking_status', 
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

        $(document).on('click','.edit-booking',function(e){
            e.preventDefault();
            let model = $("#modal-default");
            let booking_id = $(e.target).attr('data-id');
            let ajaxUrl = "{{ route('get-single-booking') }}";
            ajaxUrl = `${ajaxUrl}?id=${booking_id}`;
            // return;
            $.ajax({
            type:"GET",
            url: ajaxUrl,
            success: function(response){
                $("#booking-edit-modal").html(response)
                model.modal('show');
            },
            error: function(XHR, textStatus, errorThrown) {
                // console.log(XHR.responseJSON.message);
                if(XHR.responseJSON.message != undefined){
                    toastr["error"](XHR.responseJSON.message);  
                }else{
                    toastr["error"](errorThrown);  
                }
            }
            });
        });

        $(document).on('click', '#edit_booking_button', (e)=>{
            e.preventDefault();
            let validationPass = true; 
            let excludeElementValidation = [
                'discount_code', 'cancellation_cover', 'sms_confirmation', 'city_town',
                'address', 'country', 'postcode', 'flight_number', 'special_notes'
            ]
            let ajaxUrl = "{{ route('booking-update') }}";
            let editBookingForm = $("#edit_booking_form");

            let formDataArray = editBookingForm.serializeArray();
            let formDataSerialize = editBookingForm.serialize();
            
            console.log('formDataArray:: ', formDataArray, 'ajaxUrl:: ', ajaxUrl);

            formDataArray.forEach(element => {
                if($.inArray(element.name, excludeElementValidation) == -1){
                    if(element.value == ''){
                        editBookingForm.find(`input[name='${element.name}'], select[name='${element.name}']`).addClass('jqueryValidation');
                        editBookingForm.find(`input[name='${element.name}'], select[name='${element.name}']`).siblings('.validationFail').show()
                    }
                    else{
                        editBookingForm.find(`input[name='${element.name}'], select[name='${element.name}']`).removeClass('jqueryValidation');
                        editBookingForm.find(`input[name='${element.name}'], select[name='${element.name}']`).siblings('.validationFail').hide()
                    }
                }
            });

            formDataArray.forEach(element => {
                if($.inArray(element.name, excludeElementValidation) == -1){
                    if(element.value == ''){
                    validationPass = false;
                    return;
                    }
                }
            });

            if(!validationPass){
                toastr["error"]('Please check ! Some required filed is empty.');
                console.log(`validationPass :: ${validationPass}`);
            }
            else{
                editBookingForm.find('button').attr('disabled', true)
                $.ajax({
                    type:"POST",
                    url: ajaxUrl,
                    data: formDataSerialize,
                    success: function(response){
                    console.log(`form submited`, response);
                    // if(response.status_code == 200){
                    //     toastr["success"](response.message);
                        
                    // }
                    },
                    error: function(XHR, textStatus, errorThrown) {
                    // console.log(XHR.responseJSON.message);
                    if(XHR.responseJSON.message != undefined){
                        toastr["error"](XHR.responseJSON.message);  
                    }else{
                        toastr["error"](errorThrown);  
                    }
                    }
                });
            }
        })
        
    });
</script>
@stop