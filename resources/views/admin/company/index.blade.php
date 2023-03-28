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
              <a href ="{{ route('companies.create') }}"> 
               <button type="button" class="btn btn-block btn-primary"> + Add {{ $title }}</button> 
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
              <div class="card-header">
                <h3 class="card-title">{{ $header }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data_collection" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Company Title</th>
                    <th>Company Phone</th>
                    <th>Company Email</th>
                    <th>Company URL</th>
                    <th>Airport ID</th>
                    <th>Terminal ID</th>
                    <th>Logo</th>
                    <th>Manage Price</th>
                    <th>Company Status</th>
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

        <div class="modal fade" id="manage_price_modal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form id="manage_price_modal_form" enctype="multipart/form-data">
                <div class="modal-header">
                  <h4 class="modal-title">Manage Price</h4>
                  <button type="button" class="close close-manage-price-modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div>
                    <form action="" method="post">
                      <input type="hidden" name="company_id">
                      <div class="row">
                        <div class="col-3" >
                          <div class="form-group">
                            <label for="base_price">Enter Base Price</label>
                            <input type="text" class="form-control" placeholder="Enter price" name="base_price" id="base_price">
                            <span class="validationFail">Please enter base price</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <div class="checkbox">
                            <div class="checker">
                              <span>
                                <label for="base_price"></label><br>
                                <input type="checkbox" value="true" name="per_day_increment_status" class="per-day-increment-status">
                              </span>
                              <b>is per day increse price ?</b>
                            </div>
                          </div>
                        </div>
                        <div class="col-3 per-day-increment-type-div">
                          <div class="form-group">
                            <label for="per_day_increment_type">Select type</label>
                            <select class="form-control select2" style="width: 100%;" name="per_day_increment_type" id="per_day_increment_type">
                              <option value="FLAT">FLAT</option>
                              <option value="PERCENTAGE">PERCENTAGE</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-3 per-day-increment-amount-div">
                          <div class="form-group">
                            <label for="per_day_increment_amount">Enter amount</label>
                            <input type="text" class="form-control" placeholder="Enter amount" name="per_day_increment_amount" id="per_day_increment_amount">
                            <span class="validationFail">Please enter amount</span>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary w-100" id="manage_price_submit_button">Update</button>
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
    let managePlanModel = $('#manage_price_modal').modal({
      keyboard: false
    })
    function closeManagePriceModal(){
      managePlanModel.modal('hide');
    }
    $('.select2').select2();
    var country = $('#country').val();
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
              data: 'airport_id',
              name: 'airport_id', 
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
              data: 'terminal_id',
              name: 'terminal_id', 
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
                          allowOutsideClick: false,
                          allowEscapeKey: false,
                          allowOutsideClick: false
                        }).then((result) => {
                          window.location.reload();
                       
                        });
                    });
                }
          });
          
      } 
  });
  $(document).on('change','#country',function(e){
      country              = $('#country').val();
      var location         = "{{ url('admin/service-providers') }}?country="+country;
      window.location.href = location;
  });
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
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowOutsideClick: false
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
  $(document).on('click', '.manage-plan-button', (e) => {
    e.preventDefault();
    let company_id  = $(e.target).attr('data-companyId');
    console.log('company_id:: ', company_id, 'managePlanModel:: ', managePlanModel);
    managePlanModel.find('input[name=company_id]').val(company_id);
    managePlanModel.modal('show');
  })
  $(document).on('click', '.close-manage-price-modal', (e)=>{
    managePlanModel.modal('hide');
  })
  $(document).on('change', '.per-day-increment-status', (e) => {
    let isChecked = $(e.target).is(':checked');
  
    if(isChecked){
      $('.per-day-increment-type-div, .per-day-increment-amount-div').show();
    }
    else{
      $('.per-day-increment-type-div, .per-day-increment-amount-div').hide();
    }

  })
  $(document).on('click', '#manage_price_submit_button', (e) => {
    e.preventDefault();
    let form = $('#manage_price_modal_form');
    let formDara = '';
    let base_price = managePlanModel.find('#base_price').val();
    let isIncrementInPrice = managePlanModel.find('input[name="per_day_increment_status"]').is(':checked');
    let incrementType = managePlanModel.find('#per_day_increment_type').val();
    let incrementAmount = managePlanModel.find('input[name="per_day_increment_amount"]').val();

    console.log('base_price:: ', base_price, 'isIncrementInPrice:: ', isIncrementInPrice, 'incrementType:: ', incrementType, 'incrementAmount:: ', incrementAmount);
    
    if(!base_price){
      managePlanModel.find('#base_price').addClass('jqueryValidation');
      managePlanModel.find('#base_price').siblings('.validationFail').show();
    }
    else{
      managePlanModel.find('#base_price').removeClass('jqueryValidation');
      managePlanModel.find('#base_price').siblings('.validationFail').hide();
    }

    if(isIncrementInPrice){
      if(!incrementAmount){
        managePlanModel.find('input[name="per_day_increment_amount"]').addClass('jqueryValidation');
        managePlanModel.find('input[name="per_day_increment_amount"]').siblings('.validationFail').show();
      }
      else{
        managePlanModel.find('input[name="per_day_increment_amount"]').removeClass('jqueryValidation');
        managePlanModel.find('input[name="per_day_increment_amount"]').siblings('.validationFail').hide();
      }
    }

    if(!isIncrementInPrice){
      formDara = form.serialize()+'&per_day_increment_status='+isIncrementInPrice;
      if(!base_price){
        return;
      }
    }
    else{
      formDara = form.serialize();
      if(!base_price || !incrementAmount){
        return;
      }
    }

    console.log("price submit", formDara)

  })

  $(document).on('click','.company-operation',function(e){
    e.preventDefault();
    var href            = $(this).attr('href');
    console.log('href:: ', href);
  });
    
});
</script>
@stop