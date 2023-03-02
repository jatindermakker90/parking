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
               <a href ="{{ route('service-providers.index') }}">
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
              <div class="card-body row col-12">
                <div class="col-sm-6">
                    <form method="POST" action="{{ route('service-providers.update',[$user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control"  placeholder="Enter First Name" required="" name ="first_name" id ="first_name" value ="{{ old('first_name')??$user->first_name }}">
                    @if($errors->first('first_name'))
                    <span class="form-error">{{$errors->first('first_name')}}</span>
                    @endif
                  </div>  
                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="country_iso_code">Email</label>
                    <input type="text" class="form-control"  placeholder="Enter Email" required="" name ="email" id ="email" value ="{{ old('email')??$user->email }}">
                    @if($errors->first('email'))
                    <span class="form-error">{{$errors->first('email')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control"  placeholder="Enter Phone Number" required="" name ="phone_number" id ="phone_number" value ="{{ old('phone_number')??$user->phone }}">
                    @if($errors->first('phone_number'))
                    <span class="form-error">{{$errors->first('phone_number')}}</span>
                    @endif
                  </div>
                   <div class="form-group {{ $errors->has('country_code') ? 'has-error' : '' }}">
                    <label for="country">Country</label>
                    <select class="form-control select2" style="width: 100%;" name ="country_code" id ="country_code">
                    @foreach($countries as $countries_key =>  $countries_value)
                       <option value ="<?php echo $countries_value->country_code; ?>" <?php echo $countries_value->country_code ==  $user->country_code ? 'selected' : ''?>><?php echo "(+".$countries_value->country_code.") ".$countries_value->country  ?></option>
                     @endforeach
                    </select>
                    @if($errors->first('country_code'))
                    <span class="form-error">{{$errors->first('country_code')}}</span>
                    @endif  
                  </div> 
               
                  <div class="form-group {{ $errors->has('has_verified') ? 'has-error' : '' }}">
                    <label for="country_code">User Verified</label>
                    <select class="form-control" style="width: 100%;" name ="has_verified" id ="has_verified">
                    <option value ="0" <?php echo (int)$user->user_status ? '' : 'selected' ?>>No</option>
                    <option value ="1" <?php echo (int)$user->user_status ? 'selected' : '' ?>>Yes</option>
                    </select>
                    @if($errors->first('has_verified'))
                    <span class="form-error">{{$errors->first('has_verified')}}</span>
                    @endif
                  </div> 
                  
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Last Name" required="" name ="last_name" id ="last_name" value ="{{ old('last_name')??$user->last_name}}">
                    @if($errors->first('last_name'))
                    <span class="form-error">{{$errors->first('last_name')}}</span>
                    @endif
                  </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  placeholder="*********" name ="password" id ="password" value ="{{ old('password')??''}}">
                    @if($errors->first('password'))
                    <span class="form-error">{{$errors->first('password')}}</span>
                    @endif
                  </div> 
                  <div class="col-md-6">
                      <label class="mb-3">Professional photo </label>
                      <div class="form-group file-input">
                        <div id="fileUploadphoto" class="wpforms-uploader dropzone-single" data-field-id="32" data-form-id="444" data-input-name="wpforms_444_32" data-extensions="png,jpeg,jpg" data-max-size="268435456" data-max-file-number="1" data-post-max-size="268435456" data-max-parallel-uploads="4" data-parallel-uploads="true" data-file-chunk-size="2097152">
                          <div class="dz-message">
                            <svg viewBox="0 0 1024 1024" focusable="false" class="" data-icon="inbox" width="50px" height="50px" fill="#B1B1B1" aria-hidden="true">
                            </svg>
                            <span class="file-uplod"><img src="/assets/images/file.png" alt="">Upload Photo</span>
                          </div>
                          <input type="text" class="dropzone-input" style="position:absolute!important;clip:rect(0,0,0,0)!important;height:1px!important;width:1px!important;border:0!important;overflow:hidden!important;padding:0!important;margin:0!important;" id="profile" name="profile_image" value="{{$user->profile_image}}" data-image_url ="{{$user->profile_image_url}}">

                        </div>

                      </div>

                    </div>
                 
                    <div id="dropzoneItemTemplate" style="display: none;">
                      <div class="col h-100 mb-5">
                        <div class="dz-preview dz-file-preview">
                          <div class="d-flex justify-content-end dz-close-icon">
                          <small class="fa fa-times" data-dz-remove></small>
                          </div>
                          <div class="dz-details media">
                          <div class="dz-img">
                            <img class="edit-img-fluid" data-dz-thumbnail>
                          </div>
                          <div class="media-body">
                            <h6 class="dz-filename">
                            <span class="dz-title" data-dz-name></span>
                            </h6>
                            <!--div class="dz-size" data-dz-size></div-->
                          </div>
                          </div>
                          <div class="dz-progress progress" style="height: 4px;">
                          <div class="dz-upload progress-bar bg-success" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                          </div>
                          <div class="d-flex align-items-center">
                        
                          <div class="dz-error-message">
                            <small data-dz-errormessage></small>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
<script type="text/javascript">
$(document).ready(function(){
  $('.select2').select2();
  
  $(document).on('change','#country',function(){

      var name    = $(this).val();
      var href    = "{{ url('admin/fetch/countries/details') }}"+"?name="+name;
      $.get(href, function(response) {
         var response_data = response.data;
         $('#language_iso_code').val(response_data.language_iso_code);
         $('#country_iso_code').val(response_data.country_iso_code);
         $('#country_code').val(response_data.country_code);
         $('#currency').val(response_data.currency);
         $('#language').val(response_data.languages);
         $('#language_iso_code').val(response_data.language_iso_code);
      });
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

        let myDropzone = this;

        this.on("addedfile", function(event) {
          $("#submitButton").attr("disabled", "disabled");
          $("#submitButton").val('Uploading....');
        });
        this.on('error', function(file, errorMessage) {
          $("#submitButton").attr("disabled", false);
          $("#submitButton").val('Submit');
        });
        if($('#profile').val()){
        let mockFile = { name: $('#profile').val(), size: 12345 };
        myDropzone.displayExistingFile(mockFile, $('#profile').data('image_url'));
        //let fileCountOnServer = 1; // The number of files already uploaded
        //myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
        }
      },
      success: function(file, response) {
      //  console.log('response', response);
        if (response.success) {
          var imgName = response.result.image_name;
          $('#profile').val(imgName);
          file.previewElement.classList.add("dz-success");
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