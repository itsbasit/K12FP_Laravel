@extends('dashboard.layout.master')
@section('title','States')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Advanced Elements</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          
            <form enctype="multipart/form-data" class="forms-sample" method="POST" action="{{route('import')}}">
            <h4 class="mb-5">Import Schools Data </h4>
            @csrf
            
            <div class="row mb-3">
              <div class="col-md-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <label class="form-label">Choose CSV File:</label>
                    <input name="file" type="file" id="myDropify" class="border"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary w-100" value="Import">  
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
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush
@push('custom-scripts')
<script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush