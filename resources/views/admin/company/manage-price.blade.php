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
        <div class="card-body">
          <div>{{ $company_details->company_title }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      @if( Session::has( 'success' ))
        
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <!-- <h5><i class="icon fas fa-check"></i> Alert!</h5> -->
          {{ Session::get( 'success' ) }}
        </div>
      @elseif( Session::has( 'warning' ))
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <!-- <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5> -->
          {{ Session::get( 'warning' ) }}
        </div>
      @endif
      <div class="card">
        <div class="card-body">
          <div class="mb-3">Add New Standard Price Plan</div>
          <form action="{{ route('save-company-brand-price') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $company_details->id }}">
            <div class="row col-12" >
              <div class="col-5">
                <div class="form-group">
                  <label for="year">Select year</label>
                  <select class="form-control select2" style="width: 100%;" name="year" id="year">  
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                  </select>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="year">Select month</label>
                  <select class="form-control select2" style="width: 100%;" name="month" id="month">  
                    @foreach (config('constant.MONTHS') as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-2">
                <div class="form-group">
                  <label></label>
                  <button type="submit" class="btn btn-primary" style="margin-top:30px;">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Price Brand Details</h3>
        </div>
        <div class="card-body">
          <table id="data_collection" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Year</th>
              <th>Month</th>
              <th>Company</th>
              <th>
                @for ($i = 1; $i <= 31; $i++)
                  <a href="#" class="btn btn-info btn-xs dys">{{ $i }}</a>
                @endfor
              </th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table id="data_collection_2" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Edit</th>
                <th>Brand</th>
                <th>Status</th>
                    @for ($i = 1; $i <= 31; $i++)
                    <th>Day{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit_brand_price_modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form id="brand_price_modal_form" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Edit Brand Price</h4>
            <button type="button" class="close close-brand-price-button" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- body content here -->
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary w-100" id="brand_price_update_submit_button">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="edit_company_brand_modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form id="company_brand_modal_form" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Edit Brand Price</h4>
            <button type="button" class="close close-company-brand-button" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- body content here -->
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary w-100" id="company_brand_update_submit_button">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop
@section('css')
<style>
    .dys {
      width: 26px;
      margin-top: 5px;
    }
    input[type=checkbox] {
      transform: scale(1.5);
    }

</style>
@stop
@section('js')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      let editBrandPriceModel = $('#edit_brand_price_modal').modal({
        keyboard: false
      })
      let editCompanyBrandModel = $('#edit_company_brand_modal').modal({
        keyboard: false
      })
      
      let company_brand_price_column = [
        {
          data: 'year',
          name: 'year', 
          orderable: true,
          render: function ( data, type, row) {
            if(type === 'sort'){
                return data;
            }else{
                return  data??'NA';
            }
          }
        },
        {
          data: 'month',
          name: 'month', 
          orderable: true,
          render: function ( data, type, row) {
            if(type === 'sort'){
                return data;
            }else{
                return  data??'NA';
            }
          }
        },
        {
          data: 'company_name',
          name: 'company_name', 
          orderable: true,
          render: function ( data, type, row) {
            if(type === 'sort'){
                return data;
            }else{
                return  data??'NA';
            }
          }
        },
        {
          data: 'brand_id',
          name: 'brand_id', 
          orderable: true,
          render: function ( data, type, row) {
            if(type === 'sort'){
                return data;
            }else{
                return  data??'NA';
            }
          }
        },
        {
          data: 'action',
          name: 'action', 
          orderable: false,
        
        },
      ]
      let band_price_column = [
              {
                data: 'edit',
                name: 'edit', 
                orderable: false,
              
              },
              {
                data: 'brand',
                name: 'brand', 
                orderable: true,
                render: function ( data, type, row) {
                  if(type === 'sort'){
                      return data;
                  }else{
                      return  data??'NA';
                  }
                }
              },
              {
                data: 'status',
                name: 'status', 
                orderable: true,
                render: function ( data, type, row) {
                  if(type === 'sort'){
                      return data;
                  }else{
                      return  data??'NA';
                  }
                }
              },
      ]
      for (let index = 1; index < 32; index++) {
          band_price_column.push({
              data: 'day_'+index,
              name: 'day_'+index, 
              orderable: true,
              render: function ( data, type, row) {
                  if(type === 'sort'){
                      return data;
                  }else{
                      return  data??'NA';
                  }
              }
          },)
          
      }
      $('#data_collection').DataTable({
        "paging"      : false,
        "pageLength"  : 100,
        "lengthChange": false,
        "searching"   : false,
        "ordering"    : true,
        "info"        : true,
        "autoWidth"   : true,
        "responsive"  : true,
        "processing"  : true,
        "serverSide"  : true,
        "scrollX"     : false,
        "ajax"        :"{{ route('manage-company-price',[$company_details->id]) }}",
        "columns"     : company_brand_price_column
      });
      $('#data_collection_2').DataTable({
        "paging"      : false,
        "pageLength"  : 100,
        "lengthChange": false,
        "searching"   : false,
        "ordering"    : true,
        "info"        : true,
        "autoWidth"   : true,
        "responsive"  : false,
        "processing"  : true,
        "serverSide"  : true,
        "scrollX"     : true,
        "ajax"        :"{{ route('brand-prices') }}",
        "columns"     : band_price_column
      });

      $(document).on('click', '.close-brand-price-button', (e)=>{
        editBrandPriceModel.modal('hide');
      })
      $(document).on('click', '.close-company-brand-button', (e)=>{
        editCompanyBrandModel.modal('hide');
      })
      $(document).on('click', '.edit-brand-price', (e)=>{
        let url = $(e.target).data('url');
        let name = $(e.target).data('name');
        $("#edit_brand_price_modal").find(".modal-header .modal-title").text(`Edit Brand - ${name}`);
        
        $.ajax({
          url: url,
          type: 'GET',
          success:function(data){
            $("#edit_brand_price_modal").find(".modal-body").html(data);
            editBrandPriceModel.modal('show');
            $('.select2').select2();
          },
        });
      })
      $(document).on('click', '#brand_price_update_submit_button', (e)=>{
        e.preventDefault();
        let form = $("#brand_price_modal_form");
        let formData = $(form).serialize();
        let ajaxUrl = "{{ route('update-brand-prices') }}";
        console.log('formData:: ', formData, 'ajaxUrl:: ', ajaxUrl);

        $.ajax({
          url: ajaxUrl,
          type: 'POST',
          data: formData,
          success:function(data){
            console.log('data: ', data);
            editBrandPriceModel.modal('hide');
            toastr["success"](data.success);
            setTimeout(() => {
              location.reload();
            }, 1000);
          },
        });

      })
      $(document).on('click', '.edit-company-brand', (e)=>{
        let companyBrandId = $(e.target).data('id');
        let ajaxUrl = $(e.target).data('url');

        console.log('companyBrandId:: ', companyBrandId, 'ajaxUrl:: ', ajaxUrl);
        $.ajax({
          url: ajaxUrl,
          type: 'POST',
          // data: formData,
          success:function(data){
            console.log('data: ', data);
            $('#edit_company_brand_modal').find('.modal-body').html(data)
            editCompanyBrandModel.modal('show');
          },
        });
      })

    });
</script>
@stop