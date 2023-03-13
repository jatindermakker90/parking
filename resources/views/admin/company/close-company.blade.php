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
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }}">
                    <label for="company_id">Company Name</label>
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
                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                    <label for="date">Select Start Date</label>
                    {{old('date')}}
                    <input type="date" class="form-control" name="date" id="date" value="{{ old('date') ?? '' }}">
                    @if ($errors->first('date'))
                        <span class="form-error">{{ $errors->first('date') }}</span>
                    @endif
                </div>
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
                style="text-align:left;">Submit</button>
          </div>
        </form>
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
});
</script>
@stop