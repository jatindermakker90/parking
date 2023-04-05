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
               <a href ="{{ route('list.index') }}">
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
          <div class="form-group row">
            <label class="col-md-6"><b>Would you recommend to a friend</b></label>
            @if($data->is_recommend == 1)
            <div class="col-md-1">
              <span id="yes">Yes</span> <span class="checked"><input type="radio" name="recommend" value="yes" checked="checked"></span>
            </div>
            <div class="col-md-1">
              <span id="no">No</span> <span><input type="radio" value="no" name="recommend"></span>
            </div>
            @else
            <div class="col-md-1">
              <span id="yes">Yes</span> <span><input type="radio" name="recommend" value="yes"></span>
            </div>
            <div class="col-md-1">
              <span id="no">No</span> <span class="checked"><input type="radio" value="no" checked="checked" name="recommend"></span>
            </div>
            @endif
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><b>Review Date</b></label>
            </div>
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::date('review_date',isset($data->review_date) ? $data->review_date : '',['class'=>'form-control']); }}
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><b>Publish Date</b></label>
            </div>
          <div class="col-md-6">
            <div class="form-group">
            {{ Form::date('publish_date',isset($data->publish_date) ? $data->publish_date : '',['class'=>'form-control']); }}
            </div>
          </div>
          </div>
          <div class="form-group row">
            <label for="review_title" class="col-md-6"><b>Please Write Review Title</b></label>
              <div class="col-md-6">
                <input type="text" name="review_title" value="{{ $data['review_title'] }}" class="form-control form-control-sm">
                <input type="hidden" name="booking_id" class="form-control form-control-sm" id="" value="{{ $data->id }}">
              </div>
          </div>
          <div class="form-group row">
            <label for="comments" class="col-md-6"><b>Please Write Your Review</b></label>
            <div class="col-md-6">
              {{ Form::textarea('comments',isset($data->comments) ? $data->comments : '',['class'=>'form-control form-control-sm','rows' => 8]); }}
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
              <input type="submit" class="btn button btn-primary sky-blue1 uppercase" style="width:100%;color: #fff; font-weight: bold;" value="Update Review">
            </div>
          </div>
        {!! Form::close() !!}
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script>
            $(function(){
                $('#convenience').barrating({
                  theme: 'fontawesome-stars',
                  initialRating: '{{ $data["convenience"] }}'
                });
                $('#punctuality').barrating({
                  theme: 'fontawesome-stars',
                  initialRating: '{{ $data["punctuality"] }}'
                });
                $('#customer_service').barrating({
                  theme: 'fontawesome-stars',
                  initialRating: '{{ $data["customer_service"] }}'
                });
                $('#collection_vehicle').barrating({
                  theme: 'fontawesome-stars',
                  initialRating: '{{ $data["collection_vehicle"] }}'
                });
                $('#overall').barrating({
                  theme: 'fontawesome-stars',
                  initialRating: '{{ $data["overall"] }}'
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
