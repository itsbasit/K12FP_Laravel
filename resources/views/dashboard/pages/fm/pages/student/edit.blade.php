@extends('dashboard.layout.master')
@section('title','Create Student Page')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fundraisers Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Student Page</li>
    </ol>
</nav>


<div class="row">
    <div class="col-md-12 grid-margin"> 
        <div class="card">
            <div class="card-body"> 
                <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{route('student_update', $data->id)}}">
                <h4 class="mb-5">Update Student Page</h4>
                @csrf
                @method("put")
                <div class="row">
                    <div class="com-md-8">
                        <div class="row mb-3">
                        
                        
                    <div class="col-md-6">
                        <div class="form-group fundraisers">
                            <label class="form-label">Select Student:</label>
                            <select name="student" class="form-control students @error('student') is-invalid @enderror">
                            <option value="">Choose Student</option>
                            @foreach($students as $_data)
                            <option value="{{$_data->id}}" {{ $data->student == $_data->id ? "selected" : "" }}>{{$_data->name}}</option>
                            @endforeach
                            </select>
                            @error('student')
                                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>  

                    <div class="col-md-6">
                            <div class="form-group">
                            <label class="form-label">Page Slug</label>
                            <input type="text" value="{{$data->slug}}" name="slug" placeholder="Enter Page title" class="slug form-control {{$errors->has('slug') ? 'is-invalid':''}}">
                            @error('slug')
                                <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                            </div>
                        </div>
                        </div>


                <div class="row mb-3">
                <div class="col-md-4">
                        <div class="form-group fundraisers">
                            <label class="form-label">Select Fundraiser:</label>
                            <select name="fundraiser" class="form-control fundraiser @error('fundraiser') is-invalid @enderror">
                            <option value="">Choose Fundraiser</option>
                            @foreach($fundraisers as $_data)
                            <option value="{{$_data->id}}" {{ $data->fundraiser == $_data->id ? "selected":"" }}>{{$_data->name}}</option>
                            @endforeach
                            </select>
                            @error('fundraiser')
                                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>  

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Fundraiser Student Goal $:</label>
                            <input type="number" name="student_goal" value="{{$data->student_goal}}" class="form-control student_goal {{$errors->has('student_goal') ? 'is-invalid':''}}" placeholder="Fundraiser Each Student Goal $ ">
                            @error('student_goal')
                                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Team:</label>
                            <input type="text" name="team" value="{{$data->team}}" class="form-control team {{$errors->has('team') ? 'is-invalid':''}}" placeholder="Enter name of Team, Academi Club, Booster Club, Other Cause etc">
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
                       
                        <option value="image" {{$data->cover_type == 'Image' ? 'Selected' : ''}}>Image</option>
                       
                        <option value="video" {{$data->cover_type == 'Video' ? 'Selected' : ''}}>Video</option>
                      
                    </select>
                </div>

                @if($data->cover_type == 'Image')
                <img src="/uploads/pages/{{$data->cover_url}}" class="mb-5 rounded mx-auto d-block" style="width:140px" alt="">
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
                    <input type="url" value="{{$data->cover_url}}" name="featured_video" class="form-control {{$errors->has('featured_video') ? 'is-invalid':''}}" placeholder="URL">
                    @error('featured_video')
                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                    @enderror  
                </div>

                <div class="form-group">
                    <input type="submit" value="Update Page" class="btn btn-block btn-primary w-100">
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

   // Get District Name
   $('.students').on('change', function() {
        let fundraiser = $(".students option:selected").text();
        $.ajax({
            url: "{{ route('checkSlug') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "GET",
            data: {
                fundraiser
            },
            success: function(res) {
                $(".slug").val(res.slug);
            }
        });
    });


    // Get Student $ goal from fundraiser Main Page
    $('.fundraiser').on('change', function() {
        let fundraiser = $(".fundraiser option:selected").val();
        
        $.ajax({
            url: "{{ route('checkStudentGoal') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "GET",
            data: {
                fundraiser
            },
            success: function(res) {
                $(".student_goal").val(res.student_goal.student_goal);
                $(".team").val(res.student_goal.team);
            }
        });
    });
    


  
    });

</script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/tinymce.js') }}"></script>

@endpush
