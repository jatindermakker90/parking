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
                  <form method="POST" action="{{ route('service-providers.store') }}" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group {{ $errors->has('airport_id') ? 'has-error' : '' }}">
                      <label for="airport_id">Airport Name</label>
                      <select class="form-control select2" style="width: 100%;" name ="airport_id" id ="airport_id" required>
                      @foreach($airports as $airport_key => $airport_value)
                      <option value ="{{ $airport_value->id }}">{{ $airport_value->airport_name }}</option>
                      @endforeach
                      </select>
                      @if($errors->first('airport_id'))
                      <span class="form-error">{{$errors->first('airport_id')}}</span>
                      @endif
                  </div>
                   <div class="form-group {{ $errors->has('terminal_id') ? 'has-error' : '' }}">
                      <label for="terminal_id">Terminal Name</label>
                      <select class="form-control select2" style="width: 100%;" name ="terminal_id" id ="terminal_id" required>
                      </select>
                      @if($errors->first('terminal_id'))
                      <span class="form-error">{{$errors->first('terminal_id')}}</span>
                      @endif
                  </div> 
                  <div class="form-group {{ $errors->has('protection_status') ? 'has-error' : '' }}">
                    <label for="first_name">Cancel Protection</label>
                     <select class="form-control select2" style="width: 100%;" name ="protection_status" id ="protection_status" required>
                        @foreach(config('constant.PROTECTION_STATUS') as $key => $value)
                        <option value ="{{ $value }}">{{ $key }}</option>
                        @endforeach
                      </select>
                      @if($errors->first('protection_status'))
                      <span class="form-error">{{$errors->first('protection_status')}}</span>
                      @endif
                  </div>  
                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="country_iso_code">Email</label>
                    <input type="text" class="form-control"  placeholder="Enter Email" required="" name ="email" id ="email" value ="{{ old('email')??''}}">
                    @if($errors->first('email'))
                    <span class="form-error">{{$errors->first('email')}}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control"  placeholder="Enter Phone Number" required="" name ="phone_number" id ="phone_number" value ="{{ old('phone_number')??''}}">
                    @if($errors->first('phone_number'))
                    <span class="form-error">{{$errors->first('phone_number')}}</span>
                    @endif
                  </div>
               
                  <div class="form-group {{ $errors->has('has_verified') ? 'has-error' : '' }}">
                    <label for="country_code">Verified</label>
                    <select class="form-control" style="width: 100%;" name ="has_verified" id ="has_verified">
                    <option value ="0">No</option>
                    <option value ="1">Yes</option>
                    </select>
                    @if($errors->first('has_verified'))
                    <span class="form-error">{{$errors->first('has_verified')}}</span>
                    @endif
                  </div> 
                 </div>
                 <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Last Name" required="" name ="last_name" id ="last_name" value ="{{ old('last_name')??''}}">
                    @if($errors->first('last_name'))
                    <span class="form-error">{{$errors->first('last_name')}}</span>
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
                          <input type="text" class="dropzone-input" style="position:absolute!important;clip:rect(0,0,0,0)!important;height:1px!important;width:1px!important;border:0!important;overflow:hidden!important;padding:0!important;margin:0!important;" id="profile" name="profile_image">

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
                  <button type="submit" class="btn btn-primary" id ="submitButton" style="text-align:left;">Submit</button>
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
  setTimeout(function(){
    $('#airport_id').trigger('change');
  },1000);
  $(document).on('change','#airport_id',function(){
      var airport_id    = $(this).val();
      var href    = "{{ url('admin/fetch/terminal/details') }}"+"?airport_id="+airport_id;
      $.get(href, function(response) {
          var response_data = response.result;
          $.each(response_data.terminal, function (index, value) {
            $('#terminal_id').append('<option value ="'+value.id+ '">'+value.terminal_name+'</option>');
          });
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
          $('#profile').val(imgName);
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