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
        <form method="POST" action="{{ route('add-discount.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                    <label for="start_date">Select Start Date</label>
                    {{old('start_date')}}
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') ?? '' }}">
                    @if ($errors->first('start_date'))
                        <span class="form-error">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                    <label for="end_date">Select End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') ?? '' }}">
                    @if ($errors->first('end_date'))
                        <span class="form-error">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>
              </div>
            </div>
            <div class="row col-12">
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name"
                        name="name" id="name" value="{{ old('name') ?? '' }}">
                    @if ($errors->first('name'))
                        <span class="form-error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('offer_type') ? 'has-error' : '' }}">
                    <label for="offer_type">Select Offer</label>
                    <select class="form-control select2" style="width: 100%;" name="offer_type" id="offer_type">
                        <option value="">Select airport</option>
                        @if($get_offer_type->count())
                          @foreach ($get_offer_type as $offer_type_key => $offer_type_value)
                              <option value="{{ $offer_type_value->id }}">{{ $offer_type_value->name }}</option>
                          @endforeach
                        @endif
                    </select>
                    @if ($errors->first('offer_type'))
                        <span class="form-error">{{ $errors->first('offer_type') }}</span>
                    @endif
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
<!-- DataTables  & Plugins -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.select2').select2();
  });
</script>
@stop