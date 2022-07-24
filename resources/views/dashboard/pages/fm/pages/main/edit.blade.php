@extends('dashboard.layout.master')
@section('title','Add Student')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fundraisers Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Page</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin"> 
        <div class="card">
            <div class="card-body"> 
                <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{route('main_update',$data->id)}}">
                <h4 class="mb-5">Update Page</h4>
                @csrf
                @method('put')
                <div class="row">
                    <div class="com-md-8">
                        <div class="row mb-3">
                            <div class="col-md-6">
                            <div class="form-group fundraisers">
                                <label class="form-label">Select Fundraiser:</label>
                                <select name="fundraiser" class="form-control">
                                <option value="">Choose Fundraiser</option> 
                                @foreach($fundraisers as $_data)
                                <option value="{{$_data->id}}" {{$data->fundraiser == $_data->id ? 'selected': ''}}>{{$_data->name}}</option>
                                @endforeach
                                </select>
                                @error('fundraiser')
                                <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                                @enderror
                            </div>
                            </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-label">Page title for Slug</label>
                        <input type="text" value="{{$data->slug}}" name="slug" placeholder="Enter Page title" class="form-control {{$errors->has('title') ? 'is-invalid':''}}">
                        @error('title')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                        @enderror
                        </div>
                    </div>
                        </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Fundraiser Student Goal $:</label>
                            <input type="number" name="student_goal" value="{{$data->student_goal}}" class="form-control {{$errors->has('student_goal') ? 'is-invalid':''}}" placeholder="Fundraiser Each Student Goal $ ">
                            @error('student_goal')
                                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Team:</label>
                            <input type="text" name="team" value="{{$data->team}}" class="form-control {{$errors->has('team') ? 'is-invalid':''}}" placeholder="Enter name of Team, Academi Club, Booster Club, Other Cause etc">
                            @error('team')
                                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                    <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid':''}}" name="tinymce" id="tinymceExample" rows="10">{{$data->content}}</textarea>
                    @error('content')
                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                    @enderror   
                </div>
                    
                </div>
                
                </div>
                <div class="col-md-4">
                
                
                <div class="form-group">
                    <label class="form-label">Featured Image Type:</label>
                    <select name="featured_type" id="featured_type" class="form-control">
                        <option value="">Choose Option</option>
                       
                        <option value="image" {{$data->cover_type == 'Image' ? 'selected' : ''}}>Image</option>
                       
                        <option value="video" {{$data->cover_type == 'Video' ? 'selected' : ''}}>Video</option>
                      
                    </select>
                </div>

                @if($data->cover_type == 'Image')
                <img src="/uploads/pages/{{$data->cover_url}}" class="rounded mx-auto d-block" style="width:180px" alt="">
                @endif

                <div class="card" id="featured_image" style="display:none">
                <div class="card-body">
                    <label class="form-label">Choose Featured Image:</label>
                    <input name="featured_image" type="file" id="myDropify" class="border {{$errors->has('featured_image') ? 'is-invalid':''}}"/>
                    @error('featured_image')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                </div>

                <div class="form-group" id="featured_video" style="display:none">
                    <label class="form-label">Featured Video URL</label>
                    <input type="url" value="{{$data->cover_url}}" name="featured_video" class="form-control" placeholder="URL">
                </div>

                <div class="form-group">
                    <input type="submit" value="Upate" class="btn btn-block btn-primary w-100">
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
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script>

$(document).ready(function(){
    let page_type = $("#page_type option:selected").text();
    
    if(page_type == 'Main Page')
    {
        $(".students").hide(); 
    }

    $("#page_type").change(function(){
        let page_type = $("#page_type option:selected").text();
        if(page_type == 'Main Page')
        {
            $(".students").hide(); 
        } else {
            $(".students").show(); 
        }
  }); 

    let type = $("#featured_type option:selected").text();
    if(type == 'Image')
    {
        $("#featured_image").show();
        $("#featured_video").hide();
    } else if(type == 'Video') {
        $("#featured_image").hide();
        $("#featured_video").show();
    } 

  $("#featured_type").change(function()
  {
    let type = $("#featured_type option:selected").text();
  
    if(type == 'Image')
    {
        $("#featured_image").show();
        $("#featured_video").hide();
    } else {
        $("#featured_image").hide();
        $("#featured_video").show();
    }
  })
    });

</script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/tinymce.js') }}"></script>

@endpush
