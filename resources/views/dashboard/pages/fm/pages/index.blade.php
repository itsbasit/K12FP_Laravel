@extends('dashboard.layout.master')
@section('title','Fundraiser Pages')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fundraiser Pages</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        
        <div class="card">
            <div class="card-body">
     

                <div class="table-responsive overflow-auto">
                  
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Fundraiser</th>
                                <th>Student</th>
                                <th>Total Goal $</th>
                                <th>Student Goal $</th>
                                <th>Team</th>
                                <th>Page Type</th>
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
        ajax: "{{url('fm/pages')}}",
        columns: [
           
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'studentName',
                name: 'studentName',
                render: function( data, type, full, meta ) {
                        return data ? data : '-----';
                    }
            },
            {
                data: 'total_goal',
                name: 'total_goal',
                render: function( data, type, full, meta ) {
                        return '$' + data;
                    }
            },
            {
                data: 'student_goal',
                name: 'student_goal',
                render: function( data, type, full, meta ) {
                        return '$' + data;
                    }
                
            },
            {
                data: 'team',
                name: 'team',
                
            },

            {
                data: 'cover_type',
                name: 'cover_type',
                render: function( data, type, full, meta ) {
                        return full.student != null ? "<span class='badge bg-info text-white'>Student</span>" : "<span class='badge bg-info text-white'>Main</span>";
                    }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],

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
                type: "GET",
                url: "page/destroy/" + id,
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