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
                            {{ Form::label('Edit Your Message Details'); }}
                            {{ Form::textarea('message_details',isset($sms_setting->message_details) ? $sms_setting->message_details : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                          <div class="form-group" style="text-align: left;">
                            {{ Form::hidden('form_type','message_details'); }}
                            {{ Form::hidden('row_id',isset($sms_setting->id) ? $sms_setting->id : 0); }}
                            <button type="submit" name="submit" id="submitButton" class="btn btn-info">Update</button>
                          </div>
                        </div>
                      </div>
                     {!! Form::close() !!}
                     {{ Form::open(['route' => 'settings.store','method' => 'post']) }}
                       <div class="row">
                         <div class="col-sm-12">
                           <div class="form-group">
                             {{ Form::label('Edit Your Pre Message Details'); }}
                             {{ Form::textarea('pre_message_details',isset($sms_setting->pre_message_details) ? $sms_setting->pre_message_details : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                           </div>
                           <div class="form-group" style="text-align: left;">
                             {{ Form::hidden('form_type','pre_message_details'); }}
                             {{ Form::hidden('row_id',isset($sms_setting->id) ? $sms_setting->id : 0); }}
                             <button type="submit" name="submit" id="submitButton" class="btn btn-info">Update</button>
                           </div>
                         </div>
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
