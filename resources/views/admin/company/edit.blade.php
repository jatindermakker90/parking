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
               <a href ="{{ route('companies.index') }}">
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
        <form method="POST" action="{{ route('companies.update',[$company->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('airport_id') ? 'has-error' : '' }}">
                    <label for="airport_id">Airport Name</label>
                    <select class="form-control select2" style="width: 100%;" name="airport_id" id="airport_id">
                        <option value="">Select airport</option>
                        @foreach ($airports as $airport_key => $airport_value)
                            <option value="{{ $airport_value->id }}" <?php echo $company->airport_id ==  $airport_value->id ? 'selected' : ''?>>{{ $airport_value->airport_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('airport_id'))
                        <span class="form-error">{{ $errors->first('airport_id') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('terminal_id') ? 'has-error' : '' }}">
                    <label for="terminal_id">Terminal Name</label>
                    <select class="form-control select2" style="width: 100%;" name="terminal_id" id="terminal_id">
                      @foreach ($terminal as $terminal_key => $terminal_value)
                            <option value="{{ $terminal_value->id }}" <?php echo $company->terminal_id ==  $terminal_value->id ? 'selected' : ''?>>{{ $terminal_value->terminal_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('terminal_id'))
                        <span class="form-error">{{ $errors->first('terminal_id') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('protection_status') ? 'has-error' : '' }}">
                    <label for="first_name">Cancel Protection</label>
                    <select class="form-control select2" style="width: 100%;" name="protection_status"
                        id="protection_status" >
                        @foreach (config('constant.PROTECTION_STATUS') as $key => $value)
                            <option <?php echo $company->protection_status ==  $value ? 'selected' : ''?> value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                    </select>
                    @if ($errors->first('protection_status'))
                        <span class="form-error">{{ $errors->first('protection_status') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('company_title') ? 'has-error' : '' }}">
                    <label for="company_title">Company Title</label>
                    <input type="text" class="form-control" placeholder="Enter Company Title"
                        name="company_title" id="company_title" value="{{ $company->company_title }}">
                    @if ($errors->first('company_title'))
                        <span class="form-error">{{ $errors->first('company_title') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('company_email') ? 'has-error' : '' }}">
                    <label for="company_email">Company Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" 
                        name="company_email" id="company_email" value="{{ $company->company_email }}">
                    @if ($errors->first('company_email'))
                        <span class="form-error">{{ $errors->first('company_email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('company_phone') ? 'has-error' : '' }}">
                    <label for="company_phone">Contact No</label>
                    <input type="number" class="form-control" placeholder="Enter Contact Number" 
                        name="company_phone" id="company_phone" value="{{ $company->company_phone }}">
                    @if ($errors->first('company_phone'))
                        <span class="form-error">{{ $errors->first('company_phone') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('sequence') ? 'has-error' : '' }}">
                    <label for="sequence">Sequence</label>
                    <input type="number" class="form-control" placeholder="Enter Sequence" 
                        name="sequence" id="sequence" value="{{ $company->company_sequence }}">
                    @if ($errors->first('sequence'))
                        <span class="form-error">{{ $errors->first('sequence') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('comission') ? 'has-error' : '' }}">
                    <label for="comission">Comission</label>
                    <input type="number" class="form-control" placeholder="Enter Comission" 
                        name="comission" id="comission" value="{{ $company->company_commission }}">
                    @if ($errors->first('comission'))
                        <span class="form-error">{{ $errors->first('comission') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('short_notes') ? 'has-error' : '' }}">
                    <label for="short_notes">Short Notes</label>
                    <input type="text" class="form-control" placeholder="Enter Short Notes" r
                        name="short_notes" id="short_notes" value="{{ $company->short_notes }}">
                    @if ($errors->first('short_notes'))
                        <span class="form-error">{{ $errors->first('short_notes') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mins_sms') ? 'has-error' : '' }}">
                    <label for="mins_sms">Mins Sms</label>
                    <input type="number" class="form-control" placeholder="Enter Mins Sms" 
                        name="mins_sms" id="mins_sms" value="{{ $company->min_sms }}">
                    @if ($errors->first('mins_sms'))
                        <span class="form-error">{{ $errors->first('mins_sms') }}</span>
                    @endif
                </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group {{ $errors->has('daily_bookings') ? 'has-error' : '' }}">
                      <label for="daily_bookings">Daily Bookings</label>
                      <input type="number" class="form-control" placeholder="Enter Daily Bookings" 
                          name="daily_bookings" id="daily_bookings" value="{{ $company->daily_bookings }}">
                      @if ($errors->first('daily_bookings'))
                          <span class="form-error">{{ $errors->first('daily_bookings') }}</span>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('monthly_bookings') ? 'has-error' : '' }}">
                      <label for="monthly_bookings">Monthly Bookings</label>
                      <input type="number" readonly class="form-control" placeholder="Monthly Bookings"
                           name="monthly_bookings" id="monthly_bookings"
                          value="{{ $company->monthly_bookings }}">
                      @if ($errors->first('monthly_bookings'))
                          <span class="form-error">{{ $errors->first('monthly_bookings') }}</span>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('company_url') ? 'has-error' : '' }}">
                      <label for="company_url">Company URL</label>
                      <input type="text" class="form-control" placeholder="Enter Company URL"
                           name="company_url" id="company_url"
                          value="{{ $company->company_url }}">
                      @if ($errors->first('company_url'))
                          <span class="form-error">{{ $errors->first('company_url') }}</span>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('sku_id') ? 'has-error' : '' }}">
                      <label for="sku_id">SKU ID</label>
                      <input type="text" class="form-control" placeholder="Enter SKU ID" 
                          name="sku_id" id="sku_id" value="{{ $company->company_sku_id }}">
                      @if ($errors->first('sku_id'))
                          <span class="form-error">{{ $errors->first('sku_id') }}</span>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('sku_tag') ? 'has-error' : '' }}">
                      <label for="sku_tag">Sku Tag</label>
                      <select class="form-control select2" style="width: 100%;" name="sku_tag" id="sku_tag">
                        <option value="">Select Sku Tag</option>
                        @foreach (config('constant.SKU_TAGS') as $sku_tag_key => $sku_tag_value)
                          <option value="{{ $sku_tag_value }}" <?php echo $company->company_sku_tag ==  $sku_tag_value ? 'selected' : ''?>>{{ $sku_tag_key }}</option>
                        @endforeach
                      </select>
                      @if ($errors->first('sku_tag'))
                        <span class="form-error">{{ $errors->first('sku_tag') }}</span>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('sku_sending_tag') ? 'has-error' : '' }}">
                      <label for="sku_sending_tag">Sku Sending Tag</label>
                      <select class="form-control select2" style="width: 100%;" name="sku_sending_tag"
                          id="sku_sending_tag" >
                          <option value="">Select Sku Sending Tag</option>
                        @foreach (config('constant.SKU_TAGS') as $sku_sending_tag_key => $sku_sending_tag_value)
                          <option value="{{ $sku_sending_tag_value }}" <?php echo $company->company_sku_sending_tag ==  $sku_sending_tag_value ? 'selected' : ''?>>{{ $sku_sending_tag_key }}</option>
                        @endforeach
                      </select>
                      @if ($errors->first('sku_sending_tag'))
                          <span class="form-error">{{ $errors->first('sku_sending_tag') }}</span>
                      @endif
                  </div>
                  <div class="form-group {{ $errors->has('price_plan') ? 'has-error' : '' }}">
                      <label for="price_plan">Default Price Plan Type</label>
                      <select class="form-control select2" style="width: 100%;" name="price_plan"
                          id="price_plan" >
                          <option value="">Please Select Default Price Plan Type</option>
                          @foreach (config('constant.PRICE_PLAN') as $price_plan_key => $price_plan_value)
                            <option value="{{ $price_plan_key }}" <?php echo $company->price_plan ==  $price_plan_key ? 'selected' : ''?>>{{ $price_plan_value }}</option>
                          @endforeach
                      </select>
                      @if ($errors->first('price_plan'))
                          <span class="form-error">{{ $errors->first('price_plan') }}</span>
                      @endif
                  </div>  

                  <div id="dropzoneItemTemplate" style="display: none;">
                      <div class="col h-100 mb-5">
                          <div class="dz-preview dz-file-preview">
                              <div class="d-flex justify-content-end dz-close-icon">
                                  <small class="fa fa-times" data-dz-remove></small>
                              </div>
                              <div class="dz-details media">
                                  <div class="dz-img">
                                      <img class="img-fluid" data-dz-thumbnail>
                                  </div>
                                  <div class="media-body">
                                      <h6 class="dz-filename">
                                          <span class="dz-title" data-dz-name></span>
                                      </h6>
                                      <!--div class="dz-size" data-dz-size></div-->
                                  </div>
                              </div>
                              <div class="dz-progress progress" style="height: 4px;">
                                  <div class="dz-upload progress-bar bg-success" role="progressbar"
                                      style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                      data-dz-uploadprogress></div>
                              </div>
                              <div class="d-flex align-items-center">

                                  <div class="dz-error-message">
                                      <small data-dz-errormessage></small>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label class="">Company Logo </label>
                      @if(!empty($company->logo_id))
                        <div class="mb-2">
                          <img width="100" height="50" src="{{ env('IMAGE_URL').$company->logo_id }}" alt="" srcset="">
                        </div>
                      @endif
                      <div class="form-group file-input">
                          <div id="fileUploadphoto" class="wpforms-uploader dropzone-single" data-field-id="32"
                              data-form-id="444" data-input-name="wpforms_444_32" data-extensions="png,jpeg,jpg"
                              data-max-size="268435456" data-max-file-number="1" data-post-max-size="268435456"
                              data-max-parallel-uploads="4" data-parallel-uploads="true"
                              data-file-chunk-size="2097152">
                              <div class="dz-message">
                                  <svg viewBox="0 0 1024 1024" focusable="false" class=""
                                      data-icon="inbox" width="50px" height="50px" fill="#B1B1B1"
                                      aria-hidden="true">
                                  </svg>
                                  <span class="file-uplod">
                                    <img src="/assets/images/file.png" alt="">
                                    Upload Company Logo
                                  </span>
                              </div>
                              <input type="text" class="dropzone-input"
                                  style="position:absolute!important;clip:rect(0,0,0,0)!important;height:1px!important;width:1px!important;border:0!important;overflow:hidden!important;padding:0!important;margin:0!important;"
                                  id="company_logo" name="company_logo">
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="row col-12">
              <div class="col-4">
                <h5>Select Offer Type</h5>
                <div class="form-group">
                  <div class="checkbox">
                    @foreach ($offer_type as $offer_type_key => $offer_type_value)
                      <div class="checker">
                        <span>
                          <input type="checkbox" <?php echo in_array($offer_type_value->id, $company->offer_types ?? []) ? 'checked' : ''?> name="offer_types[{{$offer_type_key}}]" value="{{$offer_type_value->id}}">
                        </span>
                        {{$offer_type_value->name}}
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col-4">
                <h5>Select Company Type</h5>
                <div class="form-group">
                  <div class="checkbox">
                    @foreach ($company_type as $company_type_key => $company_type_value)
                      <div class="checker">
                        <span>
                          <input type="checkbox" <?php echo in_array($company_type_value->id, $company->company_types ?? []) ? 'checked' : ''?> name="company_types[{{$company_type_key}}]" value="{{$company_type_value->id}}">
                        </span>
                        {{$company_type_value->name}}
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col-4">
                <h5>Select Services Type</h5>
                <div class="form-group">
                  <div class="checkbox">
                    @foreach ($service_type as $service_type_key => $service_type_value)
                      <div class="checker">
                        <span>
                          <input type="checkbox" <?php echo in_array($service_type_value->id, $company->service_types ?? []) ? 'checked' : ''?> name="service_types[{{$service_type_key}}]" value="{{$service_type_value->id}}">
                        </span>
                        {{$service_type_value->name}}
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div class="row col-12">
              <div class="col-2">
                <div class="checkbox">
                  <div class="checker">
                    <span>
                      <input type="checkbox" <?php echo $company->send_csv == 1 ? 'checked' : ''?> name="send_csv" value="1">
                    </span>
                    Send CSV
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="checkbox">
                  <div class="checker">
                    <span>
                      <input type="checkbox" <?php echo $company->add_extra_status == 1 ? 'checked' : ''?> name="add_extra_amount" value="1">
                    </span>
                    Add Extra Amount
                  </div>
                </div>
              </div>
              <div class="col-2">
                <input type="number" value="{{$company->extra_amount}}" class="form-control m-t-xxs" id="extra_amount" name="extra_amount" placeholder="Enter Amount">
              </div>
              <div class="col-2">
                <div class="checkbox">
                  <div class="checker">
                    <span>
                      <input type="checkbox" <?php echo $company->levy_charge_status == 1 ? 'checked' : ''?> name="is_levy_charge" value="1">
                    </span>
                    Levy Charge
                  </div>
                </div>
              </div>
              <div class="col-2">
                <input type="number" value="{{$company->levy_charge}}" class="form-control m-t-xxs" id="levy_charge" name="levy_charge" placeholder="Enter levy charge">
              </div>
            </div>
            <div class="row col-12 mb-3">
              <div class="col-12">
                <label class="control-label">Parking Procedure - Email</label><br>
                <textarea rows="5" style="width:100%;" name="parking_procedure_email" id="parking_procedure_email">{{ $company->parking_procedure_email }}</textarea>
              </div>
            </div>
            <div class="row col-12 mb-3">
              <div class="col-12">
                <label class="control-label">Drop Off Procedure</label><br>
                <textarea rows="5" style="width:100%;" name="drop_off_procedure" id="drop_off_procedure">{{ $company->drop_off_procedure }}</textarea>
              </div>
            </div>
            <div class="row col-12 mb-3">
              <div class="col-12">
                <label class="control-label">Return Procedure</label><br>
                <textarea rows="5" style="width:100%;" name="return_procedure" id="return_procedure">{{ $company->return_procedure }}</textarea>
              </div>
            </div>
            <div class="row col-12 mb-3">
              <div class="col-12">
                <label class="control-label">Company Overview</label><br>
                <textarea rows="5" style="width:100%;" name="company_overview" id="company_overview">{{ $company->company_overview }}</textarea>
              </div>
            </div>
            <div class="row col-12 mb-3">
              <div class="col-12">
                <label class="control-label">Short Description - Choices Page</label><br>
                <textarea rows="5" style="width:100%;" name="short_description" id="short_description">{{ $company->short_description }}</textarea>
              </div>
            </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="submitButton"
                style="text-align:left;">Submit</button>
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
  setTimeout(function(){
    $('#airport_id').trigger('change');
  },1000);
  $(document).on('change','#airport_id',function(){
      var airport_id    = $(this).val();
      let terminalId = "{{ $company->terminal_id }}";
      var href    = "{{ url('admin/fetch/terminal/details') }}"+"?airport_id="+airport_id;
      $.get(href, function(response) {
          $('#terminal_id').html('<option value="">Select terminal</option>');
          var response_data = response.result;
          $.each(response_data.terminal, function (index, value) {
            $('#terminal_id').append(`<option ${(value.id == terminalId)? "selected" : ""} value ="${value.id}">${value.terminal_name}</option>`);
          });
      });
  });

  $(document).on('change', '#daily_bookings', (e) => {
    let targetValue = $(e.target).val();
    let numberOfDaysInMonth = 30;
    let monthlyBooking = parseInt(targetValue) * parseInt(numberOfDaysInMonth);
    $("#monthly_bookings").val(monthlyBooking);
  });

  var myDropzone2 = new Dropzone("div#fileUploadphoto", {
      url: "{{ url('upload-image') }}",
      addRemoveLinks: true,
      paramName: "image",
      autoProcessQueue: true,
      uploadMultiple: false,
      maxFilesize: 10,
      maxFiles: 1,
      previewTemplate: document.querySelector('#dropzoneItemTemplate').innerHTML,
      acceptedFiles: ".jpeg,.jpg,.png",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      init: function() {
        myDropzone = this;
        this.on("addedfile", function(event) {
          $("#submitButton").attr("disabled", "disabled");
          $("#submitButton").val('Uploading....');
        });
        this.on('error', function(file, errorMessage) {
          $("#submitButton").attr("disabled", false);
          $("#submitButton").val('Submit');
        });
      },
      success: function(file, response) {
      //  console.log('response', response);
        if (response.success) {
          var imgName = response.result.image_name;
          $('#company_logo').val(imgName);
        //  file.previewElement.classList.add("dz-success");
        } else {
          alert('Errro');
        }
        $("#submitButton").attr("disabled", false);
        $("#submitButton").val('Submit application');
      },
    });

});
</script>
@stop