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
        <form method="POST" action="{{ route('flat-discount.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
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
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('flat_code') ? 'has-error' : '' }}">
                    <label for="flat_code">Select Flat Code</label>
                    <select class="form-control select2" style="width: 100%;" name="flat_code" id="flat_code">
                        <option value="">Select flat code</option>
                        @if($get_flat_codes->count())
                          @foreach ($get_flat_codes as $flat_codes_key => $flat_codes_value)
                              <option value="{{ $flat_codes_value->id }}">{{ $flat_codes_value->name }}</option>
                          @endforeach
                        @endif
                    </select>
                    @if ($errors->first('flat_code'))
                        <span class="form-error">{{ $errors->first('flat_code') }}</span>
                    @endif
                </div>
              </div>
            </div>
            <div class="row col-12">
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="flat_code">Select Type</label>
                    <select class="form-control select2" style="width: 100%;" name="type" id="type">
                        <option value="percentage">Percentage</option>
                        <option value="amount">Amount</option>
                    </select>
                    @if ($errors->first('type'))
                        <span class="form-error">{{ $errors->first('type') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" placeholder="Enter Amount"
                        name="amount" id="amount" value="{{ old('amount') ?? '' }}">
                    @if ($errors->first('amount'))
                        <span class="form-error">{{ $errors->first('amount') }}</span>
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

    $(document).on('change','#offer_type',function(e){
      let targetEle = $(e.target);
      let selectedOfferType = targetEle.val();
      let apiUrl = "{{ route('flat-discount.index') }}";
      let href = `${apiUrl}?offer_type_id=${selectedOfferType}`;

      console.log(`selected offer type`, selectedOfferType, `apiUrl:: `, apiUrl);

      $.get(href, function(data) {
        console.log(`get offer type:: `, data)
        var message = null;
        var response_status  = data.success;
        let respData = data.result.offer_types;
        if(data.success){
          let html = `<option value="">Select flat code</option>`;
          respData.forEach(element => {
            html += `<option value="${element.id}">${element.name}</option>`
          });
          $('#flat_code').html(html);
        }else{
          
        }
      });

    });
  });
</script>
@stop