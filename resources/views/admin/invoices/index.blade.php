@extends('adminlte::page')
@section('title', config('adminlte.title'))
@section('content_header')
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                  <label>From/To:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservationtime" placeholder="Please select date range">
                  </div>
                </div>
            </div>
            <div class="col-md-3">
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
              <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                  <label for="company">Suppliers</label>
                  <select class="form-control select2" style="width: 100%;" name="company" id="company">
                      <option value=""></option>
                  </select>
                  @if ($errors->first('company'))
                      <span class="form-error">{{ $errors->first('company') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <a style="margin-top: 30px;" class="btn btn-primary" target="_blank" href="invoices_supplier_excell_generator_all.php?from=2023-05-01&amp;to=2023-05-10&amp;air_id="><i class="fa fa-print"></i> Export to Excel</a>
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
      <div class="card-body">
        <table id="data_collection" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Company Name</th>
            <th>Total Bookings</th>
            <th>Gross Amount</th>
            <th>Commission</th>
            <th>Net Payable</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
          <tr>
            <th>Total</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
        </table>
        <div id="second" style="display:none;">
          <div class="row">
              <br>
              <div class="col-lg-12">
                  <h1 id="company_name1"></h1>
                  <p id="email_pro"></p>
                  <p id="contact_no"></p>
              </div>
          </div>
          <hr class="hr-normal">
          <div class="row">
              <div class="col-lg-10">
                  <b id="company_name2"></b>
              </div>
              <div class="col-lg-2">
                  <b>Date: 20 May 2023</b>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-10">
                  <b id="company_name3"></b>
              </div>
              <div class="col-lg-2">
                  <b></b>
              </div>
          </div>
          <hr class="hr-normal">
          <div class="row">
              <div "col-lg-12"="">
                  <h1 style="text-align:center;">Invoice  </h1>
              </div>
          </div>
          <table id="data_collection2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Ref No</th>
              <th>E Date</th>
              <th>R Date</th>
              <th>STAY</th>
              <th>SURNAME</th>
              <th>FIRSTNAME</th>
              <th>AMOUNT</th>
            </tr>
            </thead>
          </table>
          <hr class="hr-normal">
          <div class="row">
              <div class="col-lg-10">
                  <b>GRAND TOTAL</b>
              </div>
              <div class="col-lg-2">
                  <b>N/A</b>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-10">
                  <b>LESS COMMISSION</b>
              </div>
              <div class="col-lg-2">
                  <b>N/A</b>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-10">
                  <b>NET AMOUNT PAYABLE INCLUSIVE VAT</b>
              </div>
              <div class="col-lg-2">
                  <b>N/A</b>
              </div>
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
  #get_updated_price_warrning{
    color: red;
    display: none;
    font-size: 20px;
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
  $(document).ready(function(){
    // Date Selection
    var today = new Date();
    var time   = $('#reservationtime').val();
    var start_time = null;
    var end_time   = null;
    var selectedAirport = null;
    var selected_company = null;

    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = mm + '/' + dd + '/' + yyyy;
    searchData();

    $(document).on('change','#search_select_airport',function(e){
      let targetEle = $(e.target);
      selectedAirport = targetEle.val();
      let apiUrl = "{{ route('search_company') }}";
      let href = `${apiUrl}?airport_id=${selectedAirport}`;

      console.log(`selected selectedAirport`, selectedAirport, `apiUrl:: `, apiUrl);

      $.get(href, function(data) {
        console.log(`airport:: `, data)
        var message = null;
        var response_status  = data.success;
        let respData = data.result.companies;
        if(data.success){
          if(respData.length > 0){
            let html = `<option value="">Select company</option>`;
            respData.forEach(element => {
              html += `<option value="${element.id}">${element.company_title}</option>`
            });
            $('#company').html(html);
          }
        }else{
          
        }
      });

    });
    $(document).on('change','#company',function(e){
      $("#data_collection").hide();
      let targetEle = $(e.target);
      selected_company = targetEle.val();
      $('#data_collection2').dataTable().fnDestroy();
      loadMetaInfo();
      loadDataTable();
      $("#second").show();
    });

    $('#reservationtime').daterangepicker({
       timePicker: false,
       autoUpdateInput: false,
       locale: {
        format: 'MM/DD/YYYY',
        cancelLabel: 'Clear'
      }
    },function(start, end) {
        start_time = `${start.format('Y-M-D')} 00:00:00`;
        end_time   = `${end.format('Y-M-D')} 23:59:59`;
        $("#reservationtime").val(start.format('MM/DD/YYYY')+"-"+end.format('MM/DD/YYYY'));
        $('#data_collection').dataTable().fnDestroy();
        searchData();
    });

    function searchData(){
      let start_date      = start_time ?? '';
      let end_date        = end_time ?? '';
      $('#data_collection').DataTable({
      "paging"      : false,
      "pageLength"  : 10,
      "lengthChange": false,
      "searching"   : false,
      "ordering"    : true,
      "info"        : false,
      "autoWidth"   : false,
      "responsive"  : true,
      "processing"  : true,
      "serverSide"  : true,
      
      "ajax"        :"{{ url('admin/invoices') }}?start_date="+start_date+"&end_date="+end_date,
      "columns"     : [
            {
              data: 'company_title',         
              name: 'company_title',   
              orderable: false,
              render: function ( data, type, row) {
                if(type === 'sort'){
                    return data;
                }else{
                    return  data??'NA';
                }
              }
            },
            {
              data: 'total_booking',
              name: 'total_booking', 
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
              data: 'total_amount',
              name: 'total_amount',
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
              data: 'commission',
              name: 'commission',
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
              data: 'payout_amount',
              name: 'payout_amount',
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
        ], 
        footerCallback: function( tfoot, data, start, end, display ) {
            var api = this.api();
            for(i=1; i<=4; i++){
              $(api.column(i).footer()).html(
                api.column(i).data().reduce(function ( a, b ) {
                    if(i==1){ 
                      var sum = a + b;
                      return sum;
                    } else {
                      var sum = parseFloat(a) + parseFloat(b);
                      return sum.toFixed(2);
                    }
                }, 0)
              );
            }
        }
     });
    }

    function loadMetaInfo(){
      let apiUrl = "{{ route('company_base_metadata') }}";
      let href = `${apiUrl}?selected_company=${selected_company}`;
      $.get(href, function(data) {
        console.log(`airport:: `, data)
        var message = null;
        var response_status  = data.success;
        let respData = data.result;
        if(data.success){
          for($i=1; $i<=3; $i++){
            document.getElementById("company_name"+$i).innerHTML = respData.company_title;
          }
            let email_html = '<strong>Email : </strong>'+respData.company_email;
            $('#email_pro').html(email_html);
            let contact_html = '<strong>Phone : </strong>'+respData.company_phone;
            $('#contact_no').html(contact_html);
        }else{
          
        }
      });
    }
    function loadDataTable(){
      let start_date      = start_time ?? '';
      let end_date        = end_time ?? '';
      $('#data_collection2').DataTable({
      "paging"      : false,
      "pageLength"  : 10,
      "lengthChange": false,
      "searching"   : false,
      "ordering"    : true,
      "info"        : false,
      "autoWidth"   : false,
      "responsive"  : true,
      "processing"  : true,
      "serverSide"  : true,
      
      "ajax"        :"{{ url('admin/company/base/data') }}?start_date="+start_date+"&end_date="+end_date+"&selected_company="+selected_company,
      "columns"     : [
            {
              data: 'ref_id',         
              name: 'ref_id',   
              orderable: false,
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
              data: 'total_days',
              name: 'total_days',
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
              data: 'last_name',
              name: 'last_name',
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
              data: 'first_name',
              name: 'first_name',
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
              data: 'price',
              name: 'price',
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
        ]
     });
    }
  });
</script>
@stop
