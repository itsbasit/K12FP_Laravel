@extends('layouts.master')
@section('title','Fund Manager Registration')
@section('content')
<section class="breadcrumb text-center text-light">
    <div class="container ">
        <div class="row">
            <div class="col">
                <h1 class="text-light">Fund Manager</h1>
                <p>Sign Up below to Create your account!</p>
            </div>
        </div>
    </div>
</section>

<section class="register">
    <div class="container">
        <div class="row pt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Register yourself</h5>
                        @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                           <ul>
                              @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                              @endforeach
                           </ul>
                        </div>
                     @endif
                    
                <form id="register" method="POST" action="{{url('register-fund-manager')}}" class="text-start mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" name="position" placeholder="Your Title or Position" >
                                <label for="position">Position</label>
                              </div>
                        </div>
                        <div class="col-md-6 col">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                <label for="firstname">First Name</label>
                              </div>
                        </div>
                    </div>
    
                  
                    <div class="row">
                        <div class="col-md-6 col">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" name="last_name" placeholder="First Name">
                                <label for="firstname">Last Name</label>
                              </div>
                        </div>

                        <div class="col-md-6 col">
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" >
                                <label for="position">Email Address</label>
                              </div>
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="col-md-6 col">
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" placeholder="Password" >
                                <label for="position">Password</label>
                              </div>
                        </div>
                        <div class="col-md-6 col">
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" placeholder="Confirm Password">
                                <label for="firstname">Confirm Password</label>
                              </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-4">
                                <p>Check Appropriate</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" checked type="radio" name="orgType" id="inlineRadio1" value="Booster Club">
                                    <label class="form-check-label">Booster Club</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="orgType" id="inlineRadio2" value="Academic Club">
                                    <label class="form-check-label">Academic Club</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="orgType" id="inlineRadio3" value="Sports Team">
                                    <label class="form-check-label">Sports Team</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="orgType" id="inlineRadio4" value="Band">
                                    <label class="form-check-label">Band</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="orgType" id="inlineRadio5" value="Other Cause">
                                    <label class="form-check-label">Other Cause</label>
                                  </div>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p>Payment Details</p>
                            <h6>Your Checks for Funds Raised Will Be Made Payable To Your Organization Name</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating mb-4">
                                <input type="text" name="org_name" class="form-control" placeholder="Name of Organization">
                                <label for="firstname">Name of Organization</label>
                              </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating mb-4">
                                <input type="text"name="streetAddress" class="form-control" placeholder="Organization Street Address">
                                <label for="firstname">Organization Street Address</label>
                              </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating mb-4">
                                <input type="text"name="orgState" class="form-control" placeholder="Organization State">
                                <label for="firstname">Organization State</label>
                              </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-floating mb-4">
                                <input type="text"name="zipCode" class="form-control" placeholder="ZipCode">
                                <label for="firstname">ZipCode</label>
                              </div>
                        </div>
                    </div>
    
                    <input type="submit" class="btn btn-primary btn-login mb-2" value="Register" >
                  </form>
            
                </div>
            </div>
                </div>
        </div>
    </div>
</section>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
@push('custom-scripts')
<script>
  $(function() {
  // validate signup form on keyup and submit
  $("#register").validate({
    rules: {
      position: {
        required: true,
        minlength: 5
      },
      position: {
        required: true,
      },
     
    },
    messages: {
        position: {
        required: "Please enter a name",
        minlength: "Name must consist of at least 5 characters"
      },
      districtName: {
        required: "Please select District",
      },
     
    },
    errorPlacement: function(label, element) {
      label.addClass('mt-2 text-danger');
      label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
      $(element).parent().addClass('has-danger')
      $(element).addClass('form-control-danger')
    }
  });
});

</script>
@endpush