@extends('dashboard.layout.master')
@section('title','Add Fundraiser')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
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

                <form class="forms-sample" method="POST" action="{{route('fund_raisers.store')}}">
                    <h4 class="mb-5">Add New Fundraiser</h4>
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                                <label class="form-label">Fundraiser Name:</label>
                                <input name="name" class="form-control mb-4 mb-md-0" placeholder="Enter District Name"
                                    required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Color:</label>
                                <input name="color" type="color" class="form-control mb-4 mb-md-0" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">State:</label>
                                <select class="js-example-basic-single w-100" id="state" name="stateName" required>
                                    <option>Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{$state->stateName}}">{{$state->stateName}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">County:</label>
                                <select class="js-example-basic-single w-100" id="county" name="countyName" required>
                                    <option>Select County</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">District:</label>
                                <select class="js-example-basic-single w-100" id="district" name="districtName"
                                    required>
                                    <option>Select District</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">School:</label>
                                <select class="js-example-basic-single w-100" id="school" name="schoolName" required>
                                    <option>Select School</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Logo:</label>
                                <input name="logo" type="file" class="form-control mb-4 mb-md-0">
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

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush


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