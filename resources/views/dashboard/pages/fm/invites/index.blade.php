@extends('dashboard.layout.master')
@section('title','Invites')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Send Invites</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
    </ol>
</nav>
<div class="row mb-5">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
    <form action="{{url('fm/submitQueue')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 offset-md-2">
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="gender_radio" id="checkbox">
                <label class="form-check-label" for="gender1">
                  Select All Students
                </label>
              </div>
            <div class="form-group">
                <label class="form-label">Select Students to Send Invitation</label>
                <select id="students_select" multiple name="email[]" class="js-example-basic-multiple w-100 form-select select2-hidden-accessible">   
                @foreach($students as $email)
                        @if($email->student_type == 'High')
                        <option value="{{$email->email}}">{{$email->email}}</option>
                        @else
                        <option value="{{$email->parentEmail}}">{{$email->parentEmail}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send">
            </div>
            </div>
        </div>
    </form>
            
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive overflow-auto">
                   
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
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
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush

@push('custom-scripts')

<script>
// Get records

$(function() {

    var table = $('#dataTableExample').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('fm/invites_list') }}",
        columns: [
         
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'signedUp',
                name: 'signedUp',
                render: function( data, type, full, meta ) {
                        return data ? 'Signed Up': 'Registration Pending';
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
                url: "students/" + id,
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


$("#checkbox").click(function(){
    if($("#checkbox").is(':checked') ){
        $("#students_select > option").prop("selected","selected");
        $("#students_select").trigger("change");
    }else{
        alert("else calling");
        $("#students_select > option").removeAttr("selected");
         $("#students_select").trigger("change");
     }
});

</script>
@endpush