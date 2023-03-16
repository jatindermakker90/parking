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
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="emailsetting">
                      <button class="nav-link active" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="true">Email Settings</button>
                    </li>
                    <li class="nav-item" role="twilio">
                      <button class="nav-link" id="twilio-tab" data-bs-toggle="tab" data-bs-target="#twilio" type="button" role="tab" aria-controls="twilio" aria-selected="false">Twilio Settings</button>
                    </li>
                    <li class="nav-item" role="site">
                      <button class="nav-link" id="site-tab" data-bs-toggle="tab" data-bs-target="#site" type="button" role="tab" aria-controls="site" aria-selected="false">Site Script</button>
                    </li>
                    <li class="nav-item" role="term">
                      <button class="nav-link" id="term-tab" data-bs-toggle="tab" data-bs-target="#term" type="button" role="tab" aria-controls="term" aria-selected="false">Terms and Conditions</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent" style="padding: 20px;background: white;">
                    <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                      {{ Form::open(['route' => 'settings.store', 'method' => 'post']) }}
                          <h3>Smtp2go Details</h3>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                {{ Form::label('Smtp2go API Key'); }}
                                {{ Form::text('smtp2go_api_key',isset($email_setting->smtp2go_api_key) ? $email_setting->smtp2go_api_key : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                {{ Form::label('Smtp2go Base Url'); }}
                                {{ Form::text('smtp2go_base_url',isset($email_setting->smtp2go_base_url) ? $email_setting->smtp2go_base_url : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                          </div>
                          <br> <hr> <br>
                          <h3>P4U Smtp details</h3>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Smtp Host'); }}
                                {{ Form::text('smtp_host',isset($email_setting->smtp_host) ? $email_setting->smtp_host : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Smtp Username'); }}
                                {{ Form::text('smtp_username',isset($email_setting->smtp_username) ? $email_setting->smtp_username : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Smtp Password'); }}
                                {{ Form::text('smtp_password',isset($email_setting->smtp_password) ? $email_setting->smtp_password : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Smtp Port'); }}
                                {{ Form::number('smtp_port',isset($email_setting->smtp_port) ? $email_setting->smtp_port : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="debug">
                                  @if(isset($email_setting->smtp_debug_status) && $email_setting->smtp_debug_status == 1)
                                  <div class="checker up"><span>{{ Form::checkbox('smtp_debug_status', '1', true) }}</span></div>
                                  @else
                                  <div class="checker down"><span> {{ Form::checkbox('smtp_debug_status', '1', false) }} </span></div>
                                  @endif
                                  Check to turn on Smtp Debug
                                </label>
                                <label for="ssl">
                                  @if(isset($email_setting->smtp_ssl_status) && $email_setting->smtp_ssl_status == 1)
                                  <div class="checker"><span>{{ Form::checkbox('smtp_ssl_status', '1', true) }}</span></div>
                                  @else
                                  <div class="checker"><span>{{ Form::checkbox('smtp_ssl_status', '1', false) }}</span></div>
                                  @endif
                                  Check to Active Smtp SSL
                                </label>
                              </div>
                            </div>
                          </div>
                          <br> <hr> <br>
                          <h3>Review Smtp details</h3>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Review Smtp Host'); }}
                                {{ Form::text('review_smtp_host',isset($email_setting->review_smtp_host) ? $email_setting->review_smtp_host : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Review Smtp Username'); }}
                                {{ Form::text('review_smtp_username',isset($email_setting->review_smtp_username) ? $email_setting->review_smtp_username : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Review Smtp Password'); }}
                                {{ Form::text('review_smtp_passowrd',isset($email_setting->review_smtp_passowrd) ? $email_setting->review_smtp_passowrd : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                {{ Form::label('Review Smtp Port'); }}
                                {{ Form::number('review_smtp_port',isset($email_setting->review_smtp_port) ? $email_setting->review_smtp_port : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="debug">
                                  @if(isset($email_setting->review_smtp_debug_status) && $email_setting->review_smtp_debug_status == 1)
                                  <div class="checker"><span>{{ Form::checkbox('review_smtp_debug_status', '1', true) }}</span></div>
                                  @else
                                  <div class="checker"><span>{{ Form::checkbox('review_smtp_debug_status', '1', false) }}</span></div>
                                  @endif
                                  Check to turn on Review Smtp Debug
                                </label>
                                <label for="ssl">
                                  @if(isset($email_setting->review_smtp_ssl_status) && $email_setting->review_smtp_ssl_status == 1)
                                  <div class="checker"><span>{{ Form::checkbox('review_smtp_ssl_status', '1', true) }}</span></div>
                                  @else
                                  <div class="checker"><span>{{ Form::checkbox('review_smtp_ssl_status', '1', false) }}</span></div>
                                  @endif
                                  Check to Active Review Smtp SSL
                                </label>
                              </div>
                            </div>
                          </div>
                          <br> <hr> <br>
                          <h3>Email Details</h3>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('From Email Confirmation'); }}
                                {{ Form::text('from_email_confirmation',isset($email_setting->from_email_confirmation) ? $email_setting->from_email_confirmation : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('From Email Amend'); }}
                                {{ Form::text('from_email_amend',isset($email_setting->from_email_amend) ? $email_setting->from_email_amend : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('From Email Cancel'); }}
                                {{ Form::text('from_email_cancel',isset($email_setting->from_email_cancel) ? $email_setting->from_email_cancel : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('Email CC'); }}
                                {{ Form::text('email_cc',isset($email_setting->email_cc) ? $email_setting->email_cc : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('Email BCC'); }}
                                {{ Form::text('email_bcc',isset($email_setting->email_bcc) ? $email_setting->email_bcc : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('Email Contact us'); }}
                                {{ Form::text('contact_email',isset($email_setting->contact_email) ? $email_setting->contact_email : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('No Reply Confirmation Email'); }}
                                {{ Form::text('noreply_confirmation',isset($email_setting->noreply_confirmation) ? $email_setting->noreply_confirmation : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('No Reply Amendment Email'); }}
                                {{ Form::text('noreply_amend',isset($email_setting->noreply_amend) ? $email_setting->noreply_amend : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                {{ Form::label('No Reply Cancelation Email'); }}
                                {{ Form::text('noreply_cancel',isset($email_setting->noreply_cancel) ? $email_setting->noreply_cancel : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                          </div>
                          <br> <hr> <br>
                          <h3>Default SMTP Gateway</h3>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Smtp Gateway</label>
                                <select name="default_smtp_gateway" class="form-control" id="default_smtp_gateway">
                                <option value="p4uSmtp">P4U Smtp</option>
                                <option value="smtp2Go" selected="">Smtp2Go</option>
                                <option value="reviewSmtp">Review Smtp</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <br><hr><br>
                          <div class="form-group" style="text-align: right;">
                            {{ Form::hidden('form_type','email'); }}
                            {{ Form::hidden('row_id',isset($email_setting->id) ? $email_setting->id : 0); }}
                            <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                          </div>
                          {!! Form::close() !!}
                      </div>
                    <div class="tab-pane fade" id="twilio" role="tabpanel" aria-labelledby="twilio-tab">
                      {{ Form::open(['route' => 'settings.store', 'method' => 'post']) }}
                        <h3>Twilio gateway details</h3>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              {{ Form::label('Twilio Account ID'); }}
                              {{ Form::text('twilio_acc_id',isset($twilio_setting->twilio_acc_id) ? $twilio_setting->twilio_acc_id : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              {{ Form::label('Twilio Auth Token'); }}
                              {{ Form::text('twilio_auth_token',isset($twilio_setting->twilio_auth_token) ? $twilio_setting->twilio_auth_token : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              {{ Form::label('Twilio From Number'); }}
                              {{ Form::text('twilio_form_number',isset($twilio_setting->twilio_form_number) ? $twilio_setting->twilio_form_number : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="debug">
                                @if(isset($twilio_setting->twilio_box) && $twilio_setting->twilio_box == 1)
                                <div class="checker"><span>{{ Form::checkbox('twilio_box', '1', true) }}</span></div>
                                @else
                                <div class="checker"><span>{{ Form::checkbox('twilio_box', '1', false) }}</span></div>
                                @endif
                                Check to turn on Twilio
                              </label>
                            </div>
                          </div>
                        </div>
                        <br><hr><br>
                        <div class="form-group" style="text-align: right;">
                          {{ Form::hidden('form_type','twilio'); }}
                          {{ Form::hidden('row_id',isset($twilio_setting->id) ? $twilio_setting->id : 0); }}
                          <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                        </div>
                      {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                    {{ Form::open(['route' => 'settings.store', 'method' => 'post']) }}
                      <h3>Website Scripts</h3>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Header Script'); }}
                            {{ Form::textarea('header_script',isset($script_setting->header_script) ? $script_setting->header_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Footer Script'); }}
                            {{ Form::textarea('footer_script',isset($script_setting->footer_script) ? $script_setting->footer_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Body Script'); }}
                            {{ Form::textarea('body_script',isset($script_setting->body_script) ? $script_setting->body_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            {{ Form::label('Booking Confirmation Script'); }}
                            {{ Form::textarea('booking_script',isset($script_setting->booking_script) ? $script_setting->booking_script : '',['class'=>'form-control m-t-xxs','rows' => 5]); }}
                          </div>
                        </div>
                      </div>
                      <br><hr><br>
                      <div class="form-group" style="text-align: right;">
                        {{ Form::hidden('form_type','script'); }}
                        {{ Form::hidden('row_id',isset($script_setting->id) ? $script_setting->id : 0); }}
                        <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                      </div>
                     {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade" id="term" role="tabpanel" aria-labelledby="term-tab">
                      {{ Form::open(['route' => 'settings.store', 'method' => 'post']) }}
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <section class="">
                                <div class="flex-box">
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" onclick="f1()" class="shadow-sm btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Bold Text">Bold</button>
                                            <button type="button" onclick="f2()" class="shadow-sm btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Italic Text">Italic</button>
                                            <button type="button" onclick="f3()" class="shadow-sm btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Left Align"><i class="fas fa-align-left"></i></button>
                                            <button type="button" onclick="f4()" class="btn shadow-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Center Align"><i class="fas fa-align-center"></i></button>
                                            <button type="button" onclick="f5()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Right Align"><i class="fas fa-align-right"></i></button>
                                            <button type="button" onclick="f6()" class="btn shadow-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Uppercase Text">Upper Case</button>
                                            <button type="button" onclick="f7()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Lowercase Text"> Lower Case</button>
                                            <button type="button" onclick="f8()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Capitalize Text"> Capitalize</button>
                                            <button type="button" onclick="f9()" class="btn shadow-sm btn-outline-primary side" data-toggle="tooltip" data-placement="top" title="Tooltip on top"> Clear Text</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="flex-box">
                                            {{ Form::textarea('term_condition_box',isset($term_condition_setting->term_condition_box) ? $term_condition_setting->term_condition_box : '',['class'=>'form-control input shadow','rows' => 10, 'cols' => 120,'id'=> 'textarea1']); }}
                                        </div>
                                    </div>
                                </div>
                            </section>
                          </div>
                        </div>
                      </div>
                      <br><hr><br>
                      <div class="form-group" style="text-align: right;">
                        {{ Form::hidden('form_type','term'); }}
                        {{ Form::hidden('row_id',isset($term_condition_setting->id) ? $term_condition_setting->id : 0); }}
                        <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
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
