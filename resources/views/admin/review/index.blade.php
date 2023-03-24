@extends('adminlte::page')
@section('title', config('adminlte.title'))
@section('content_header')
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
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
                    <th>Review id</th>
                    <th>Company</th>
                    <th>Review Date</th>
                    <th>Publish Date</th>
                    <th>Reference Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Over All Rating</th>
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
<script src="{{ asset('vendor/jquery-barrating/barrating.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function(){

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
      "ajax"        :"{{ url('admin/review/list') }}",
      "columns"     : [
            {
              data: 'id',
              name: 'id',
              orderable: true
            },
            {
              data: 'airport_name',
              name: 'airport_name',
              orderable: true
            },
            {
              data: 'operating_location',
              name: 'operating_location',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return '2023-02-23';
                }else if(type === 'sort'){
                    return '2023-02-23';
                }else{
                    return '2023-02-23';
                }
              }
            },
            {
              data: 'status_name',
              name: 'status_name',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return '2023-02-23';
                }else if(type === 'sort'){
                    return '2023-02-23';
                }else{
                    return '2023-02-23';
                }
              }
            },
            {
              data: 'reference_number',
              name: 'reference_number',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return 'P4U-430856';
                }else if(type === 'sort'){
                    return 'P4U-430856';
                }else{
                    return 'P4U-430856';
                }
              }
            },
            {
              data: 'name',
              name: 'name',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return 'Test User';
                }else if(type === 'sort'){
                    return 'Test User';
                }else{
                    return 'Test User';
                }
              }
            },
            {
              data: 'email',
              name: 'email',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return 'test@gmail.com';
                }else if(type === 'sort'){
                    return 'test@gmail.com';
                }else{
                    return 'test@gmail.com';
                }
              }
            },
            {
              data: 'stars',
              name: 'stars',
              orderable:false,
              searchable:false
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
$(function(){ $('#overall_1').barrating({
			                    theme: 'fontawesome-stars',
			                    initialRating: '1',
			                    readonly : 'true',
		                    	initialRating: '5'
		                  });
		            });
		            	$(document).ready(function(){
							$("#approve_1").click(function(){
							setTimeout(function() {
							var reviewID = '';
					        reviewID = $.QueryString("reviewID");
					        //for this function you have to include querystring library
					        $.ajax({
							 	data: {reviewID : reviewID},
								type: "POST",
								success: function(data){
									console.log(data);
									if (data === 'approved')
										{
										$("#approve_1").text("unapprove");
										}
										if (data === 'unapproved')
										{
											$("#approve_1").text("Approve");
										}
									}
								});
					        }, 200);
							});
							//for delete button
							$("#delete_1").click(function(){
							setTimeout(function() {
							var DeleteID = '';
					        DeleteID = $.QueryString("DeleteID");
					        $.ajax({
							 	data: {DeleteID : DeleteID},
								type: "POST",
								success: function(data){
										if (data === 'Deleted') {
											setTimeout(function(){
											       window.location.reload();
											      }, 100);
										}
									}
								});
					        }, 200);
							});
						});
</script>
@stop
