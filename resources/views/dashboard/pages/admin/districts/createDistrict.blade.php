@extends('dashboard.layout.master')
@section('title','Add District')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Districts</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add District</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          
            <form class="forms-sample" method="POST" action="{{route('districts.store')}}">
            <h4 class="mb-5">Add New District</h4>
            @csrf
            
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">

              <div class="form-group">
                  <label class="form-label">County Name:</label>
              <select class="js-example-basic-single w-100" name="countyName" required>
                <option>Select County</option>
                @foreach ($data as $county)
                <option value="{{$county->countyName}}">{{$county->countyName}}</option>
                @endforeach
              </select>
              </div>
              <div class="form-group">
                    <label class="form-label">District Name:</label>
                <input name="districtName" class="form-control mb-4 mb-md-0" placeholder="Enter District Name" required>
              </div>

              <div class="form-group">
                    <input type="submit" class="btn btn-primary w-100" value="Submit">  
              </div>
            </div>

              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @endsection
  
  @push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  @endpush
