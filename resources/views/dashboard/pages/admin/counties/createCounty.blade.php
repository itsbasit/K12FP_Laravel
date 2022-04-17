@extends('dashboard.layout.master')
@section('title','Add County')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Counties</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add County</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          
            <form class="forms-sample" method="POST" action="{{route('counties.store')}}">
            <h4 class="mb-5">Add New County</h4>
            @csrf
            
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                  <label class="form-label">State Name:</label>
              <select class="js-example-basic-single w-100" name="stateName" required>
                <option>Select State</option>
                @foreach ($data as $state)
                <option value="{{$state->stateName}}">{{$state->stateName}}</option>
                @endforeach
              </select>
              </div>

                <div class="form-group">
                    <label class="form-label">County Name:</label>
                <input name="countyName" class="form-control mb-4 mb-md-0" placeholder="Enter County Name" required>
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