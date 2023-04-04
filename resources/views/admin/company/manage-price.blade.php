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
              <a href ="{{ route('companies.index') }}">
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
        <div class="card-body">
          <div>{{ $company_details->company_title }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="mb-3">Add New Standard Price Plan</div>
          <form action="#" method="post">
            <div class="row col-12" >
              <div class="col-5">
                <div class="form-group">
                  <label for="year">Select year</label>
                  <select class="form-control select2" style="width: 100%;" name="year" id="year">  
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                  </select>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="year">Select month</label>
                  <select class="form-control select2" style="width: 100%;" name="year" id="year">  
                    @foreach (config('constant.MONTHS') as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-2">
                <div class="form-group">
                  <label></label>
                  <button type="submit" class="btn btn-primary" style="margin-top:30px;">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $header ?? '' }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="data_collection" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Year</th>
              <th>Month</th>
              <th>Company</th>
              <th>
                @for ($i = 1; $i >= 30; $i++)
                  <a href="#" class="btn btn-info btn-xs dys">{{ $i }}</a>
                @endfor
                
              </th>
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
  </div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
  /* .dataTables_wrapper{
    overflow-x: scroll;
  } */

  input[type=checkbox]{
    transform: scale(1.5);
    padding-right: 16px;
    margin-right: 12px;
    margin-left: 4px;
  }
  .per-day-increment-type-div,
  .per-day-increment-amount-div{
    display: none;
  }
  .jqueryValidation{
    border: 1px solid red !important;
  }
  .validationFail{
    color: red;
    display: none;
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
<script src="{{ asset('vendor/moment/moment.min.js') }}"></script> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();
  //   $('#data_collection').DataTable({
  //     "paging"      : true,
  //     "pageLength"  : 10,
  //     "lengthChange": false,
  //     "searching"   : true,
  //     "ordering"    : true,
  //     "info"        : true,
  //     "autoWidth"   : false,
  //     "responsive"  : true,
  //     "processing"  : true,
  //     "serverSide"  : true,
  //     "ajax"        :"{{ url('admin/companies') }}",
  //     "columns"     : [
  //           {
  //             data: 'DT_RowIndex',         
  //             name: 'DT_RowIndex',   
  //             searchable: false,
  //             orderable: false
  //           },
  //           {
  //             data: 'company_title',
  //             name: 'company_title', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'company_phone',
  //             name: 'company_phone', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'company_email',
  //             name: 'company_email', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'company_url',
  //             name: 'company_url', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'airport_id',
  //             name: 'airport_id', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'terminal_id',
  //             name: 'terminal_id', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'logo_id',
  //             name: 'logo_id', 
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return  data??'NA';
  //               }
  //             }
  //           },
  //           {
  //             data: 'manage_price',
  //             name: 'manage_price',
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type == 'display'){
  //                   return data;
  //               }else if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return data;
  //               }
  //             }
  //           },
  //           {
  //             data: 'company_status',
  //             name: 'company_status',
  //             orderable: true,
  //             render: function ( data, type, row) {
  //               if(type == 'display'){
  //                   return data;
  //               }else if(type === 'sort'){
  //                   return data;
  //               }else{
  //                   return data;
  //               }
  //             }
  //           },
             
  //           {
  //             data: 'action',
  //             name: 'action', 
  //             orderable: false,
            
  //           },
  //     ],
  //     fnDrawCallback: function (oSettings, json) {

  //         $("input[data-bootstrap-switch]").bootstrapSwitch({
  //             'state':$(this).prop('checked'),
  //               onSwitchChange: function(e, state) {
  //                 var status   = state;
  //                 var href     = $(this).data('href')+"?status="+status;
  //                 $.get(href, function(data) {
  //                   var message = null;
  //                   var response_status  = data.success;
  //                   if(data.success){
  //                     message = data.message;
  //                   }else{
  //                     message = data.message;
  //                   }
  //                   Swal.fire({
  //                         title: message,
  //                         showDenyButton: false,
  //                         showCancelButton: false,
  //                         confirmButtonText: `OK`,
  //                         allowOutsideClick: false,
  //                         allowEscapeKey: false,
  //                         allowOutsideClick: false
  //                       }).then((result) => {
  //                         window.location.reload();
                       
  //                       });
  //                   });
  //               }
  //         });
          
  //     } 
  // }); 
});
</script>
@stop