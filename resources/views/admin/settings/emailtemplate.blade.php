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
                  <div class="" id="myTabContent" style="padding: 20px;background: white;">
                    <div class="tab-pane" id="site" role="tabpanel" aria-labelledby="site-tab">
                    {{ Form::open([ 'method' => 'post']) }}
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Client Email Template'); }}
                            {{ Form::textarea('header_script',isset($script_setting->header_script) ? $script_setting->header_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Client Cancel Email Template'); }}
                            {{ Form::textarea('footer_script',isset($script_setting->footer_script) ? $script_setting->footer_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Company Confirmation Email Template'); }}
                            {{ Form::textarea('body_script',isset($script_setting->body_script) ? $script_setting->body_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Company Cancel Email Template'); }}
                            {{ Form::textarea('booking_script',isset($script_setting->booking_script) ? $script_setting->booking_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Review Email Template'); }}
                            {{ Form::textarea('booking_script',isset($script_setting->booking_script) ? $script_setting->booking_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                      </div>
                      <div class="form-group" style="text-align: right;">
                        {{ Form::hidden('form_type','script'); }}
                        {{ Form::hidden('row_id',isset($script_setting->id) ? $script_setting->id : 0); }}
                        <button type="submit" name="submit" id="submitButton" class="btn btn-info">Update Email Template</button>
                      </div>
                     {!! Form::close() !!}
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
@stop
@section('css')

@stop
@section('js')
@stop
