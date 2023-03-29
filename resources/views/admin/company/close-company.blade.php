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
        <form method="POST" action="{{ route('close-company-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
              <div class="col-6">
                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
                    <label for="company_id">Company Name</label>{{ old('company_id') }}
                    <select class="form-control select2" style="width: 100%;" name="company_id" id="company_id">
                        <option value="">Select company</option>
                        @foreach ($companies as $companies_key => $companies_value)
                            <option value="{{ $companies_value->id }}">{{ $companies_value->company_title }}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('company_id'))
                        <span class="form-error">{{ $errors->first('company_id') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-6">
                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                    <label for="date">Select Start Date</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ old('date') ?? '' }}">
                    @if ($errors->first('date'))
                        <span class="form-error">{{ $errors->first('date') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Journey Type</label>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio1" name="journey_type" value="arrival">
                    <label for="customRadio1" class="custom-control-label">Arrival</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio2" name="journey_type" value="departure">
                    <label for="customRadio2" class="custom-control-label">Departure</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio3" name="journey_type" value="both" checked>
                    <label for="customRadio3" class="custom-control-label">Both</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Status</label>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="status1" name="status" value="active">
                    <label for="status1" class="custom-control-label">Active</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="status2" name="status" value="unactive" checked>
                    <label for="status2" class="custom-control-label">Unactive</label>
                  </div>
                </div>
              </div>
            </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="submitButton"
                style="text-align:right;float:right;">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- <div class="row"> -->
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
                <th>Title</th>
                <th>Status Date</th>
                <th>Journey Type</th>
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
  <!-- </div> -->

<div class="modal fade" id="edit-close-company-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Booking</h4>
        <button type="button" class="close close-edit-close-company-button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
            <h4 id="editBookingResponse"></h4>
            <form id="edit_company_close_form" enctype="multipart/form-data">
                @csrf
                <div id="edit-close-company-form-body">
                  <!-- insert html from ajax -->
                </div>
                <button type="button" class="btn btn-primary w-100" id="edit_close_company_submit_button">Update</button>
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
    .has-error select {
      border-color: red;
    }
    .form-error{
      color:red;
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
<!-- DataTables  & Plugins -->
<script type="text/javascript">
$(document).ready(function(){
  $('.select2').select2();
  let editCloseCompanyModal = $("#edit-close-company-modal").modal({
    keyboard:false
  })
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
      "ajax"        :"{{ route('close-company') }}",
      "columns"     : [
            {
              data: 'DT_RowIndex',         
              name: 'DT_RowIndex',   
              searchable: false,
              orderable: false
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
              data: 'date',
              name: 'date', 
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
              data: 'journey_type',
              name: 'journey_type', 
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
      ]
  });
  $(document).on('click', '.edit-close-company', (e) => {
    let id = $(e.target).data('id');
    
    let ajaxUrl = "{{ route('get-edit-close-company-html') }}";
    ajaxUrl = `${ajaxUrl}?id=${id}`;
    console.log('id:: ', id, 'ajaxUrl:: ', ajaxUrl);
    // return;
    $.ajax({
    type:"GET",
    url: ajaxUrl,
    success: function(response){
        $("#edit-close-company-form-body").html(response);
        editCloseCompanyModal.modal('show');
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
  $(document).on('click', '.close-edit-close-company-button', (e) => {
    editCloseCompanyModal.modal('hide')
  })
  $(document).on('click', '#edit_close_company_submit_button', (e)=>{
    e.preventDefault();
    let form = $("#edit_company_close_form");
    console.log('form:: ', form);
    let formDataArray = form.serializeArray();
    let formDataSerialize = form.serialize();
    let excludeElementValidation = [];
    let validationPass = true; 
    let ajaxUrl = "{{ route('close-company-update') }}";
    

    formDataArray.forEach(element => {
        if($.inArray(element.name, excludeElementValidation) == -1){
            if(element.value == ''){
                form.find(`input[name='${element.name}'], select[name='${element.name}']`).addClass('jqueryValidation');
                form.find(`input[name='${element.name}'], select[name='${element.name}']`).siblings('.validationFail').show()
            }
            else{
                form.find(`input[name='${element.name}'], select[name='${element.name}']`).removeClass('jqueryValidation');
                form.find(`input[name='${element.name}'], select[name='${element.name}']`).siblings('.validationFail').hide()
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
      console.log('formDataArray:: ', formDataArray, 'ajaxUrl:: ', ajaxUrl, 'formDataSerialize:: ', formDataSerialize);
      $.ajax({
        type:"POST",
        url: ajaxUrl,
        data: formDataSerialize,
        success: function(response){
          console.log(`form submited`, response);
          if(response.status_code == 200){
            editCloseCompanyModal.modal('hide')
            toastr["success"](response.message);
            setTimeout(() => {
              window.location.href = response.result.path;
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
  })

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
});
</script>
@stop