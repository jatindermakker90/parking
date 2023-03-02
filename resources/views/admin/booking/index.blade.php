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
              <button type="button" class="btn btn-block btn-primary"> + Add {{ $title }}</button>
              </a>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
   
          </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
                <div class="form-group">
                  <label>Date and time range:</label>
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
                    <th>Sr No.</th>
                    <th>Company Name</th>
                    <th>PO Number</th>
                    <th>Booking Code</th>
                    <th>Product Name</th>
                    <th>Test Parameters</th>
                    <th>Cost</th>
                    <th>Print</th>
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
            {
              data: 'DT_RowIndex',         
              name: 'DT_RowIndex',   
              searchable: false,
              orderable: false
            },
            {
              data: 'user_name',
              name: 'user_name',
              searchable:false,
              orderable:false,
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
              data: 'po_number',
              name: 'po_number', 
              orderable: true,
              render: function ( data, type, row) {
                if(data){
                    return data;
                }else{
                    return "NA";
                }
              }
            },
            {
              data: 'booking_code',
              name: 'booking_code', 
              orderable: true
            },
            {
              data: 'product_name',
              name: 'product_name',
              searchable:false,
              orderable:false,
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
              data: 'test_parameter',
              name: 'test_parameter',
              orderable: true
            },
            {
              data: 'test_cost',
              name: 'test_cost',
              orderable: true
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
   $(document).on('click','.print_invoice',function(e){

    e.preventDefault();
      var delete_type     = $(this).data('id');
      var delete_message  = 'How do you want to generate this invoice ?';
      var success_message = 'Invoice generated successfully';
      var deny_message    = 'Invoice not deleted.';
      var href            = $(this).attr('href')+"?get_all=single_data";
      Swal.fire({
          title: delete_message,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Print',
          denyButtonText: `Multiple`,
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: href,
                type: 'GET',
                success:function(data){
                  $('.invoice-box').hide();
                  $('.invoice-box-second').show();
                  $('#invoice_modal').modal('show');
                   let response = data.result;
                   //let total_cost = 0;
                  let table_html = "";
                $.each(response.all_products, function (index, value) {
                     let total_cost = parseFloat(value.test_cost);
                     let cgst = 0;
                     let sgst = 0;
                     let igst = 0;
                    if(response.user.state != 'Himachal Pradesh'){
                     igst = parseFloat(total_cost * 0.18).toFixed(2);
                     total_cost = (parseFloat(total_cost) + parseFloat(igst)).toFixed(2);
                    }else{
                     cgst = parseFloat(total_cost * 0.09).toFixed(2);
                     sgst = parseFloat(total_cost * 0.09).toFixed(2);
                     total_cost = (parseFloat(total_cost) + parseFloat(cgst)).toFixed(2);
                     total_cost = (parseFloat(total_cost) + parseFloat(sgst)).toFixed(2);
                    }
                    table_html += "<table style='margin: auto;padding: 20px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;width: 100%;line-height: inherit;text-align: left;border-collapse: collapse;'>";
                    table_html += '<tr class="top">';
                    table_html += '<td colspan="2"><img src="../assets/images/ri_1.png" alt="Company logo" style="max-width: 1000px;width: 964px;" /></td>';
                    table_html += '</tr>';
                    table_html += '<tr class="information">';
                    table_html += '<td colspan="3">';
                    table_html += '<div style="border:1px solid;">';
                    table_html += '<div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;text-decoration:underline;">TAX INVOICE</div>';
                    table_html += '<div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;"> INVOICE NO: <span id ="invoice_number">'+yyyy+"/"+(value.id + 1)+'</span></div></div>';
                    table_html +=  '<div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;"> INVOICE DATED: <span id ="invoice_date">'+today+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">STATE: <span id ="state">Himachal Pradesh</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">REVERSE CHARGE(Y/N): <span id ="reverse_charge">N/A</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;text-decoration:underline;">BILL TO PARTY</div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">NAME: <span id ="company_name">'+response.user.company_name+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="text-align:left;float:left;padding:2px;"> ADDRESS: <span id ="company_address">'+response.user.street_address+", "+response.user.city+", "+response.user.state+", "+response.user.country+" ("+response.user.zipcode+")"+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">CLIENT GSTIN NO.: <span id ="company_gstin">'+response.user.gst_number+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">STATE: <span id ="company_state">'+response.user.state+'</span></div></div><table style="border-collapse:collapse !important"><tr class="heading"><td style="border:2px solid black;">Po Number</td><td style="border:2px solid black;">Billing Code</td> <td style="border:2px solid black;">Product Name</td><td style="border:2px solid black;">Test Parameter</td><td style="border:2px solid black;">Test Method</td><td style="border:2px solid black;">Test Cost</td></tr><tr class="details"><td style="border:2px solid black;">'+value.po_number+'</td><td style="border:2px solid black;">'+value.booking_code+'</td><td style="border:2px solid black;">'+value.product_name+'</td><td style="border:2px solid black;">'+value.test_parameter+'</td><td style="border:2px solid black;">'+value.test_method+'</td><td style="border:2px solid black;">'+value.test_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;font-weight: bold;" colspan="2">TOTAL INVOICE AMOUNT IN WORDS</td><td style="border:2px solid black;" colspan="2">TOTAL AMOUNT BEFORE TAX</td><td style="border:2px solid black;" id="total_amount_before_tax" colspan="2">'+value.test_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">'+toWords(total_cost)+'</td><td style="border:2px solid black;text-align:left;" colspan="2">ADD CGST @ 9%</td><td style="border:2px solid black;" id="cgst" colspan="2">'+cgst+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;text-decoration:underline;font-style: italic;" colspan="2">BANK DETAILS FOR NEFT/RTGS</td><td style="border:2px solid black;text-align:left;" colspan="2">ADD SGST @ 9%</td><td style="border:2px solid black;" id="sgst" colspan="2">'+sgst+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">BENEFICIARY NAME: Shiva Testing & Research Laboratory Pvt. Ltd.</td><td style="border:2px solid black;text-align:left;" colspan="2">ADD IGST @ 18%</td><td style="border:2px solid black;" id="igst" colspan="2">'+igst+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">BANK: Canara BANK</td><td style="border:2px solid black;text-align:left;" colspan="2">TOTAL AMOUNT AFTER TAX</td><td style="border:2px solid black;" id="total_amount_after_tax" colspan="2">'+total_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">CA ACCOUNT NO: 120001925729</td><td style="border:2px solid black;text-align:left;" colspan="2">ADVANCE PAYMENT AMOUNT</td><td style="border:2px solid black;" id="advance_amount" colspan="2">NA</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">IFSC CODE : CNRB0018991</td><td style="border:2px solid black;text-align:left;" colspan="2">NET AMOUNT</td><td style="border:2px solid black;" id="net_amount" colspan="2">'+total_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;"></td><td style="border:2px solid black;text-align:left;" colspan="6">Certified that the particulars given above are true and correct for <span style="font-weight:bold;">Shiva Testing and Research Laboratory Private limited</span>.</td></tr><tr><td style="border:2px solid black;text-align:center;font-weight:bold;">Customer Signature</td><td style="border:2px solid black;text-align:left;" colspan="6"></td></tr></table></div></td></tr></table>';
                   // total_cost += parseFloat(value.test_cost);
                  });
                  $('.invoice-box-second').html(table_html);

                },
              });
            }else{

            }
      });
  });
  $(document).on('click','.print_all_invoice',function(e){

      e.preventDefault();
      var delete_type     = $(this).data('id');
      var delete_message  = 'How do you want to generate this invoice ?';
      var success_message = 'Invoice generated successfully';
      var deny_message    = 'Invoice not deleted.';
      var href            = $(this).attr('href')+"?get_all=all_data";
      Swal.fire({
          title: delete_message,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Print',
          denyButtonText: `Multiple`,
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: href,
                type: 'GET',
                success:function(data){
                  $('.invoice-box').hide();
                  $('.invoice-box-second').show();
                  $('#invoice_modal').modal('show');
                   let response = data.result;
                   //let total_cost = 0;
                  let table_html = "";
                $.each(response.all_products, function (index, value) {
                     let total_cost = parseFloat(value.test_cost);
                     let cgst = 0;
                     let sgst = 0;
                     let igst = 0;
                    if(response.user.state != 'Himachal Pradesh'){
                     igst = parseFloat(total_cost * 0.18).toFixed(2);
                     total_cost = (parseFloat(total_cost) + parseFloat(igst)).toFixed(2);
                    }else{
                     cgst = parseFloat(total_cost * 0.09).toFixed(2);
                     sgst = parseFloat(total_cost * 0.09).toFixed(2);
                     total_cost = (parseFloat(total_cost) + parseFloat(cgst)).toFixed(2);
                     total_cost = (parseFloat(total_cost) + parseFloat(sgst)).toFixed(2);
                    }
                    table_html += "<table style='margin-top: 80px;max-width: 1200px;margin: auto;padding: 20px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;width: 100%;line-height: inherit;text-align: left;border-collapse: collapse;>";
                    table_html += '<tr class="top">';
                    table_html += '<td colspan="2"><img src="../assets/images/ri_1.png" alt="Company logo"  style="max-width: 1000px;width: 964px;"/></td>';
                    table_html += '</tr>';
                    table_html += '<tr class="information">';
                    table_html += '<td colspan="3">';
                    table_html += '<div style="border:1px solid;">';
                    table_html += '<div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;text-decoration:underline;">TAX INVOICE</div>';
                    table_html += '<div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;"> INVOICE NO: <span id ="invoice_number">'+yyyy+"/"+(value.id + 1)+'</span></div></div>';
                    table_html +=  '<div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;"> INVOICE DATED: <span id ="invoice_date">'+today+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">STATE: <span id ="state">Himachal Pradesh</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">REVERSE CHARGE(Y/N): <span id ="reverse_charge">N/A</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;text-decoration:underline;">BILL TO PARTY</div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">NAME: <span id ="company_name">'+response.user.company_name+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="text-align:left;float:left;padding:2px;"> ADDRESS: <span id ="company_address">'+response.user.street_address+", "+response.user.city+", "+response.user.state+", "+response.user.country+" ("+response.user.zipcode+")"+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">CLIENT GSTIN NO.: <span id ="company_gstin">'+response.user.gst_number+'</span></div></div><div style="border:1px solid;height:30px;text-align:center;font-weight:bolder;"><div style="width:50%;text-align:left;float:left;padding:2px;">STATE: <span id ="company_state">'+response.user.state+'</span></div></div><table  style="border-collapse:collapse !important"><tr class="heading"><td style="border:2px solid black;">Po Number</td><td style="border:2px solid black;">Billing Code</td> <td style="border:2px solid black;">Product Name</td><td style="border:2px solid black;">Test Parameter</td><td style="border:2px solid black;">Test Method</td><td style="border:2px solid black;">Test Cost</td></tr><tr class="details"><td style="border:2px solid black;">'+value.po_number+'</td><td style="border:2px solid black;">'+value.booking_code+'</td><td style="border:2px solid black;">'+value.product_name+'</td><td style="border:2px solid black;">'+value.test_parameter+'</td><td style="border:2px solid black;">'+value.test_method+'</td><td style="border:2px solid black;">'+value.test_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;font-weight: bold;" colspan="2">TOTAL INVOICE AMOUNT IN WORDS</td><td style="border:2px solid black;" colspan="2">TOTAL AMOUNT BEFORE TAX</td><td style="border:2px solid black;" id="total_amount_before_tax" colspan="2">'+value.test_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">'+toWords(total_cost)+'</td><td style="border:2px solid black;text-align:left;" colspan="2">ADD CGST @ 9%</td><td style="border:2px solid black;" id="cgst" colspan="2">'+cgst+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;text-decoration:underline;font-style: italic;" colspan="2">BANK DETAILS FOR NEFT/RTGS</td><td style="border:2px solid black;text-align:left;" colspan="2">ADD SGST @ 9%</td><td style="border:2px solid black;" id="sgst" colspan="2">'+sgst+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">BENEFICIARY NAME: Shiva Testing & Research Laboratory Pvt. Ltd.</td><td style="border:2px solid black;text-align:left;" colspan="2">ADD IGST @ 18%</td><td style="border:2px solid black;" id="igst" colspan="2">'+igst+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">BANK: Canara BANK</td><td style="border:2px solid black;text-align:left;" colspan="2">TOTAL AMOUNT AFTER TAX</td><td style="border:2px solid black;" id="total_amount_after_tax" colspan="2">'+total_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">CA ACCOUNT NO: 120001925729</td><td style="border:2px solid black;text-align:left;" colspan="2">ADVANCE PAYMENT AMOUNT</td><td style="border:2px solid black;" id="advance_amount" colspan="2">NA</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;" colspan="2">IFSC CODE : CNRB0018991</td><td style="border:2px solid black;text-align:left;" colspan="2">NET AMOUNT</td><td style="border:2px solid black;" id="net_amount" colspan="2">'+total_cost+'</td></tr><tr style="text-align:center;"><td style="border:2px solid black;text-align:left;"></td><td style="border:2px solid black;text-align:left;" colspan="6">Certified that the particulars given above are true and correct for <span style="font-weight:bold;">Shiva Testing and Research Laboratory Private limited</span>.</td></tr><tr><td style="border:2px solid black;text-align:center;font-weight:bold;">Customer Signature</td><td style="border:2px solid black;text-align:left;" colspan="6"></td></tr></table></div></td></tr></table>';
                   // total_cost += parseFloat(value.test_cost);
                  });
                  $('.invoice-box-second').html(table_html);

                },
              });
            }else{

            }
      });
  });
   $(document).on('click','.generate_modal',function(e){
    printDiv();
   });
 function toWords(value){
  let amount = value.split(".");
   let first_amount = amountWords(amount[0]);
   if(parseInt(amount[1])){
   let sec_amount = amountWords(amount[1]);
    first_amount += " point ";
    first_amount += sec_amount;
   }
   return first_amount+" only";
 }
function amountWords(amount) {
          var words = new Array();
            words[0] = '';
            words[1] = 'One';
            words[2] = 'Two';
            words[3] = 'Three';
            words[4] = 'Four';
            words[5] = 'Five';
            words[6] = 'Six';
            words[7] = 'Seven';
            words[8] = 'Eight';
            words[9] = 'Nine';
            words[10] = 'Ten';
            words[11] = 'Eleven';
            words[12] = 'Twelve';
            words[13] = 'Thirteen';
            words[14] = 'Fourteen';
            words[15] = 'Fifteen';
            words[16] = 'Sixteen';
            words[17] = 'Seventeen';
            words[18] = 'Eighteen';
            words[19] = 'Nineteen';
            words[20] = 'Twenty';
            words[30] = 'Thirty';
            words[40] = 'Forty';
            words[50] = 'Fifty';
            words[60] = 'Sixty';
            words[70] = 'Seventy';
            words[80] = 'Eighty';
            words[90] = 'Ninety';
            amount = amount.toString();
            var atemp = amount.split(".");
            var number = atemp[0].split(",").join("");
            var n_length = number.length;
            var words_string = "";
            if (n_length <= 9) {
                var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                var received_n_array = new Array();
                for (var i = 0; i < n_length; i++) {
                    received_n_array[i] = number.substr(i, 1);
                }
                for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                    n_array[i] = received_n_array[j];
                }
                for (var i = 0, j = 1; i < 9; i++, j++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        if (n_array[i] == 1) {
                            n_array[j] = 10 + parseInt(n_array[j]);
                            n_array[i] = 0;
                        }
                    }
                }
                value = "";
                for (var i = 0; i < 9; i++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        value = n_array[i] * 10;
                    } else {
                        value = n_array[i];
                    }
                    if (value != 0) {
                        words_string += words[value] + " ";
                    }
                    if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Crores ";
                    }
                    if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Lakhs ";
                    }
                    if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Thousand ";
                    }
                    if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                        words_string += "Hundred and ";
                    } else if (i == 6 && value != 0) {
                        words_string += "Hundred ";
                    }
                }
                words_string = words_string.split("  ").join(" ");
            }
            return words_string;
}
  function printDiv() {
      var divContents = document.getElementById("modal_content_body").innerHTML;
      var a = window.open('', '');
      a.document.write('<html>');
      a.document.write('<body>');
      a.document.write(divContents);
      a.document.write('</body></html>');
      a.document.close();

      setTimeout(function() {
        a.print();
        a.close();
      }, 250);
  }

  
    
});
</script>
@stop