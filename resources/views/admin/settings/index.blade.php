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
                <form class="form-signin" action="site_settings.php" method="post">
                  <div class="tab-content" id="myTabContent" style="padding: 20px;background: white;">
                    <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                          <h3>Smtp2go Details</h3>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="">Smtp2go API Key</label>
                                <input type="text" class="form-control m-t-xxs" name="smtp2go_api_key" value="" id="smptp2go_api_key" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="">Smtp2go Base Url</label>
                                <input type="text" class="form-control m-t-xxs" name="smtp2go_base_url" value="" id="smtp2go_base_url">
                              </div>
                            </div>
                          </div>
                          <br> <hr> <br>
                          <h3>P4U Smtp details</h3>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Smtp Host</label>
                                <input type="text" class="form-control m-t-xxs" name="s_host" value="" id="s_host" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Smtp Username</label>
                                <input type="text" class="form-control m-t-xxs" name="s_username" value="" id="s_username">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Smtp Password</label>
                                <input type="text" class="form-control m-t-xxs" name="s_password" value="" id="s_password" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Smtp Port</label>
                                <input type="text" class="form-control m-t-xxs" name="s_port" value="" id="s_port">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="debug">
                                  <div class="checker"><span><input type="checkbox" name="s_debug" value=""></span></div>
                                  Check to turn on Smtp Debug
                                </label>
                                <label for="ssl">
                                  <div class="checker"><span class="checked"><input type="checkbox" name="s_ssl" value="1" checked=""></span></div>
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
                                <label for="">Review Smtp Host</label>
                                <input type="text" class="form-control m-t-xxs" name="rs_host" value="" id="rs_host" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Review Smtp Username</label>
                                <input type="text" class="form-control m-t-xxs" name="rs_username" value="" id="rs_username">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Review Smtp Password</label>
                                <input type="text" class="form-control m-t-xxs" name="rs_password" value="" id="rs_password" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="">Review Smtp Port</label>
                                <input type="text" class="form-control m-t-xxs" name="rs_port" value="" id="rs_port">
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="debug">
                                  <div class="checker"><span class=""><input type="checkbox" name="rs_debug" value=""></span></div>
                                  Check to turn on Review Smtp Debug
                                </label>
                                <label for="ssl">
                                  <div class="checker"><span class=""><input type="checkbox" name="rs_ssl" value="1"></span></div>
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
                                <label for="">From Email Confirmation</label>
                                <input type="text" class="form-control m-t-xxs" name="from_email_confirmation" value="" id="from_email_confirmation" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">From Email Amend</label>
                                 <input type="text" class="form-control m-t-xxs" name="from_email_amend" value="" id="from_email_amend">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">From Email Cancel</label>
                                <input type="text" class="form-control m-t-xxs" name="from_email_cancel" value="" id="from_email_cancel" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">Email CC</label>
                                <input type="text" class="form-control m-t-xxs" name="email_cc" value="" id="email_cc" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">Email BCC</label>
                                <input type="text" class="form-control m-t-xxs" name="email_bcc" value="" id="email_bcc">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">Email Contact us</label>
                                <input type="text" class="form-control m-t-xxs" name="contact_email" value="" id="contact_email" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">No Reply Confirmation Email</label>
                                <input type="text" class="form-control m-t-xxs" name="noreply_confirmation" value="" id="noreply_confirmation" placeholder="">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">No Reply Amendment Email</label>
                                <input type="text" class="form-control m-t-xxs" name="noreply_amend" value="" id="noreply_amend">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="">No Reply Cancelation Email</label>
                                <input type="text" class="form-control m-t-xxs" name="noreply_cancel" value="" id="noreply_cancel" placeholder="">
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
                      </div>
                    <div class="tab-pane fade" id="twilio" role="tabpanel" aria-labelledby="twilio-tab">
                      <h3>Twilio gateway details</h3>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="">Twilio Account ID</label>
                            <input type="text" class="form-control m-t-xxs" name="smtp2go_api_key" value="" id="smptp2go_api_key" placeholder="">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="">Twilio Auth Token</label>
                            <input type="text" class="form-control m-t-xxs" name="smtp2go_base_url" value="" id="smtp2go_base_url">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="">Twilio From Number</label>
                            <input type="text" class="form-control m-t-xxs" name="smtp2go_base_url" value="" id="smtp2go_base_url">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="debug">
                              <div class="checker"><span><input type="checkbox" name="s_debug" value="1"></span></div>
                              Check to turn on Twilio
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                      <h3>Website Scripts</h3>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="">Header Script</label>
                            <textarea class="form-control m-t-xxs" rows="5" name="header_script" id="header_script">

                            </textarea>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="">Footer Script</label>
                            <textarea class="form-control m-t-xxs" rows="5" name="footer_script" id="footer_script">

                            </textarea>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="">Body Script</label>
                            <textarea class="form-control m-t-xxs" rows="5" name="body_script" id="body_script">

                            </textarea>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="">Booking Confirmation Script</label>
                            <textarea class="form-control m-t-xxs" rows="5" name="booking_script" id="booking_script">                                &lt;!-- Event snippet for Buy Parking conversion page --&gt;
                            </textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="term" role="tabpanel" aria-labelledby="term-tab">Term and Conditions</div>
                    <br><hr><br>
                    <div class="form-group" style="text-align: right;">
                      <input type="hidden" name="data" value="mm">
                      <button type="submit" name="submit" id="submitButton" class="btn btn-info">Submit</button>
                    </div>
                  </div>
                </form>
                <!-- <form method="POST" action="{{ route('airport.store') }}" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group {{ $errors->has('airport_name') ? 'has-error' : '' }}">
                    <label for="airport_name">Email Setting</label>
                    <input type="text" class="form-control"  placeholder="Enter Email Setting" required="" name ="airport_name" id ="airport_name"  value ="{{ old('airport_name') }}">
                    @if($errors->first('airport_name'))
                    <span class="form-error">{{$errors->first('airport_name')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('operating_location') ? 'has-error' : '' }}">
                    <label for="airport_name">Site Script</label>
                    <input type="text" class="form-control"  placeholder="Enter Site Script" required="" name ="operating_location" id ="operating_location"  value ="{{ old('operating_location') }}">
                    @if($errors->first('operating_location'))
                    <span class="form-error">{{$errors->first('operating_location')}}</span>
                    @endif
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form> -->
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
<!-- DataTables  & Plugins -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.select2').select2();
  setTimeout(function(){
    //console.log('heeloo');
    $('#country').trigger('change');
  },1000);
  $(document).on('change','#country',function(){
      var name    = $(this).val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $.get(href, function(response) {
         var response_data = response.result;
         console.log(response_data);
         $('#language_iso_code').val(response_data.language_iso_code);
         $('#country_iso_code').val(response_data.country_iso_code);
         $('#country_code').val(response_data.country_code);
         $('#currency').val(response_data.currency);
         $('#language').val(response_data.languages);
         $('#language_iso_code').val(response_data.language_iso_code);
      });
  });

});
</script>
@stop
