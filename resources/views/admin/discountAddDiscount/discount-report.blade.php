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
               <a href ="{{ route('add-discount.store') }}">
               <!-- <button type="button" class="btn btn-block btn-danger">Back</button> -->
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
        <form method="POST" action="{{ route('discoun-code-report') }}" enctype="multipart/form-data" id="discountReportFilter">
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
              <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('offer_type') ? 'has-error' : '' }}">
                    <label for="airport">Select Offer</label>
                    <select class="form-control select2" style="width: 100%;" required name="offer_type" id="offer_type">
                        <option value="">Select offer</option>
                        @if($offer_type->count())
                          @foreach ($offer_type as $offer_type_key => $offer_type_value)
                              <option value="{{ $offer_type_value->id }}">{{ $offer_type_value->name }}</option>
                          @endforeach
                        @endif
                    </select>
                    <span class="ajax-error">Please select offer type</span>
                    @if ($errors->first('offer_type'))
                        <span class="form-error">{{ $errors->first('offer_type') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                    <label for="start_date">Select Start Date</label>
                    {{old('start_date')}}
                    <input type="date" class="form-control" required name="start_date" id="start_date" value="{{ old('start_date') ?? '' }}">
                    <span class="ajax-error">Please select start date</span>
                    @if ($errors->first('start_date'))
                        <span class="form-error">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                    <label for="end_date">Select End Date</label>
                    <input type="date" class="form-control" required name="end_date" id="end_date" value="{{ old('end_date') ?? '' }}">
                    <span class="ajax-error">Please select end date</span>
                    @if ($errors->first('end_date'))
                        <span class="form-error">{{ $errors->first('end_date') }}</span>
                    @endif
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
  <div class="row" id="discount-report-result">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Result</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="data_collection" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Discount Code</th>
                                <!-- <th>Total # of Use</th> -->
                                <th>Status</th>
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
    <style>
        .has-error select {
        border-color: red;
        }
        .form-error{
        color:red;
        }
        .ajax-error{
            color:red;
            display: none;
        }
        #discount-report-result{
            display:none;
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

    $(document).on('click','#submitButton',function(e){
        e.preventDefault();
        let targetEle = $("#discountReportFilter");
        let formData = targetEle.serialize();
        let formDataArray = targetEle.serializeArray();

        if(formDataArray[0].value){
            $("#offer_type").siblings('.ajax-error').hide();
        }
        else{
            $("#offer_type").siblings('.ajax-error').show();
        }
        if(formDataArray[1].value){
            $("#start_date").siblings('.ajax-error').hide();
        }
        else{
            $("#start_date").siblings('.ajax-error').show();
        }
        if(formDataArray[2].value){
            $("#end_date").siblings('.ajax-error').hide();
        }
        else{
            $("#end_date").siblings('.ajax-error').show();
        }
        if(formDataArray[0].value && formDataArray[1].value && formDataArray[2].value){
            let apiUrl = targetEle.attr('action');
            let href = `${apiUrl}?${formData}`;
            
            // console.log(`selected formdata:: `, targetEle.serialize(), `apiUrl:: `, apiUrl);
            $("#discount-report-result").show();
            $("#data_collection").dataTable().fnDestroy()
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
                "ajax"        : href,
                "columns"     : [
                    {
                        data: 'DT_RowIndex',         
                        name: 'DT_RowIndex',   
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name', 
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
                            if(type === 'sort'){
                                return data;
                            }else{
                                return data;
                            }
                        }
                    }   
                ]
            });
        }
        else{
            return;
        }
    });
  });
</script>
@stop