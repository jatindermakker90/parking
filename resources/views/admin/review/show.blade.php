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
  <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $header }}</h3>
              </div>
              <div class="card-body">
                <div class="card-body col-sm-12">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Recommendation</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>@if($detail->is_recommend == 0) No @else Yes @endif </span>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Company Name</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>N/A</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Convenience of drop off/collection points</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="br-wrapper br-theme-fontawesome-stars">
                              <select id="convenience" name="convenience" style="display: none;">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              </select>
                          </div>
                      </div>
                   </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Client Name</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>{{ $detail->booking->first_name.' '.$detail->booking->last_name }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Punctuality of service</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="br-wrapper br-theme-fontawesome-stars">
                          <select id="punctuality" name="punctuality" style="display: none;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          </select>
                      </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Reference Number</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>{{ $detail->booking->ref_id }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Customer service rating</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="br-wrapper br-theme-fontawesome-stars">
                          <select id="customer_service" name="customer_service" style="display: none;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          </select>
                      </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Review Date</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>{{ $detail->review_date }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Process for leaving/collecting vehicle</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="br-wrapper br-theme-fontawesome-stars">
                          <select id="collection_vehicle" name="collection_vehicle" style="display: none;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          </select>
                      </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Email</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>{{ $detail->booking->email }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Over All Ratings</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="br-wrapper br-theme-fontawesome-stars">
                          <select id="overall" name="overall" style="display: none;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          </select>
                      </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Approve Date</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <span>{{ $detail->created_at }}</span>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Comments</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span>{{ $detail->comments }}</span>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
          $(function(){
              $('#convenience').barrating({
                theme: 'fontawesome-stars',
                initialRating: "{{ $detail->convenience }}",
                hoverState: false
              });
              $('#punctuality').barrating({
                theme: 'fontawesome-stars',
                initialRating: '{{ $detail->punctuality }}',
                hoverState: false
              });
              $('#customer_service').barrating({
                theme: 'fontawesome-stars',
                initialRating: '{{ $detail->customer_service }}',
                hoverState: false
              });
              $('#collection_vehicle').barrating({
                theme: 'fontawesome-stars',
                initialRating: '{{ $detail->collection_vehicle }}',
                hoverState: false
              });
              $('#overall').barrating({
                theme: 'fontawesome-stars',
                initialRating: '{{ $detail->overall }}',
                hoverState: false
              });
          });
    </script>
@stop
