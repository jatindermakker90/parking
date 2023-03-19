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
      <div class="modal-body" id="booking-edit-modal">
        <!-- <div>
            <h4 id="assignAdminResponse"></h4>
            <form id="assign-admin-form" method="POST" action="{{ route('assign-user-to-companies') }}" enctype="multipart/form-data">
              @csrf
              <nav>
                <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" 
                          data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                           aria-selected="true">Personal Details</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" 
                          data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" 
                          aria-selected="false">Flight Details</button>
                  <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" 
                          data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" 
                          aria-selected="false">Vehicle Details</button>
                  <button class="nav-link" id="nav-travel-tab" data-bs-toggle="tab" 
                          data-bs-target="#nav-travel" type="button" role="tab" aria-controls="nav-contact" 
                          aria-selected="false">Travel Details</button>
                  <button class="nav-link" id="nav-special-tab" data-bs-toggle="tab" 
                          data-bs-target="#nav-special" type="button" role="tab" aria-controls="nav-contact" 
                          aria-selected="false">Special Instruction</button>
                  <button class="nav-link" id="nav-shift-tab" data-bs-toggle="tab" 
                          data-bs-target="#nav-shift" type="button" role="tab" aria-controls="nav-contact" 
                          aria-selected="false">Shift Booking</button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <form action="" method="post">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h5 class="text-center">Personal Details</h5>
                    <div class="row">
                      <div class="col-2">
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" class="form-control" id ="title" name="title">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" id ="first_name" name="first_name">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" id ="last_name" name="last_name">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" id ="email" name="email">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" class="form-control" id ="mobile" name="mobile">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-2">
                        <div class="form-group">
                          <label>City/ Town</label>
                          <input type="text" class="form-control" id ="city_town" name="city_town" placeholder="Enter city">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" id ="address" name="address" placeholder="Enter address">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Country</label>
                          <input type="text" class="form-control" id ="country" name="country" placeholder="Enter country">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group">
                          <label>Postcode</label>
                          <input type="text" class="form-control" id ="postcode" name="postcode" placeholder="Enter postcode">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label for="drop_off_terminal">Drop-off Terminal</label>
                          <select class="form-control select2" style="width: 100%;" name="drop_off_terminal" id="drop_off_terminal">
                            <option value="tbc">TBC</option>
                            <option value="main_terminal">Main Terminal</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="return_terminal">Return Terminal</label>
                          <select class="form-control select2" style="width: 100%;" name="return_terminal" id="return_terminal">
                            <option value="tbc">TBC</option>
                            <option value="main_terminal">Main Terminal</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="vehicle_colour">Vehicle Colour</label>
                          <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle_colour" id="vehicle_colour">
                          <span class="validationFail">Please select vehicle colour</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row">
                      <div class="col-3">
                        <div class="form-group">
                          <label for="vehicle_make">Vehicle Make</label>
                          <input type="text" class="form-control" placeholder="Enter vehicle make" name="vehicle_make" id="vehicle_make">
                          <span class="validationFail">Please select vehicle make</span>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="vehicle_model">Vehicle Model</label>
                          <input type="text" class="form-control" placeholder="Enter vehicle model" name="vehicle_model" id="vehicle_model">
                          <span class="validationFail">Please select vehicle model</span>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="vehicle_colour">Vehicle Colour</label>
                          <input type="text" class="form-control" placeholder="Enter vehicle colour" name="vehicle_colour" id="vehicle_colour">
                          <span class="validationFail">Please select vehicle colour</span>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="vehicle_reg">Vehicle Reg #</label>
                          <input type="text" class="form-control" placeholder="Enter vehicle reg" name="vehicle_reg" id="vehicle_reg">
                          <span class="validationFail">Please select vehicle reg.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-travel" role="tabpanel" aria-labelledby="nav-travel-tab">Travel</div>
                  <div class="tab-pane fade" id="nav-special" role="tabpanel" aria-labelledby="nav-special-tab">
                    <label for="special_notes">Special Notes</label>
                    <textarea class="w-100" name="special_notes" id="special_notes" rows="5"></textarea>
                  </div>
                  <div class="tab-pane fade" id="nav-shift" role="tabpanel" aria-labelledby="nav-shift-tab">
                    <div class="form-group">
                      <label for="model_company">Select Company</label>
                      <select class="form-control select2" name ="company" id ="model_company">
                        <option value="">All</option>
                        <option value="">Active</option>
                        <option value="">InActive</option>
                        <option value="">Cancelled</option>                              
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <button type="submit" class="btn btn-primary w-100">Assign</button>
          </form>
        </div> -->
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
      fnDrawCallback: function (oSettings, json) {

          $("input[data-bootstrap-switch]").bootstrapSwitch({
              'state':$(this).prop('checked'),
                onSwitchChange: function(e, state) {
                  var status   = state;
                  var href     = $(this).data('href')+"?status="+status;
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
                        }).then((result) => {
                          window.location.reload();
                       
                        });
                    });
                }
          });
          
      } 
  });
  }
  $(document).on('click','.delete_record',function(e){
    e.preventDefault();
      var delete_type     = $(this).data('type');
      var delete_message  = 'Do you want to delete '+delete_type+'?';
      var success_message = delete_type+' deleted successfully';
      var deny_message    = delete_type+' not deleted.';
      var href            = $(this).attr('href');
      Swal.fire({
        title: delete_message,
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `OK`,
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: href,
              type: 'DELETE',
              success:function(data){
                Swal.fire(success_message, '', 'success');
                window.location.reload();
              },
            });
          } else if (result.isDenied) {
            Swal.fire(deny_message, '', 'info')
        }
      });
  });

  $(document).on('click','.edit-booking',function(e){
        e.preventDefault();
        let model = $("#modal-default");
        console.log('e.target:: ', e.target);
        let booking_id = $(e.target).attr('data-id');
        let ajaxUrl = "{{ route('get-single-booking') }}";
        ajaxUrl = `${ajaxUrl}?id=${booking_id}`;
        console.log(`model open : booking_id :: `, booking_id, 'ajaxUrl:: ', ajaxUrl);
        // return;
        $.ajax({
          type:"GET",
          url: ajaxUrl,
          success: function(response){
            // console.log(`form submited`, response);
            // if(response.status_code == 200){
              $("#booking-edit-modal").html(response)
              model.modal('show');
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
        // $("#assignAdminResponse").removeClass().text(null).hide();
        // let user_email = $(e.target).parent().prev().text();
        // model.find('#user_element').val(user_element_id);
        // model.find('#assign-user-email').val(user_email);
    });
});
</script>
@stop