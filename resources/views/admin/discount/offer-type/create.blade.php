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
               <a href ="{{ route('offertype.index') }}">
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
        <form method="POST" action="{{ route('offer-type-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
              <h3 class="card-title">{{ $header }}</h3>
          </div>
          <div class="card-body">
            <div class="row col-12">
              <div class="col-sm-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name"
                        name="name" id="name" value="{{ old('name') ?? '' }}">
                    @if ($errors->first('name'))
                        <span class="form-error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <div class="checkbox">
                        <div class="checker">
                            <span>
                                <input type="checkbox" name="status" value="1">
                            </span>
                            Send CSV
                        </div>
                    </div>
                    @if ($errors->first('status'))
                        <span class="form-error">{{ $errors->first('status') }}</span>
                    @endif
                </div>
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
      var href    = "{{ url('admin/fetch/terminal/details') }}"+"?airport_id="+airport_id;
      $.get(href, function(response) {
          $('#terminal_id').html('<option value="">Select terminal</option>');
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