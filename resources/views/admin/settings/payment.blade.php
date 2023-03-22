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
                      <button class="nav-link active" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button" role="tab" aria-controls="email" aria-selected="true">Stripe 3D Secure</button>
                    </li>
                    <li class="nav-item" role="twilio">
                      <button class="nav-link" id="twilio-tab" data-bs-toggle="tab" data-bs-target="#twilio" type="button" role="tab" aria-controls="twilio" aria-selected="false">Stripe</button>
                    </li>
                    <li class="nav-item" role="site">
                      <button class="nav-link" id="site-tab" data-bs-toggle="tab" data-bs-target="#site" type="button" role="tab" aria-controls="site" aria-selected="false">PayPal Express</button>
                    </li>
                    <li class="nav-item" role="term">
                      <button class="nav-link" id="term-tab" data-bs-toggle="tab" data-bs-target="#term" type="button" role="tab" aria-controls="term" aria-selected="false">PayPal</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent" style="padding: 20px;background: white;">
                    <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                      {{ Form::open(['route' => 'settings.store','method' => 'post']) }}
                          <h3>Stripe 3D Secure Details</h3>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                {{ Form::label('Live Private Key'); }}
                                {{ Form::text('live_private_key',isset($payment_setting->live_private_key) ? $payment_setting->live_private_key : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                {{ Form::label('Live Public Key'); }}
                                {{ Form::text('live_public_key',isset($payment_setting->live_public_key) ? $payment_setting->live_public_key : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                {{ Form::label('Test Private Key'); }}
                                {{ Form::text('test_private_key',isset($payment_setting->test_private_key) ? $payment_setting->test_private_key : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                {{ Form::label('Test Public Key'); }}
                                {{ Form::text('test_public_key',isset($payment_setting->test_public_key) ? $payment_setting->test_public_key : '',['class'=>'form-control m-t-xxs']); }}
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="debug">
                                  @if(isset($payment_setting->gateway_activation_status) && $payment_setting->gateway_activation_status == 1)
                                  <div class="checker up"><span>{{ Form::checkbox('gateway_activation_status', '1', true) }}</span></div>
                                  @else
                                  <div class="checker down"><span> {{ Form::checkbox('gateway_activation_status', '1', false) }} </span></div>
                                  @endif
                                Check to Activate Stripe3DS Gateway
                                </label>
                                <label for="ssl">
                                  @if(isset($payment_setting->stripe_testmode_status) && $payment_setting->stripe_testmode_status == 1)
                                  <div class="checker"><span>{{ Form::checkbox('stripe_testmode_status', '1', true) }}</span></div>
                                  @else
                                  <div class="checker"><span>{{ Form::checkbox('stripe_testmode_status', '1', false) }}</span></div>
                                  @endif
                                  Check to Activate Stripe3DS Test Mode
                                </label>
                              </div>
                            </div>
                          </div>
                          <br> <hr> <br>
                          <div class="form-group" style="text-align: left;">
                            {{ Form::hidden('form_type','payment_setting'); }}
                            {{ Form::hidden('row_id',isset($payment_setting->id) ? $payment_setting->id : 0); }}
                            <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                          </div>
                          {!! Form::close() !!}
                      </div>
                    <div class="tab-pane fade" id="twilio" role="tabpanel" aria-labelledby="twilio-tab">
                      {{ Form::open(['route' => 'settings.store','method' => 'post']) }}
                        <h3>Stripe Gateway Details</h3>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              {{ Form::label('Live Private Key'); }}
                              {{ Form::text('live_private_key',isset($payment_setting1->live_private_key) ? $payment_setting1->live_private_key : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              {{ Form::label('Live Public Key'); }}
                              {{ Form::text('live_public_key',isset($payment_setting1->live_public_key) ? $payment_setting1->live_public_key : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              {{ Form::label('Test Private Key'); }}
                              {{ Form::text('test_private_key',isset($payment_setting1->test_private_key) ? $payment_setting1->test_private_key : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              {{ Form::label('Test Public Key'); }}
                              {{ Form::text('test_public_key',isset($payment_setting1->test_public_key) ? $payment_setting1->test_public_key : '',['class'=>'form-control m-t-xxs']); }}
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="debug">
                                @if(isset($payment_setting1->gateway_activation_status) && $payment_setting1->gateway_activation_status == 1)
                                <div class="checker up"><span>{{ Form::checkbox('gateway_activation_status', '1', true) }}</span></div>
                                @else
                                <div class="checker down"><span> {{ Form::checkbox('gateway_activation_status', '1', false) }} </span></div>
                                @endif
                              Check to Activate Stripe Gateway
                              </label>
                              <label for="ssl">
                                @if(isset($payment_setting1->stripe_testmode_status) && $payment_setting1->stripe_testmode_status == 1)
                                <div class="checker"><span>{{ Form::checkbox('stripe_testmode_status', '1', true) }}</span></div>
                                @else
                                <div class="checker"><span>{{ Form::checkbox('stripe_testmode_status', '1', false) }}</span></div>
                                @endif
                                Check to turn on test mode
                              </label>
                            </div>
                          </div>
                        </div>
                        <br><hr><br>
                        <div class="form-group" style="text-align: right;">
                          {{ Form::hidden('form_type','payment_setting1'); }}
                          {{ Form::hidden('row_id',isset($payment_setting1->id) ? $payment_setting1->id : 0); }}
                          <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                        </div>
                      {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                    {{ Form::open(['route' => 'settings.store', 'method' => 'post']) }}
                      <h3>PayPal Express Details</h3>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Live Email'); }}
                            {{ Form::text('live_email',isset($payment_setting2->live_email) ? $payment_setting2->live_email : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Live Private Key'); }}
                            {{ Form::text('live_private_key',isset($payment_setting2->live_private_key) ? $payment_setting2->live_private_key : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Live Public Key'); }}
                            {{ Form::text('live_public_key',isset($payment_setting2->live_public_key) ? $payment_setting2->live_public_key : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Test Email'); }}
                            {{ Form::text('test_email',isset($payment_setting2->test_email) ? $payment_setting2->test_email : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Test Private Key'); }}
                            {{ Form::text('test_private_key',isset($payment_setting2->test_private_key) ? $payment_setting2->test_private_key : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Test Public Key'); }}
                            {{ Form::text('test_public_key',isset($payment_setting2->test_public_key) ? $payment_setting2->test_public_key : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            {{ Form::label('PayPal Live Url'); }}
                            {{ Form::text('live_url',isset($payment_setting2->live_url) ? $payment_setting2->live_url : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            {{ Form::label('PayPal Test Url'); }}
                            {{ Form::text('test_url',isset($payment_setting2->test_url) ? $payment_setting2->test_url : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="debug">
                              @if(isset($payment_setting2->gateway_activation_status) && $payment_setting2->gateway_activation_status == 1)
                              <div class="checker up"><span>{{ Form::checkbox('gateway_activation_status', '1', true) }}</span></div>
                              @else
                              <div class="checker down"><span> {{ Form::checkbox('gateway_activation_status', '1', false) }} </span></div>
                              @endif
                            Check to Activate PayPal Express Gateway
                            </label>
                            <label for="ssl">
                              @if(isset($payment_setting2->testmode_status) && $payment_setting2->testmode_status == 1)
                              <div class="checker"><span>{{ Form::checkbox('testmode_status', '1', true) }}</span></div>
                              @else
                              <div class="checker"><span>{{ Form::checkbox('testmode_status', '1', false) }}</span></div>
                              @endif
                            Check to Activate PayPal Express Test Mode
                            </label>
                          </div>
                        </div>
                      </div>
                      <br><hr><br>
                      <div class="form-group" style="text-align: right;">
                        {{ Form::hidden('form_type','payment_setting2'); }}
                        {{ Form::hidden('row_id',isset($payment_setting2->id) ? $payment_setting2->id : 0); }}
                        <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                      </div>
                     {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade" id="term" role="tabpanel" aria-labelledby="term-tab">
                      {{ Form::open(['route' => 'settings.store', 'method' => 'post']) }}
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('PayPal Email'); }}
                            {{ Form::text('paypal_email',isset($payment_setting3->paypal_email) ? $payment_setting3->paypal_email : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('Live PayPal Url'); }}
                            {{ Form::text('paypal_url',isset($payment_setting3->paypal_url) ? $payment_setting3->paypal_url : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            {{ Form::label('Test v Url'); }}
                            {{ Form::text('test_url',isset($payment_setting3->test_url) ? $payment_setting3->test_url : '',['class'=>'form-control m-t-xxs']); }}
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="debug">
                              @if(isset($payment_setting3->gateway_activation_status) && $payment_setting3->gateway_activation_status == 1)
                              <div class="checker up"><span>{{ Form::checkbox('gateway_activation_status', '1', true) }}</span></div>
                              @else
                              <div class="checker down"><span> {{ Form::checkbox('gateway_activation_status', '1', false) }} </span></div>
                              @endif
                            Check to Activate PayPal Gateway
                            </label>
                            <label for="ssl">
                              @if(isset($payment_setting3->testmode_status) && $payment_setting3->testmode_status == 1)
                              <div class="checker"><span>{{ Form::checkbox('testmode_status', '1', true) }}</span></div>
                              @else
                              <div class="checker"><span>{{ Form::checkbox('testmode_status', '1', false) }}</span></div>
                              @endif
                            Check to turn on test mode
                            </label>
                          </div>
                        </div>
                      </div>
                      <br><hr><br>
                      <div class="form-group" style="text-align: right;">
                        {{ Form::hidden('form_type','payment_setting3'); }}
                        {{ Form::hidden('row_id',isset($payment_setting3->id) ? $payment_setting3->id : 0); }}
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
