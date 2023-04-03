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
        <div class="modal show" id="modal-default" style="display:none;">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Review Details</h4>
                <button type="button" class="close close-edit-booking-button" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                    <h4 id="editBookingResponse"></h4>
                        @csrf
                        <div id="booking-edit-modal">

                        </div>
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
              data: 'company',
              name: 'company',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return row.company;
                }
              }
            },
            {
              data: 'review_date',
              name: 'review_date',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return row.review_date;
                }
              }
            },
            {
              data: 'publish_date',
              name: 'publish_date',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return row.review.publish_date;
                }
              }
            },
            {
              data: 'ref_id',
              name: 'reference_number',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return row.ref_id;
                }
              }
            },
            {
              data: 'name',
              name: 'name',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return row.name;
                }
              }
            },
            {
              data: 'email',
              name: 'email',
              render: function ( data, type, row) {
                if(type == 'display'){
                    return row.email;
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
      var delete_message  = 'Do you want to delete Review';
      var success_message = 'Review deleted successfully';
      var deny_message    = 'Review not deleted.';
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

  $(document).on('click','.approve',function(e){

    e.preventDefault();
      var approve_type     = $(this).data('type');
      var delete_message  = 'Do you want to '+approve_type+' this Review ?';
      var success_message = approve_type+' successfully';
      var deny_message    = approve_type+' denied.';
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
                type: 'GET',
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
