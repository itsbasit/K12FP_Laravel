@extends('dashboard.layout.master')
@section('title','Add Video')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Demo Videos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add New Video</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
        
            <form class="forms-sample" id="checkValidation" method="POST" action="{{route('videos.store')}}">
            <h4 class="mb-5">Add New Video</h4>
            @csrf
            
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label class="form-label">Video Name:</label>
                <input name="title" value="{{ old('title') }}" class="form-control mb-4 mb-md-0 {{$errors->has('title') ? 'is-invalid':''}}" placeholder="Enter Video title" >
                @error('title')
                <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                @enderror
                </div>

                <div class="form-group">
                  <label class="form-label">Video URL:</label>
              <input name="video_link" value="{{ old('video_link') }}" class="form-control mb-4 mb-md-0 {{$errors->has('video_link') ? 'is-invalid':''}}" placeholder="Enter Video Link" >
              @error('video_link')
                <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                @enderror
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

  @push('custom-scripts')
  <script>
    $(document).ready(function() {

  $("#checkValidation").on("submit", function(){
    
  })
  });
  </script>
  @endpush