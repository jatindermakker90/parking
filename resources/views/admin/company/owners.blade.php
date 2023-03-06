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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Assigned Companies</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                  <h4 id="assignAdminResponse"></h4>
                  <form id="assign-admin-form" method="POST" action="{{ route('assign-user-to-companies') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Admin email</label>
                        <input type="email" class="form-control" id="assign-user-email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group {{ $errors->has('airport_id') ? 'has-error' : '' }}">
                        <label for="company_id">Company Name</label>
                        <select class="form-control select2" style="width: 100%;" name="company_id" id="company_id">
                            <option value="">Select company</option>
                            @foreach ($companies as $companies_key => $companies_value)
                                <option value="{{ $companies_value['id'] }}">{{ $companies_value['company_title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="d-none" id="user_element" name="user_element">
                    <button type="submit" class="btn btn-primary">Assign</button>
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
  #assignAdminResponse{
    border: 1px solid;
    padding: 9px;
    border-radius: 5px;
    display: none;
  }
  #assignAdminResponse.danger{
    background-color:#ff0000b0;
    color: #ffff;
    border-color:##ff0000b0; 
  }
  #assignAdminResponse.success{
    background-color:#44a95a;
    color: #000;
    border-color:##44a95a; 
  }
  ul.assigned-company{
    list-style: none;
  }
  .assigned-company{
    padding: 0;
  }
  .assigned-company li{
    border: 1px solid #c3c0c0b0;
    padding: 2px 8px;
    border-radius: 5px;
    width: fit-content;
  }
  .assigned-company li .assign-admin-remove{
    margin: 0px 0px 0px 13px;
    padding: 1px 6px 3px 5px;
    font-size: 18px;
    color: red;
  }
  .assigned-company li .assign-admin-remove:hover{
    background-color: red;
    color: #fff;
    cursor: pointer;
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
      "ajax"        :"{{ url('admin/company/owners') }}",
      "columns"     : [
            {
              data: 'DT_RowIndex',         
              name: 'DT_RowIndex',   
              searchable: false,
              orderable: false
            },
            {
              data: 'first_name',
              name: 'first_name', 
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
              data: 'email',
              name: 'email', 
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
              data: 'assign_user',
              name: 'assign_user',
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
              data: 'user_status',
              name: 'user_status',
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
              data: 'assignd_companies',
              name: 'assignd_companies',
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
             
            // {
            //   data: 'action',
            //   name: 'action', 
            //   orderable: false,
            
            // },
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
    $(document).on('click','.open-assign-modal',function(e){
        e.preventDefault();
        let model = $("#modal-default");
        let user_element_id = $(e.target).attr('id');
        console.log(`user_element::`, model.find('#user_element'))
        $("#assignAdminResponse").removeClass().text(null).hide();
        let user_email = $(e.target).parent().prev().text();
        model.find('#user_element').val(user_element_id);
        model.find('#assign-user-email').val(user_email);
        model.modal('show');
    });

    $(document).on('submit','#assign-admin-form',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        let url = $(this).attr('action'); 

        console.log(`form::`, $(this).serialize(), 'url:: ', url);
        
        $.ajax({  
            url: url,  
            type: 'POST',
            data: formData,  
            success: function(data) {  
                console.log(data);
                switch (true) {
                    case data.code == 203 || data.code == 204 || data.code == 202 || data.code == 201:
                        $("#assignAdminResponse").removeClass().addClass('danger').text(data.success).show();
                        break;
                    case data.code == 200:
                        $("#assignAdminResponse").removeClass().addClass('success').text(data.success).show();
                        let str = `<li>${data.data.company_title}<span data-uid="${data.data.user_id}" data-cid="${data.data.id}" class="assign-admin-remove">x</span></li>`;
                        let ele = $('#'+data.data.user_element)
                                    .parent().siblings('td')
                                    .find(".assigned-company")
                                    .append(str);
                        console.log(`ele::`, ele);
                        setTimeout(() => {
                            
                            $("#modal-default").modal('hide');
                        }, 3000);
                        break;
                    default:
                        $("#assignAdminResponse").removeClass().hide();
                        break;
                }
                
            }  
        });
    });

    $(document).on('click','.assign-admin-remove',function(e){
        e.preventDefault();
        let currentElement = $(this);
        let formData = {'user_id': "",'company_id': ""};
        formData.user_id = $(this).attr('data-uid');
        formData.company_id = $(this).attr('data-cid');
        let url = "{{route('remove-user-to-companies')}}"; 

        console.log(`form::`, formData, 'url:: ', url);
        $.ajax({  
            url: url,  
            type: 'POST',
            data: formData,  
            success: function(data) {  
                console.log(data);
                switch (true) {
                    case data.code == 203 || data.code == 204 || data.code == 202 || data.code == 201:
                        break;
                    case data.code == 200:
                        console.log('currentElement::', currentElement)
                        currentElement.parent().remove();
                        break;
                    default:
                        break;
                }
                
            }  
        });
    });
    
});
</script>
@stop