@extends('dashboard.layout.master')
@section('title','Edit Fundraiser')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Fundraisers</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update Fundraiser</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">

            <form class="forms-sample" method="POST" action="{{route('fund_raisers.update', $data->id)}}">
            <h4 class="mb-5">Update Fundraiser</h4>
            @csrf
            @method('put')
            <div class="row mb-3">
              <div class="col-md-6 offset-md-3">
                  <div class="form-group">
                      <label class="form-label">Fundraiser Name:</label>
                  <input name="name" value="{{$data->name}}" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="Enter District Name">
                  @error('name')
                  <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                  @enderror
                  </div>

                  <div class="form-group">
                      <label class="form-label">Color:</label>
                      <input name="color" value="{{$data->color}}" type="color" class="form-control mb-4 mb-md-0" required>
                  </div>

                  <div class="form-group">
                      <label class="form-label">School:</label>
                      <select class="js-example-basic-single w-100 {{$errors->has('schoolName') ? 'is-invalid':''}}" id="school" name="schoolName" required>
                          <option selected>{{$data->school}}</option>
                          <option>Select School</option>
                      </select>
                      @error('schoolName')
                      <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                      @enderror
                  </div>


                  <div class="form-group">
                      <label class="form-label">Logo:</label>
                      <input name="logo" type="file" class="form-control mb-4 mb-md-0 {{$errors->has('logo') ? 'is-invalid':''}}">
                      @error('logo')
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
$('#state').on('change', function() {
    var stateName = $('#state').val();
    $.ajax({
        url: "../getCounty",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: "GET",
        data: {
            stateName
        },
        success: function(res) {
            var data = JSON.parse(res);
            let html = "<option value=''>Select County</option>";
            data.forEach(element => {
                html += '<option value="' + element.countyName + '">' + element.countyName +
                    '</option>';
            });
            $('#county').html(html);
        }
    });
});

// Get District Name
$('#county').on('change', function() {
    var countyName = $('#county').val();
    $.ajax({
        url: "../getDistricts",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: "GET",
        data: {
            countyName
        },
        success: function(res) {
            var data = JSON.parse(res);
            let html = "<option value=''>Select District</option>";
            data.forEach(element => {
                html += '<option value="' + element.districtName + '">' + element
                    .districtName +
                    '</option>';
            });
            $('#district').html(html);
        }
    });
});


// Get School Name
$('#district').on('change', function() {
    var districtName = $('#district').val();
    $.ajax({
        url: "../getSchools",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: "GET",
        data: {
            districtName
        },
        success: function(res) {
            var data = JSON.parse(res);
            let html = "<option value=''>Select School</option>";
            data.forEach(element => {
                html += '<option value="' + element.id + '">' + element
                    .schoolName +
                    '</option>';
            });
            $('#school').html(html);
        }
    });
});
</script>
@endpush