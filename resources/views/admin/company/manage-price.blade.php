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
      <div class="card">
        <div class="card-body">
          <div class="mb-3">Add New Standard Price Plan</div>
          <form action="#" method="post">
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
                  <select class="form-control select2" style="width: 100%;" name="year" id="year">  
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
@stop
@section('css')
<style>
    .dys {
        width: 26px;
        margin-top: 5px;
    }

</style>
@stop