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
                    {{ Form::open(['route' => 'settings.store','method' => 'post']) }}
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Client Email Template'); }}
                            {{ Form::textarea('client_email',isset($template_data->client_email_template) ? $template_data->client_email_template : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Client Cancel Email Template'); }}
                            {{ Form::textarea('client_cancel_email',isset($template_data->client_cancel_email_template) ? $template_data->client_cancel_email_template : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Company Confirmation Email Template'); }}
                            {{ Form::textarea('company_confirm_email',isset($template_data->company_confirm_email_template) ? $template_data->company_confirm_email_template : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Company Cancel Email Template'); }}
                            {{ Form::textarea('company_cancel_email',isset($template_data->company_cancel_email_template) ? $template_data->company_cancel_email_template : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Review Email Template'); }}
                            {{ Form::textarea('review_email',isset($template_data->review_email_template) ? $template_data->review_email_template : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                      </div>
                      <div class="form-group" style="text-align: right;">
                        {{ Form::hidden('form_type','client_email_template'); }}
                        {{ Form::hidden('row_id',isset($template_data->id) ? $template_data->id : 0); }}
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
