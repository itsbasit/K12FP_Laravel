@extends('dashboard.layout.master')
@section('title','Fundraisers')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fundraisers</a></li>
        <li class="breadcrumb-item active" aria-current="page">All Fundraisers</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>School</th>
                                <th>Money Raising For?</th>
                                <th>Total Goal $</th>
                                <th>Created At</th>
                                <th>Status</th>
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
        ajax: "{{ route('fundraisers') }}",
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'schoolName',
                name: 'schoolName'
            },
            {
                data: 'money_raising_for',
                name: 'money_raising_for'
            },
            {
                data: 'total_goal',
                name: 'total_goal'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            
            {
                data: 'status',
                name: 'status',
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
        text: 'By deleting all the pages linked with this fundraiser will be deleted',
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: "fundraisers/delete/" + id,
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


$(document).on('click', '.block', function() {
    var id = $(this).data('id');
    swal({
        title: `Are you sure you want to Active this Fundraiser?`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "PUT",
                url: "fundraisers/block/" + id,
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



$(document).on('click', '.unblock', function() {
    var id = $(this).data('id');
    swal({
        title: `Are you sure you want to block this Fundraiser?`,
        text: 'By blocking this fundraiser all the pages linked with this will stop working!',
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "PUT",
                url: "fundraisers/unblock/" + id,
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