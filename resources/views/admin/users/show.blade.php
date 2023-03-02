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
               <a href ="{{ route('users.index') }}">
               <button type="button" class="btn btn-block btn-danger">Back</button>
               </a>
            </ol>
          </div>
        </div>
      </div>
@stop
@section('content')
 <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                @if($user->profile_image)
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$user->profile_image_url}}"
                       alt="User profile picture">
                </div>
                @endif
                <h3 class="profile-username text-center" style="text-transform:capitalize;">{{$user->name ? $user->name :trim($user->first_name." ".$user->last_name)}}</h3>

                <p class="text-muted text-center">{{$user->roles->first()->name}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong>Email</strong>
                <p class="text-muted">
                  {{$user->email}}
                </p>
                <hr>
                <strong>Phone</strong>
                <p class="text-muted">(+{{$user->country_code}}){{$user->phone}}</p>
                <hr>
                <strong>Company Name</strong>
                <p class="text-muted">
                  <span class="tag tag-danger" style="text-transform:capitalize;">{{ $user->company_name ? $user->company_name : "NA"}}</span>
                </p>
                <hr>
                <strong>Landline</strong>
                <p class="text-muted">{{$user->landline }}</p>
                <hr>
                <strong>GST Number</strong>
                <p class="text-muted">{{$user->gst_number }}</p>
                <hr>
                <strong>PAN Number</strong>
                <p class="text-muted">{{$user->pan_number }}</p>
                <hr>
                <strong>Country</strong>
                <p class="text-muted">{{$user->country }}</p>
                <hr>
                <strong>State</strong>
                <p class="text-muted">{{$user->state }}</p>
                <hr>
                <strong>City</strong>
                <p class="text-muted">{{$user->city }}</p>
                <hr>
                <strong>Street Address</strong>
                <p class="text-muted">{{$user->street_address }}</p>
                <hr>
                <strong>Zipcode</strong>
                <p class="text-muted">{{$user->zipcode }}</p>
                <hr>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                 
                  <li class="nav-item"><a class="nav-link " href="#timeline" data-toggle="tab">Timeline</a></li>
                
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                              
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        @if($user->email_verified_at)
                        <div class="time-label">
                          <span class="bg-danger">
                            {{ $user->email_verified_at->format('M d Y')}}
                          </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-envelope bg-primary"></i>
                          <div class="timeline-item">
                            <h3 class="timeline-header"><a href="#">Email</a> Verified Successfully</h3>
                          </div>
                        </div>
                        @endif
                        <!-- END timeline item -->
                        <!-- timeline item -->
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      @if($user->phone_verified_at)
                      <div class="time-label">
                        <span class="bg-success">
                          {{ $user->phone_verified_at->format('M d Y')}}
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-phone bg-info"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                        </div>
                      </div>
                      @endif
                      @if($user->created_at)
                      <div class="time-label">
                        <span class="bg-success">
                          {{ $user->created_at->format('M d, Y')}}
                        </span>
                      </div>
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><a href="#" style="text-transform:capitalize;">{{ $user->name }}</a> Registered Successfully.</h3>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                  <!-- /.tab-pane -->

               
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
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