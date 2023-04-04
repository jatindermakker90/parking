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
                    <!-- <th>Manage Price</th> -->
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

        <div class="modal fade" id="operations_modal">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <form id="company_operations_form" enctype="multipart/form-data">
                <input type="hidden" name="company_id" id="operation_modal_company_id">
                <input type="hidden" name="id" id="operation_modal_operation_id">
                <div class="modal-header">
                  <h4 class="modal-title">Compny Operations</h4>
                  <button type="button" class="close close-operations-button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <div class="col-4">
                        <h5>Operation Type</h5>
                    </div>
                    <div class="col-8">
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary">
                          <input type="radio" name="operating_type" value="twenty_four_into_seven" id="operating_type_1" autocomplete="off"> 24/7
                        </label>
                        <label class="btn btn-secondary">
                          <input type="radio" name="operating_type" value="flexible" id="operating_type_2" autocomplete="off"> Flexible
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3 24-7-opening-status-div">
                    <div class="col-4">
                      <h5>Opening Status</h5>
                    </div>
                    <div class="col-8">
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary">
                          <input type="radio" name="twenty_four_into_seven[status]" value="open" id="twenty_four_into_seven_status_1" autocomplete="off"> Open
                        </label>
                        <label class="btn btn-secondary">
                          <input type="radio" name="twenty_four_into_seven[status]" value="close" id="twenty_four_into_seven_status_2" autocomplete="off"> Closed
                        </label>
                      </div>
                      <div class="validationFail">Status required !</div>
                    </div>
                  </div>
                  <div class="row flexible-opening-status" >
                    <div class="col-1">

                    </div>
                    <div class="col-11">
                      <div class="row mb-2">
                        <div class="col-1">
                          <div></div>
                        </div>
                        <div class="col-2">
                          <div class="mr-2">Open hour</div>
                        </div>
                        <div class="col-2">
                          <div>Close hour</div>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-2"></div>
                        <div class="col-2"></div>
                      </div>
                      <!-- monday -->
                      <div class="row mb-3 day-row monday">
                        <div class="col-1">
                          <div>Monday</div>
                          <input type="hidden" name="flexible[monday][day]" value="monday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="monday" name="flexible[monday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="monday" name="flexible[monday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3">
                          <div class="btn-group btn-group-toggle w-100 service" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[monday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[monday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" name="flexible[monday][service]" checked value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" name="flexible[monday][status]" checked value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[monday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- tuesday -->
                      <div class="row mb-3 day-row tuesday">
                        <div class="col-1">
                          <div>Tuesday</div>
                          <input type="hidden" name="flexible[tuesday][day]" value="tuesday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="tuesday" name="flexible[tuesday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="tuesday" name="flexible[tuesday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3 service">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[tuesday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[tuesday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" name="flexible[tuesday][service]" checked value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" name="flexible[tuesday][status]" checked value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[tuesday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- Wednesday -->
                      <div class="row mb-3 day-row wednesday">
                        <div class="col-1">
                          <div>Wednesday</div>
                          <input type="hidden" name="flexible[wednesday][day]" value="wednesday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="wednesday" name="flexible[wednesday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="wednesday" name="flexible[wednesday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3 service">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[wednesday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[wednesday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" checked name="flexible[wednesday][service]" value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" name="flexible[wednesday][status]" checked value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[wednesday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- Thursday -->
                      <div class="row mb-3 day-row thursday">
                        <div class="col-1">
                          <div>Thursday</div>
                          <input type="hidden" name="flexible[thursday][day]" value="thursday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="thursday" name="flexible[thursday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="thursday" name="flexible[thursday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3 service">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[thursday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[thursday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" checked name="flexible[thursday][service]" value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" checked name="flexible[thursday][status]" value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[thursday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- Friday -->
                      <div class="row mb-3 day-row friday">
                        <div class="col-1">
                          <div>Friday</div>
                          <input type="hidden" name="flexible[friday][day]" value="friday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="friday" name="flexible[friday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="friday" name="flexible[friday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3 service">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[friday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[friday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" checked name="flexible[friday][service]" value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" checked name="flexible[friday][status]" value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[friday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- Saturday -->
                      <div class="row mb-3 day-row saturday">
                        <div class="col-1">
                          <div>Saturday</div>
                          <input type="hidden" name="flexible[saturday][day]" value="saturday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="saturday" name="flexible[saturday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="saturday" name="flexible[saturday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3 service">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[saturday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[saturday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" checked name="flexible[saturday][service]" value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" checked name="flexible[saturday][status]" value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[saturday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- Sunday -->
                      <div class="row mb-3 day-row sunday">
                        <div class="col-1">
                          <div>Sunday</div>
                          <input type="hidden" name="flexible[sunday][day]" value="sunday">
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control start_time" data-day="sunday" name="flexible[sunday][start_time]" type="time">
                          <div class="validationFail">Start time required !</div>
                        </div>
                        <div class="col-2">
                          <input class="w-100 form-control end_time" disabled data-day="sunday" name="flexible[sunday][end_time]" type="time">
                          <div class="validationFail">End time required !</div>
                        </div>
                        <div class="col-3 service">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn bg-olive">
                              <input class="w-100 arrival" type="radio" name="flexible[sunday][service]" value="arrival" autocomplete="off"> Arrival
                            </label>
                            <label class="btn bg-olive">
                              <input class="w-100 departure" type="radio" name="flexible[sunday][service]" value="departure" autocomplete="off"> Departure
                            </label>
                            <label class="btn bg-olive active">
                              <input class="w-100 both" type="radio" checked name="flexible[sunday][service]" value="both" autocomplete="off"> Both
                            </label>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-2 status">
                          <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                              <input class="open" type="radio" checked name="flexible[sunday][status]" value="open" autocomplete="off"> Open
                            </label>
                            <label class="btn btn-secondary">
                              <input class="close" type="radio" name="flexible[sunday][status]" value="close" autocomplete="off"> Closed
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary w-100" id="company_operations_submit_button">Update</button>
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
  function getDay(string){
    let weekDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    let day = '';
    $.each(weekDays, (key, ele)=>{
      if(string.search(ele) != -1){
        day = ele;
      }
    })
    return day;
  }
  function getKey(string){
    return string.split("[")[2].slice(0, -1);
  }
$(document).ready(function(){
    let managePlanModel = $('#manage_price_modal').modal({
      keyboard: false
    })
    let operationsModel = $('#operations_modal').modal({
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
            // {
            //   data: 'manage_price',
            //   name: 'manage_price',
            //   orderable: true,
            //   render: function ( data, type, row) {
            //     if(type == 'display'){
            //         return data;
            //     }else if(type === 'sort'){
            //         return data;
            //     }else{
            //         return data;
            //     }
            //   }
            // },
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
  $(document).on('click', '.close-operations-button', (e)=>{
    operationsModel.modal('hide');
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

    let company_id  = $(this).data('id');
    let operation_id  = $(this).data('operation');
    let operation_url  = $(this).attr('href');
    console.log('company_id:: ', company_id, 'operation_url:: ', operation_url);
    let modal = $("#operations_modal");
    let twentyFouropeningStatus = $("#operations_modal").find('.24-7-opening-status-div');
    let flexibleOpeningStatus = $("#operations_modal").find('.flexible-opening-status');
    
    let modalInputField = $(modal).find('input[name=operating_type]');
    
    console.log('element length :: ', $(modalInputField).length)
    $(twentyFouropeningStatus).hide(); 
    $(flexibleOpeningStatus).hide();
    $(modal).find("#operation_modal_company_id").val(company_id);
    $(modal).find("#operation_modal_operation_id").val(operation_id);

    $.each( modalInputField, function( key, element ) {
      if($(element).attr('type') == 'radio'){
        if($(element).is(":checked")){
          $(element).attr('checked', false);
          $(element).parent().removeClass('active');
        }
      }
    });

    $(twentyFouropeningStatus).find('input[type=radio]').each((key, element)=>{
      if($(element).is(":checked")){
          $(element).attr('checked', false);
          $(element).parent().removeClass('active');
        }
    })

    if(operation_id){
      $.ajax({
        type:"GET",
        url: operation_url,
        success: function(response){
          console.log(`form submited`, response);
          if(response.status_code == 200){
            
            let data = response.result.operation;
            let operationType = data.operation_type;
            let weekdays = JSON.parse(data.weekdays);
            console.log("weekdays:: ", weekdays);

            $.each( modalInputField, function( key, element ) {
              if($(element).val() == operationType){
                $(element).trigger('click');
              }
            });

            if(operationType == 'twenty_four_into_seven'){
              let operationTypeStatus = weekdays.monday.status;
              let statusEle = $(modal).find(".24-7-opening-status-div").find("input[type=radio]");
              $.each( statusEle, function( key, element ) {
                if($(element).val() == operationTypeStatus){
                  $(element).trigger('click');
                }
              });
            }
            else{
              let statusEle = $(modal).find(".flexible-opening-status").find(".day-row");
              $.each( statusEle, function( key, element ) {
                console.log('ele:: ', element);
                switch (true) {
                  case $(element).hasClass('monday'):
                    console.log('week day :: ', weekdays.monday);
                    let everyDay1 = weekdays.monday;
                    $(element).find("input.start_time").val(everyDay1.start_time);
                    $(element).find("input.end_time").val(everyDay1.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay1.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay1.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                  case $(element).hasClass('tuesday'):
                    console.log('week day :: ', weekdays.tuesday);
                    let everyDay2 = weekdays.tuesday;
                    $(element).find("input.start_time").val(everyDay2.start_time);
                    $(element).find("input.end_time").val(everyDay2.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay2.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay2.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                  case $(element).hasClass('wednesday'):
                    console.log('week day :: ', weekdays.wednesday);
                    let everyDay3 = weekdays.wednesday;
                    $(element).find("input.start_time").val(everyDay3.start_time);
                    $(element).find("input.end_time").val(everyDay3.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay3.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay3.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                  case $(element).hasClass('thursday'):
                    console.log('week day :: ', weekdays.thursday);
                    let everyDay4 = weekdays.thursday;
                    $(element).find("input.start_time").val(everyDay4.start_time);
                    $(element).find("input.end_time").val(everyDay4.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay4.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay4.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                  case $(element).hasClass('friday'):
                    console.log('week day :: ', weekdays.friday);
                    let everyDay5 = weekdays.friday;
                    $(element).find("input.start_time").val(everyDay5.start_time);
                    $(element).find("input.end_time").val(everyDay5.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay5.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay5.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                  case $(element).hasClass('saturday'):
                    console.log('week day :: ', weekdays.saturday);
                    let everyDay6 = weekdays.saturday;
                    $(element).find("input.start_time").val(everyDay6.start_time);
                    $(element).find("input.end_time").val(everyDay6.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay6.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay6.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                  case $(element).hasClass('sunday'):
                    console.log('week day :: ', weekdays.sunday);
                    let everyDay7 = weekdays.sunday;
                    $(element).find("input.start_time").val(everyDay7.start_time);
                    $(element).find("input.end_time").val(everyDay7.end_time).attr('disabled', false);
                    $(element).find(".service input[type=radio]").each((key, ele)=>{
                      if($(ele).val() == everyDay7.service){
                        $(ele).trigger('click');
                      }
                    });
                    $(element).find(".status input[type=radio]").each((key, ele)=>{
                      console.log('status ele:: ', ele);
                      if($(ele).val() == everyDay7.status){
                        $(ele).trigger('click');
                      }
                    });
                    break;
                
                  default:
                    break;
                }
              });
            }
            operationsModel.modal('show');
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
    else{
      console.log('operation_id:: ', operation_id);
      
      
      operationsModel.modal('show');
      $(modal).find('#operating_type_1').trigger('click');
    }
  });

  $(document).on('click','#operating_type_1',function(e){
    let modal = $("#operations_modal");
    let twentyFouropeningStatus = $(modal).find('.24-7-opening-status-div');
    let flexibleOpeningStatus = $(modal).find('.flexible-opening-status');
    
    if(!$(twentyFouropeningStatus).is(":visible")){
      $(twentyFouropeningStatus).show();
    }

    if($(flexibleOpeningStatus).is(":visible")){
      $(flexibleOpeningStatus).hide();
    }
  })

  $(document).on('click','#operating_type_2',function(e){
    let modal = $("#operations_modal");
    let twentyFouropeningStatus = $(modal).find('.24-7-opening-status-div');
    let flexibleOpeningStatus = $(modal).find('.flexible-opening-status');
    
    if($(twentyFouropeningStatus).is(":visible")){
      $(twentyFouropeningStatus).hide();
    }

    if(!$(flexibleOpeningStatus).is(":visible")){
      $(flexibleOpeningStatus).show();
    }
  })

  $(document).on('change', '.start_time', (e) => {
    let targetValue = $(e.target).val();
    let day = $(e.target).data('day');
    console.log('day:: ', day);
    let closestEndTimeEle = $(e.target).parents(`.${day}`).find('.end_time');
    let closestEndTime = $(closestEndTimeEle).val();

    if(closestEndTime){
      var beginningTime = moment(targetValue, 'HH:mm');
      var endTime = moment(closestEndTime, 'HH:mm');
      let isStartTimeGraterThenEndTime = beginningTime.isBefore(endTime);
      if(!isStartTimeGraterThenEndTime){
        $(e.target).val(null);
        $(closestEndTimeEle).val(null);
        $(closestEndTimeEle).attr('disabled', true)
        toastr["error"]("Start time should be grater then end time !");
      }
    }
    else{
      $(closestEndTimeEle).attr('disabled', false)
    }
  })
  $(document).on('change', '.end_time', (e) => {
    let targetValue = $(e.target).val();
    let day = $(e.target).data('day');
    let closestStartTimeEle = $(e.target).parents(`.${day}`).find('.start_time');
    let closestStartTime = $(closestStartTimeEle).val();

    if(closestStartTime){
      var endTime = moment(targetValue, 'HH:mm');
      var beginningTime = moment(closestStartTime, 'HH:mm');
      let isEndTimeGraterThenStartTime = endTime.isBefore(beginningTime);
      if(isEndTimeGraterThenStartTime){
        $(e.target).val(null);
        $(closestStartTimeEle).val(null);
        $(e.target).attr('disabled', true)
        toastr["error"]("End time should be less then Start time !");
      }
    }
  })
  
  $(document).on('click', '#company_operations_submit_button', (e) => {
    e.preventDefault();

    let form = $('#company_operations_form');
    let ajaxUrl = "{{ route('save-company-operations') }}"
    let formDataSerialize = $(form).serialize();
    let formDaraArray = $(form).serializeArray();
    let validationKey = ["start_time", "end_time"];
    let skipKeys = ['twenty_four_into_seven[status]', 'operating_type', 'company_id', 'id'];

    console.log("formDaraArray", formDaraArray, 'form data length:: ', formDaraArray.length);
    
    if(formDaraArray.length > 0){
      let validationPass = false;

      let selectedOperantionType = formDaraArray[2].value;

      console.log('selectedOperantionType:: ', selectedOperantionType);

      if(selectedOperantionType == 'twenty_four_into_seven'){
        // console.log('come in 24/7 condition');
        $.each(formDaraArray, (index, ele)=>{
          if(ele.name == `twenty_four_into_seven[status]`){
            console.log('element found');
            validationPass = true;
            return false;
          }
          else{
            console.log('element not found');
            validationPass = false;
          }
        });
        if(!validationPass){
          $("#twenty_four_into_seven_status_1").parents('.btn-group').siblings('.validationFail').show();
          // $(`<div class="text-danger">Select operation status</div>`).insertAfter($("#twenty_four_into_seven_status_1").parents('.btn-group'));
          return;
        }
        else{
          $("#twenty_four_into_seven_status_1").parents('.btn-group').siblings('.validationFail').hide();
          // $("#twenty_four_into_seven_status_1").parents('.btn-group').siblings('div').remove();
        }
      }
      if(selectedOperantionType == 'flexible'){
        console.log('come in flexible condition');
        $.each(formDaraArray, (index, ele)=>{
          console.log('ele:: ', ele)
          if($.inArray(ele.name, skipKeys) == -1){
            let key = getKey(ele.name);
            if($.inArray(key, validationKey) != -1){
              let day = getDay(ele.name);
              if(ele.value == ''){
                let field = $(form).find(`div.${day}`).find(`.${key}`).siblings('.validationFail').show();
              }
              else{
                let field = $(form).find(`div.${day}`).find(`.${key}`).siblings('.validationFail').hide();
              }
            }
          }
        });
        $.each(formDaraArray, (index, ele)=>{
          if($.inArray(ele.name, skipKeys) == -1){
            let key = getKey(ele.name);
            if($.inArray(key, validationKey) != -1){
              let day = getDay(ele.name);
              if(ele.value == ''){
                validationPass = false;
              }
              else{
                validationPass = true;
              }
            }
          }
        });
        if(!validationPass){
          return;
        }
      }
      if(validationPass){
        $.ajax({
          type:"POST",
          url: ajaxUrl,
          data: formDataSerialize,
          success: function(response){
            console.log(`form submited`, response);
            if(response.status_code == 200){
              operationsModel.modal('hide');
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
    }

  })
    
});
</script>
@stop