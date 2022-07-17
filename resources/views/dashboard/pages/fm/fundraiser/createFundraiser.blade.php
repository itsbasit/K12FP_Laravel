@extends('dashboard.layout.master')
@section('title','Add Fundraiser')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fundraisers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Fundraiser</li>
    </ol>
</nav>


<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">

          
                <form class="forms-sample" method="POST" enctype="multipart/form-data" action="{{route('fund_raisers.store')}}">
                    <h4 class="mb-5">Add New Fundraiser</h4>
                    @csrf

                    
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label class="form-label">Fundraiser Name:</label>
                            <input name="name" value="{{old('name')}}" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="Enter District Name">
                            @error('name')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Color:</label>
                                <input name="color" type="color" class="form-control mb-4 mb-md-0" required>
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">State:</label>
                                    <select class="js-example-basic-single w-100" id="state" name="stateName" required>
                                        <option>Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state->stateName}}">{{$state->stateName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">County:</label>
                                    <select class="js-example-basic-single w-100" id="county" name="countyName" required>
                                        <option>Select County</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">District:</label>
                                    <select class="js-example-basic-single w-100" id="district" name="districtName"
                                        required>
                                        <option>Select District</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">School:</label>
                                    <select class="js-example-basic-single w-100 {{$errors->has('school') ? 'is-invalid':''}}" id="school" name="school" required>
                                        <option>Select School</option>
                                    </select>
                                    @error('school')
                                    <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <label class="form-label">Choose Fundraiser Logo:</label>
                                    <input name="logo" type="file" id="myDropify" class="border {{$errors->has('logo') ? 'is-invalid':''}}"/>
                                @error('logo')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary w-100" value="Create">
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
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
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
