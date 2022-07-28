@extends('dashboard.layout.master')
@section('title','Fundraisers')


@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Fundraisers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Details</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
  
        <h4 class="pb-3">Fundraiser Name: {{$data->name}}</h4>
        <div class="container-fluid d-flex justify-content-between">
        <div class="table-responsive w-100">
              <table class="table table-bordered">
 
                <tbody>
                  <tr class="text-end">
                    <td class="text-start"><strong>Started At</strong></td>
                    <td class="text-start">{{$data->created_at}}</td>
                    <td class="text-start"><strong>School</strong></td>
                    <td class="text-start">{{$data->schoolName}}</td>
                  </tr>

                  <tr class="text-end">
                    <td class="text-start"><strong>Ended At</strong></td>
                    <td class="text-start">{{$data->ended_at == null ? 'Not ended yet' : $data->ended_at}}</td>
                    <td class="text-start"><strong>Total Goal $</strong></td>
                    <td class="text-start">{{$data->total_goal}}</td>
                  </tr>

                  <tr class="text-end">
                    <td class="text-start"><strong>Status</strong></td>
                    <td class="text-start">{{$data->status}}</td>
                    <td class="text-start"><strong>Created By</strong></td>
                    <td class="text-start">{{$data->userName}}</td>
                  </tr>
                
                </tbody>
              </table>
            </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
            <h4 class="pb-3">Transactions History</h4>
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>Tx ID#</th>
                      <th>Donar Name</th>
                      <th class="text-end">Donar Email</th>
                      <th class="text-end">Donated To</th>
                      <th class="text-end">Amount Donated</th>
                      <th class="text-end">Donation Date</th>
                    </tr>
                </thead>
                <tbody>
                  <tr class="text-end">
                    <td class="text-start">1</td>
                    <td class="text-start">PSD to html conversion</td>
                    <td>02</td>
                    <td>$55</td>
                    <td>$110</td>
                    <td>$110</td>
                  </tr>
                 
                </tbody>
              </table>
            </div>
        </div>


      </div>
        </div>
    </div>
</div>
@endsection
