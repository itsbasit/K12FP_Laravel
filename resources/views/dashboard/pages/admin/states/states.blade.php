@extends('dashboard.layout.master')
@section('title','States')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">States</a></li>
    <li class="breadcrumb-item active" aria-current="page">All States</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body"> 
        <div class="table-responsive">
          <div class="d-flex mb-3 ">
            <a href="{{url('admin/states/create')}}" class="ml-auto  btn btn-primary">Add State</a>
          </div>
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>State Name</th>
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
  {{-- <script src="{{ asset('assets/js/data-table.js') }}"></script> --}}
  <script>

    // Get records

    $(function () {
    
    var table = $('#dataTableExample').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('states.index') }}",
        columns: [
            {data: 'stateName', name: 'stateName'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });


    $(document).on('click', '.delete', function() {
                    var id = $(this).data('id');
                    if (confirm("Are you sure you want to Delete this Record")) {
                        $.ajax({
                            type: "DELETE",
                            url: "states/" + id,
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                $('#dataTableExample').DataTable().ajax.reload();
                            }
                        });
                    }
                });
  </script>
@endpush