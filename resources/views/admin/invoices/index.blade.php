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
              <!-- <a href ="{{ route('invoices.create') }}">
              <button type="button" class="btn btn-block btn-primary"> + Add {{ $title }}</button> -->
              </a>
            </ol>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
                    <th>Sr No.</th>
                    <th>Ref No.</th>
                    <th>E Date</th>
                    <th>R Date</th>
                    <th>Surname</th>
                    <th>First Name</th>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script type="text/javascript">

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
          "ajax"        :"{{ url('admin/invoices') }}",
          "columns"     : [
                {
                  data: 'id',         
                  name: 'id',   
                  orderable: true
                },
                {
                  data: 'ref_no',
                  name: 'ref_no', 
                  orderable: true
                },
                {
                  data: 'e_date',
                  name: 'e_date',
                  orderable: true
                },
                {
                  data: 'r_date',
                  name: 'r_date',
                  orderable: true,
                  searchable: true
                },
                {
                  data: 'sur_name',
                  name: 'sur_name',
                  orderable: true,
                  searchable: true
                },
                {
                  data: 'first_name',
                  name: 'first_name',
                  orderable: true,
                  searchable: true
                },
                {
                  data: 'status_name',
                  name: 'status_name',
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
    
});
</script>
@stop