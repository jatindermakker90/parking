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
            <th>Customer</th>
            <th>Company</th>
            <th>Contact</th>
            <th>Added On</th>
            <th>Departure</th>
            <th>Return</th>
            <th>Days</th>
            <th>Veh Reg No.</th>
            <th>Price</th>
            <th>CNC</th>
            <th>SMS</th>
            <th>DIS</th>
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

                </div>
                <!-- insert html from ajax -->
                <button type="button" class="btn btn-primary w-100" id="edit_booking_button">Update</button>
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
      "ajax"        :"{{ url('admin/bookings') }}?start_date="+start_date+"&end_date="+end_date+"&search_text="+search_text+"&selected_airport="+selectedAirport+"&selected_company="+selectedCompany+"&booking_status="+bookingStatus,
      "columns"     : [
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
          data: 'total_days',
          name: 'total_days',
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
          data: 'cancellation_cover',
          name: 'cancellation_cover',
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
          data: 'sms_confirmation',
          name: 'sms_confirmation',
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
          data: 'discount_code',
          name: 'discount_code',
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

  $(document).on('click','.edit-booking',function(e){
      e.preventDefault();
      console.log('$(e.target):: ', $(e.target));
      let model = $("#modal-default");
      let booking_id = $(e.target).attr('data-id');
      let booking_ref_id = $(e.target).attr('data-ref-id');
      $("#modal-default").find('.modal-title').text(`Edit Booking - ${booking_ref_id}`);
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
          'address', 'country', 'postcode', 'flight_number', 'special_notes', 'admin_charge',
          'extended_price', 'payment_amount', 'payment_method', 'payment_status', 'transaction_id', 'transaction_id_get'
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
          let updated_dep_date = $("#updated_dep_date").val();
          let updated_dep_time = $("#updated_dep_time").val();
          let updated_return_date = $("#updated_return_date").val();
          let updated_return_time = $("#updated_return_time").val();

          let start_date = `${updated_dep_date} ${updated_dep_time}:00`;
          let end_date = `${updated_return_date} ${updated_return_time}:00`;
          let ajaxUrl2 = "{{ route('compare-two-date') }}"
          $.ajax({
            type:"POST",
            url: ajaxUrl2,
            data: {"start_date": start_date,"end_date": end_date},
            success: function(response){
              console.log(` date comparision:: `, response);
              if(response.data == false){
                toastr["error"]('Arrival date time shouldn\'t be less then to Departure date time');
                editBookingForm.find('button').attr('disabled', false)
              }
              else{
                editBookingForm.find('button').attr('disabled', true)
                $.ajax({
                    type:"POST",
                    url: ajaxUrl,
                    data: formDataSerialize,
                    success: function(response){
                      console.log(`form submited`, response);
                      if(response.code == 200){
                        $("#modal-default").modal('hide');
                        toastr["success"](response.success);
                        setTimeout(() => {
                          window.location.href = response.path;
                        }, 1000);
                      }
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
            }
          });

      }
  });

  $(document).on('click', '.change-status', (e)=>{
    e.preventDefault();
    console.log(`change status`)
    let booking_id = $(e.target).attr('data-id');

    let ajaxUrl = "{{ route('get-change-status-html') }}";
      ajaxUrl = `${ajaxUrl}?id=${booking_id}`;
      $.ajax({
        type:"GET",
        url: ajaxUrl,
        success: function(response){
            $("#change_status_modal .modal-body").html(response)
            $("#change_status_modal").modal('show');
            $('.select2').select2();
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
  })

  $(document).on('click', '.close-status-button', (e)=>{
    $("#change_status_modal").modal('hide');
  })

  $(document).on('click', '.close-edit-booking-button', (e)=>{
    $("#modal-default").modal('hide');
  })

  $(document).on('click', '.close-view-booking-button', (e)=>{
    $("#modal-default1").modal('hide');
  })

  $(document).on('click', '#close-view-booking-button', (e)=>{
    $("#modal-default1").modal('hide');
  })

  $(document).on('click', '.close-cancel-booking-button', (e)=>{
    $("#modal-default2").modal('hide');
  })

  $(document).on('click', '#change_booking_status_button', (e)=>{
    e.preventDefault();
    console.log(`update status`)

    let ajaxUrl = "{{ route('change-booking-status') }}";
    let formDataSerialize = $("#change_booking_status_form").serialize();
    ajaxUrl = ajaxUrl +'?'+formDataSerialize
    console.log('formDataSerialize:: ', formDataSerialize, 'ajaxUrl:: ', ajaxUrl);



    $("#change_booking_status_form").find("#change_booking_status_button").attr('disabled', true)
    $.ajax({
      type:"POST",
      url: ajaxUrl,
      data: formDataSerialize,
      success: function(response){
        console.log(`form submited`, response);
        if(response.code == 200){
          $("#modal-default").modal('hide');
          toastr["success"](response.success);
          setTimeout(() => {
            window.location.href = response.path;
          }, 1000);
        }
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

  $(document).on('click','.view-booking',function(e){
      e.preventDefault();
      let model = $("#modal-default1");
      let booking_id = $(e.target).attr('data-id');
      let booking_ref_id = $(e.target).attr('data-ref-id');
      $("#modal-default1").find('.modal-title').text(`Booking Details - ${booking_ref_id}`);
      let ajaxUrl = "{{ route('get-booking-view') }}";
      ajaxUrl = `${ajaxUrl}?id=${booking_id}`;
      // return;
      $.ajax({
      type:"GET",
      url: ajaxUrl,
      success: function(response){
          $("#booking-view-modal").html(response)
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

  $(document).on('click','.cancel-booking',function(e){
      e.preventDefault();
      let model = $("#modal-default2");
      let booking_id = $(e.target).attr('data-id');
      let booking_ref_id = $(e.target).attr('data-ref-id');
      $("#modal-default2").find('.modal-title').text(`Booking Details - ${booking_ref_id}`);
      let ajaxUrl = "{{ route('get-booking-cancel') }}";
      ajaxUrl = `${ajaxUrl}?id=${booking_id}`;
      // return;
      $.ajax({
      type:"GET",
      url: ajaxUrl,
      success: function(response){
          $("#booking-cancel-modal").html(response)
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

  $(document).on('click','.delete-booking',function(e){

    e.preventDefault();
      var delete_type     = $(this).data('type');
      var delete_message  = 'Do you want to Delete Booking';
      var success_message = 'Booking Deleted successfully';
      var deny_message    = 'Booking not deleted.';
      var href            = $(this).attr('href');
      console.log('href',href);
      Swal.fire({
          title: delete_message,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: `OK`,
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: href,
                type: 'get',
                success:function(data){
                //  console.log(data);
                    Swal.fire(success_message, '', 'success');
                    window.location.reload();
                },
              });

            } else if (result.isDenied) {
              Swal.fire(deny_message, '', 'info')
            }
      });
  });

  $(document).on('click','.sms-send',function(e){
      e.preventDefault();
      let model = $("#modal-default2");
      let booking_id = $(e.target).attr('data-id');
      let booking_ref_id = $(e.target).attr('data-ref-id');
      $("#modal-default2").find('.modal-title').text(`SMS Service`);
      let ajaxUrl = "{{ route('get-booking-sms') }}";
      ajaxUrl = `${ajaxUrl}?id=${booking_id}`;
      // return;
      $.ajax({
      type:"GET",
      url: ajaxUrl,
      success: function(response){
          $("#booking-cancel-modal").html(response)
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
  
  $(document).on('click', '#get_extended_charge', (e)=>{
    e.preventDefault();

    let editBookingForm = $("#edit_booking_form");
    let returnTimeNew = $(editBookingForm).find('#return_time').val();

    let formData = $(editBookingForm).serialize();
    formData = formData+'&return_time_new='+returnTimeNew;
    
    let ajaxUrl = "{{ route('get-updated-price') }}";
    $.ajax({
      type:"GET",
      url: ajaxUrl,
      data: formData,
      success: function(response){
        if(!Number.isInteger(response.data.diff_price)){
          response.data.diff_price = parseFloat(response.data.diff_price.toFixed(2));
        }
        console.log('response:: ', response);
        $(editBookingForm).find("#price").val(response.data.new_price);
        $(editBookingForm).find("#extended_price").val(response.data.diff_price);
        $(editBookingForm).find("#total_days").val(response.data.no_of_days);
        $(editBookingForm).find("#admin_charge").val(response.data.admin_charge);
        $(editBookingForm).find("#payment_amount").val(response.data.new_price);

      },
      error: function(XHR, textStatus, errorThrown) {
          if(XHR.responseJSON.message != undefined){
              toastr["error"](XHR.responseJSON.message);
          }else{
              toastr["error"](errorThrown);
          }
      }
    });

    
    return;

    
  })
});
</script>
@stop
