@extends('dashboard.layout.master')
@section('title','Edit State')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">States</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update State</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          
            <form class="forms-sample" method="POST" action="{{route('states.update', $data->id)}}">
            <h4 class="mb-5">Update State</h4>
            @csrf
            @method('put')
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label class="form-label">State Name:</label>
                <input value="{{$data->stateName}}" name="stateName" class="form-control mb-4 mb-md-0" placeholder="Enter State Name" required>
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

 