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

            <form class="forms-sample" method="POST" action="{{route('elementary_students.update', $data->id)}}">
            <h4 class="mb-5">Update Student</h4>
            @csrf
            @method('put')
         
            <div class="row mb-3">
              <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Full Name:</label>
                        <input name="name" value="{{$data->name}}" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="Full Name" required>
                      @error('name')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                      </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Email Address:</label>
                        <input name="email" type="email" value="{{$data->email}}" class="form-control mb-4 mb-md-0 {{$errors->has('email') ? 'is-invalid':''}}" placeholder="Email Address" required>
                      @error('email')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                      </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Cell Phone:</label>
                        <input name="cell" type="tel" value="{{$data->cell}}" class="form-control mb-4 mb-md-0 {{$errors->has('cell') ? 'is-invalid':''}}" placeholder="Cell Phone" required>
                      @error('cell')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                      </div>
                </div>    
            </div>

            <!-- Parents Info -->

            <div class="row mb-3">
              <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Parent Full Name:</label>
                        <input name="parentName" value="{{$data->parentName}}" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="Full Name" required>
                      @error('parentName')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                      </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Parent mail Address:</label>
                        <input name="parentEmail" type="email" value="{{$data->parentEmail}}" class="form-control mb-4 mb-md-0 {{$errors->has('email') ? 'is-invalid':''}}" placeholder="Email Address" required>
                      @error('parentEmail')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                      </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Parent Cell Phone:</label>
                        <input name="parentCell" type="tel" value="{{$data->parentCell}}" class="form-control mb-4 mb-md-0 {{$errors->has('cell') ? 'is-invalid':''}}" placeholder="Cell Phone" required>
                      @error('parentCell')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                      </div>
                </div>    
            </div>

              <div class="row mb-3">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-label">K12FP Reg No#:</label>
                          <input name="k12fp_number" value="{{$data->k12fp_number}}" class="form-control mb-4 mb-md-0 {{$errors->has('k12fp_number') ? 'is-invalid':''}}" placeholder="k12FP Number" required>
                        @error('k12fp_number')
                        <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                        @enderror
                        </div>
                  </div>

                  <div class="col-md-6">
                  <div class="form-group">
                          <label class="form-label">Grade:</label>
                          <select name="grade" class="form-control" required>
                          <option value="{{$data->grade}}">{{$data->grade}}</option>   
                          @for($i=6; $i < 13; $i++ )
                              <option value="{{$i}}">{{$i}}</option> 
                          @endfor
                          </select>
                          @error('grade')
                          <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                          @enderror
                    </div>
                  </div>    
              </div>

              <div class="row mb-3">
                  <div class="col-md-6">
                  <div class="form-group">
                      <label class="form-label">Graduation Year:</label>
                      <select name="graduation_year" class="form-control {{$errors->has('graduation_year') ? 'is-invalid':''}}" required>
                      <option value="{{$data->graduation_year}}">{{$data->graduation_year}}</option>
                      @for($i = 0; $i < 7 ; $i++)
                      @php
                      $newDate = date("Y", strtotime(date("Y"). ' + '.$i.' years'));
                      @endphp
                      <option value="{{$newDate}}">{{$newDate}}</option> 
                      @endfor
                      </select>
                      @error('graduation_year')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-label">School:</label>
                          <select id="fetchSchools" name="school" class="js-example-basic-single w-100 select2-hidden-accessible" required>
                            <option selected value="{{$data->id}}">{{$data->schoolName}}</option>
                          </select>
                          @error('school')
                          <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                          @enderror
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