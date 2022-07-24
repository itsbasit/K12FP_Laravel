@extends('dashboard.layout.master')
@section('title','Fundraisers')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fund raisers</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive overflow-auto">
                    <div class="d-flex mb-3 ">
                        <a href="{{url('fm/fund_raisers/create')}}" class="ml-auto  btn btn-primary">Add New
                            Fundraiser</a>
                    </div>
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                
                                <th>Fundraiser Name</th>
                                <th>Color</th>
                                <th>Money Raising For?</th>
                                <th>Total Goal $</th>
                                <th>School Name</th>
                                <th>Fundraiser Logo</th>
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
        ajax: "{{ route('fund_raisers.index') }}",
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'money_raising_for',
                name: 'money_raising_for'
            },
            {
                data: 'color',
                name: 'color'
            },
            {
                data: 'total_goal',
                name: 'total_goal'
            },
            {
                data: 'schoolName',
                name: 'schoolName'
            },
            {
                data: 'logo',
                name: 'logo',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/uploads/" + data + "\" height=\"50\"/>";
                    }
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