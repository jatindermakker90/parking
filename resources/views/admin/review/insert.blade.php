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
               <a href ="{{ route('airport.index') }}">
               <button type="button" class="btn btn-block btn-danger">Back</button>
               </a>
            </ol>
          </div>
        </div>
      </div>
@stop
@section('content')
<div id="main-wrapper">
  <div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel panel-white">
      <div class="panel-body">
          {{ Form::open(['route' => 'list.store','method' => 'post']) }}
            <div class="row">
              <div class="col-md-2">
                <label><b>Booking Date</b></label>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <span>{{ $data->created_at }}</span>
                </div>
              </div>
              <div class="col-md-2">
                <label><b>Departure Date</b></label>
              </div>
            <div class="col-md-2">
              <div class="form-group">
                <span>{{ $data->dep_date_time }}</span>
              </div>
            </div>
            <div class="col-md-2">
               <label><b>Arrival Date</b></label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <span>{{ $data->return_date_time }}</span>
              </div>
            </div>
           </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label><b>Review Date</b></label>
            </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="date" class="form-control" name="review_date" required id="date">
              <!-- <input type="text" name="review_date" id="from" class="form-control hasDatepicker" value="" readonly="readOnly" placeholder="Review Date"><span class="ui-helper-hidden-accessible"></span> -->
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><b>Publish Date</b></label>
            </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="date" class="form-control" name="publish_date" required id="date">
              <!-- <input type="text" name="publish" id="to" class="form-control hasDatepicker" value="" readonly="readOnly" placeholder="Publish Date"><span class="ui-helper-hidden-accessible"></span> -->
            </div>
          </div>
          </div>
          <div class="form-group row">
            <label class="col-md-6"><b>Would you recommend to a friend</b></label>
            <div class="col-md-1">
              <span id="yes">Yes</span> <span class="checked"><input type="radio" name="recommend" value="yes" checked="checked"></span>
            </div>
            <div class="col-md-1">
              <span id="no">No</span> <span><input type="radio" value="no" name="recommend"></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="review_title" class="col-md-6"><b>Please Write Review Title</b></label>
              <div class="col-md-6">
                <input type="text" name="review_title" class="form-control form-control-sm" id="review_title" placeholder="Enter Title">
                <input type="hidden" name="booking_id" class="form-control form-control-sm" id="" value="{{ $data->id }}">
              </div>
          </div>
          <div class="form-group row">
            <label for="comments" class="col-md-6"><b>Please Write Your Review</b></label>
            <div class="col-md-6">
              <textarea rows="8" name="comments" class="form-control form-control-sm" id="comments" required placeholder="Enter Your Comments ........."></textarea>
            </div>
          </div>
          <hr><h2><span>Your Ratings</span></h2><hr>
          <div class="form-group row">
              <label for="convenience" class="col-md-5"><b>Convenience of drop off/collection points</b> </label>
              <div class="col-md-7">
              <div class="br-wrapper br-theme-fontawesome-stars">
              <select id="convenience" name="convenience" style="display: none;">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4" selected="selected">4</option>
              <option value="5">5</option>
              </select>
            </div>
              </div>
          </div>
          <div class="form-group row">
            <label for="punctuality" class="col-md-5"><b>Punctuality of service</b></label>
            <div class="col-md-7">
            <div class="br-wrapper br-theme-fontawesome-stars"><select id="punctuality" name="punctuality" style="display: none;">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select>
          </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="customer_service" class="col-md-5"> <b>Customer service rating</b></label>
              <div class="col-md-7">
              <div class="br-wrapper br-theme-fontawesome-stars"><select id="customer_service" name="customer_service" style="display: none;">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              </select>
            </div>
              </div>
          </div>
          <div class="form-group row">
            <label for="collection_vehicle" class="col-md-5"> <b>Process for leaving/collecting vehicle</b></label>
              <div class="col-md-7">
              <div class="br-wrapper br-theme-fontawesome-stars"><select id="collection_vehicle" name="collection_vehicle" style="display: none;">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              </select></div>
              </div>
          </div>
          <div class="form-group row">
            <label for="overall" class="col-md-5 col-form-label col-form-label-md"><b>Over All Ratings</b></label>
            <div class="col-md-7">
            <div class="br-wrapper br-theme-fontawesome-stars"><select id="overall" name="overall" style="display: none;">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select></div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <input type="submit" class="btn button btn-primary sky-blue1 uppercase" style="width:100%;color: #fff; font-weight: bold;" value="Submit">
            </div>
          </div>
        {!! Form::close() !!}
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script>
            $(function(){

                  $('#overall, #convenience, #punctuality, #customer_service,#collection_vehicle').barrating({
                    theme: 'fontawesome-stars',
                    initialRating: '1'
                  });
            });
            </script>
      </div>
</div>
</div>
</div>
</div>
</div>
@stop
@section('css')

@stop
@section('js')
@stop
