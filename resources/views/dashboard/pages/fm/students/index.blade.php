@extends('dashboard.layout.master')
@section('title','Students')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">High Students</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive overflow-auto">
                    <div class="d-flex mb-3 ">
                        <a href="{{url('fm/students/create')}}" class="ml-auto  btn btn-primary">Add New
                            Student</a>
                    </div>
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cell Phone</th>
                                <th>k12FP Reg #</th>
                                <th>Grad Year</th>
                                <th>Grade</th>
                                <th>School</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')

<script>
// Get records

$(function() {

    var table = $('#dataTableExample').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('students.index') }}",
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'cell',
                name: 'cell'
            },
            {
                data: 'k12fp_number',
                name: 'k12fp_number'
            },
            {
                data: 'graduation_year',
                name: 'graduation_year'
            },
            {
                data: 'grade',
                name: 'grade'
            },
            {
                data: 'schoolName',
                name: 'schoolName'
            },
            
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

});

$(document).on('click', '.delete', function() {
    var id = $(this).data('id');

    swal({
        title: `Are you sure you want to delete this record?`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "DELETE",
                url: "fund_raisers/" + id,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#dataTableExample').DataTable().ajax.reload();
                }
            });
        }
    });
});
</script>
@endpush