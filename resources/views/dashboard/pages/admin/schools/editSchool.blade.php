@extends('dashboard.layout.master')
@section('title','Edit School')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
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
          
            <form class="forms-sample" method="POST" action="{{route('schools.update', $school->id)}}">
            <h4 class="mb-5">Update School</h4>
            @csrf
            @method('put')
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
                <fieldset>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <select class="js-example-basic-single w-100" name="districtName" required>
                      <option value="{{$school->districtName}}">{{$school->districtName}}</option>
                      @foreach ($districts as $district)
                      <option value="{{$district->districtName}}">{{$district->districtName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">School Name</label>
                    <input name="schoolName" value="{{$school->schoolName}}" class="form-control mb-4 mb-md-0" placeholder="Enter School Name">
                  </div>
                  
                  <input class="btn btn-primary" type="submit" value="Submit">
                </fieldset>
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
  @endpush
  @push('custom-scripts')
  <script>
    $(function() {
    // validate signup form on keyup and submit
    $("#addSchool").validate({
      rules: {
        schoolName: {
          required: true,
          minlength: 5
        },
        districtName: {
          required: true,
        },
       
      },
      messages: {
        name: {
          required: "Please enter a name",
          minlength: "Name must consist of at least 5 characters"
        },
        districtName: {
          required: "Please select District",
        },
       
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
  });

  </script>
  @endpush
