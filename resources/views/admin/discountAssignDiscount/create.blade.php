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
        <form method="POST" action="{{ route('assign-discount.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
              <div class="col-sm-4">
                <div class="form-group {{ $errors->has('airport') ? 'has-error' : '' }}">
                    <label for="airport">Select Airport</label>
                    <select class="form-control select2" style="width: 100%;" name="airport" id="airport">
                        <option value="">Select airport</option>
                        @if($airport->count())
                          @foreach ($airport as $airport_key => $airport_value)
                              <option value="{{ $airport_value->id }}">{{ $airport_value->airport_name }}</option>
                          @endforeach
                        @endif
                    </select>
                    @if ($errors->first('airport'))
                        <span class="form-error">{{ $errors->first('airport') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                    <label for="company">Select Company</label>
                    <select class="form-control select2" style="width: 100%;" name="company" id="company">
                        <option value="">Select company</option>
                    </select>
                    @if ($errors->first('company'))
                        <span class="form-error">{{ $errors->first('company') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group {{ $errors->has('offer_type') ? 'has-error' : '' }}">
                    <label for="airport">Select Offer</label>
                    <select class="form-control select2" style="width: 100%;" name="offer_type" id="offer_type">
                        <option value="">Select offer</option>
                        @if($offer_type->count())
                          @foreach ($offer_type as $offer_type_key => $offer_type_value)
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
                style="text-align:right;float:right;">Submit</button>
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

    $(document).on('change','#airport',function(e){
      let targetEle = $(e.target);
      let selectedAirport = targetEle.val();
      let apiUrl = "{{ route('assign-discount.index') }}";
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
  });
</script>
@stop