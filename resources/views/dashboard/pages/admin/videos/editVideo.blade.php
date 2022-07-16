@extends('dashboard.layout.master')
@section('title','Edit Video')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Demo Videos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update Video</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          
            <form class="forms-sample" method="POST" action="{{route('videos.update', $data->id)}}">
            <h4 class="mb-5">Update Video</h4>
            @csrf
            @method('put')
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label class="form-label">Vidoe Name/Title:</label>
                <input value="{{$data->title}}" name="title" class="form-control mb-4 mb-md-0 {{$errors->has('title') ? 'is-invalid':''}}" placeholder="Enter Video title" required>
                @error('title')
                <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                @enderror
                </div>

                <div class="form-group">
                  <label class="form-label">Vidoe link:</label>
              <input value="{{$data->video_link}}" name="video_link" class="form-control mb-4 mb-md-0 {{$errors->has('video_link') ? 'is-invalid':''}}" placeholder="Enter Video Link" required>
              @error('video_link')
                <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                @enderror
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

 