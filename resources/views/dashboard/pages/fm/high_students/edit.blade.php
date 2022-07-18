@extends('dashboard.layout.master')
@section('title','Edit Student')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">High Students</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update Student</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">

            <form class="forms-sample" method="POST" action="{{route('students.update', $data->id)}}">
            <h4 class="mb-5">Update Student</h4>
            @csrf
            @method('put')
         
            <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Full Name:</label>
                            <input name="name" value="{{$data->name}}" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="First Name">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Email Address:</label>
                            <input name="email" value="{{$data->email}}" class="form-control mb-4 mb-md-0 {{$errors->has('email') ? 'is-invalid':''}}" placeholder="First Name">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Cell Phone:</label>
                            <input name="cell" value="{{$data->cell}}" class="form-control mb-4 mb-md-0 {{$errors->has('cell') ? 'is-invalid':''}}" placeholder="Last Name">
                        </div>
                    </div>    

                       
                </div>



                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">K12FP Reg No#:</label>
                            <input name="k12fp_number" value="{{$data->k12fp_number}}" class="form-control mb-4 mb-md-0 {{$errors->has('k12fp_number') ? 'is-invalid':''}}" placeholder="First Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Graduation Year:</label>
                            <input name="graduation_year" value="{{$data->graduation_year}}" class="form-control mb-4 mb-md-0 {{$errors->has('graduation_year') ? 'is-invalid':''}}" placeholder="Last Name">
                        </div>
                    </div>    
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Grade:</label>
                            <input name="grade" value="{{$data->grade}}" class="form-control mb-4 mb-md-0 {{$errors->has('grade') ? 'is-invalid':''}}" placeholder="First Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">School:</label>
                            <select id="fetchSchools" name="school" class="js-example-basic-single w-100 select2-hidden-accessible">
                              <option selected value="{{$data->id}}">{{$data->schoolName}}</option>
                            </select>
                        </div>
                    </div>    
                </div>

                <div class="row mb-3">
                    <div class="col">
                    <div class="form-group">
                        <input type="submit" value="Update Student" class="btn btn-block btn-primary w-100">
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
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// fetch schools on input
$(document).ready(function(){

$("#fetchSchools").select2({
   ajax: { 
     url: "/fm/getSchoolByName",
     type: "GET",
     dataType: 'json',
     delay: 250,
     data: function (params) {
       return {
          _token: CSRF_TOKEN,
          search: params.term
       };
     },
     processResults: function (response) {
       return {
         results: response
       };
     },
     cache: true
   }

});

});

</script>
@endpush