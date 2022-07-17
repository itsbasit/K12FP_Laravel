@extends('dashboard.layout.master')
@section('title','Add Student')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Students</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
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
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label class="form-label">Student Name:</label>
                            <input name="name" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="Enter District Name">
                            </div>
                            </div>

                            <div class="col-md-6">
                          asd
                                


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
    
    
    </script>
@endpush
