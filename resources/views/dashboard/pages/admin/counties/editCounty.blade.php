@extends('dashboard.layout.master')
@section('title','Update County')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Counties</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update County</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          
            <form class="forms-sample" method="POST" action="{{route('counties.update', $county->id)}}">
            <h4 class="mb-5">Update County</h4>
            @csrf
            @method('put')
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
              
                <div class="form-group">
                  <label class="form-label">State Name:</label>
              <select class="js-example-basic-single w-100" required name="stateName">
                <option value="{{$county->stateName}}">{{$county->stateName}}</option>
                @foreach ($states as $state)
                <option value="{{$state->stateName}}">{{$state->stateName}}</option>
                @endforeach
              </select>
              </div>

                <div class="form-group">
                  <label class="form-label">County Name:</label>
              <input value="{{$county->countyName}}" name="countyName" class="form-control mb-4 mb-md-0" placeholder="Enter State Name" required>
              </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary w-100" value="Update">  
                </div>
            </div>

              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @endsection

 