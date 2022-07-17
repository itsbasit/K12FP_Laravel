@extends('dashboard.layout.master')
@section('title','Demo Videos')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Demo Videos</a></li>
    <li class="breadcrumb-item active" aria-current="page">All</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-8 offset-md-2 grid-margin stretch-card">
    <div class="card">
      <div class="card-body"> 
        <form action="" class="mb-5">
            <select id="video" name="video" class="form-control">
              <option value="">Select Video to Watch..</option>
              @foreach ($data as $video)
              <option value="{{$video->video_link}}">{{$video->title}}</option>  
              @endforeach
                
            </select>
        </form>

        <div class="embed-responsive embed-responsive-16by9">
            <iframe id="video_src" class="embed-responsive-item" src="https://www.youtube.com/embed/1V2vnfsAe0M"></iframe>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')
<script>
  $("#video").on('change',function()
  {
    var link = $('#video').find(":selected").val();
    
    $('#video_src').attr('src',link);
  })
</script>
@endpush