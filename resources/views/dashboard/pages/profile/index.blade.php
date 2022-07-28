@extends('dashboard.layout.master')
@section('title','Profile')

@push('plugin-styles')
<style>

.container {
  max-width: 960px;
  /* margin: 30px auto; */
  padding: 20px;
}

.avatar-upload {
  position: relative;
  max-width: 205px;
  margin: 5px auto;
}
.avatar-upload .avatar-edit {
  position: absolute;
  right: 12px;
  z-index: 1;
  top: 10px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\f040";
  font-family: 'FontAwesome';
  color: #757575;
  position: absolute;
  top: 10px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 192px;
  height: 192px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

</style>
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
    </ol>
</nav>


<div class="row profile-body">
  <!-- left wrapper start -->
  <div class="d-none d-md-block col-md-3 col-xl-3 left-wrapper">
    <div class="card rounded">
      <div class="card-body">
      <div class="container">
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url('https://via.placeholder.com/150x150');">
            </div>
        </div>
    </div>
</div>
        <h6 class="text-center card-title mb-0">{{$data->first_name .' '. $data->last_name}}</h6>
        
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
          <p class="text-muted">{{date_format($data->created_at,"d-M-Y")}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Position:</label>
          <p class="text-muted">{{$data->position}}</p>
        </div>

        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Organization:</label>
          <p class="text-muted">{{$data->org_name}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
          <p class="text-muted">{{$data->email}}</p>
        </div>

        
      
      </div>
    </div>
  </div>
  <!-- left wrapper end -->

  <div class="col-md-6 col-xl-6">
  <div class="card rounded">
    <div class="card-body">
    <form class="forms-sample" method="POST" action="">
                <h4 class="mb-3">Profile Update</h4>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Position:</label>
                            <input name="position" value="{{ $data->position }}" class="form-control mb-4 mb-md-0 {{$errors->has('position') ? 'is-invalid':''}}" placeholder="Position" required>
                            @error('position')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Full Name:</label>
                            <input name="name" value="{{ $data->first_name }}" class="form-control mb-4 mb-md-0 {{$errors->has('name') ? 'is-invalid':''}}" placeholder="Full Name" required>
                            @error('name')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Organization Type:</label>
                            <select name="org_type" class="form-control">
                                <option value="{{$data->orgType}}" selected>{{$data->orgType}}</option>
                                <option value="Booster Club">Booster Club</option>
                                <option value="Academic Club">Academic Club</option>
                                <option value="Sports Team">Sports Team</option>
                                <option value="Band">Band</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div> 
                </div>

            <div class="row mb-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label text-danger">Your Checks for Funds Raised Will Be Made Payable To Your Organization Name
                        </label>
                    </div>
                </div>
            </div>
                <!-- Parent Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Organization Name:</label>
                            <input name="org_name" value="{{ $data->org_name }}" class="form-control mb-4 mb-md-0 {{$errors->has('org_name') ? 'is-invalid':''}}" placeholder="Organization Name" required>
                            @error('org_name')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Organization Street Address:</label>
                            <input type="text" name="streetAddress" value="{{ $data->streetAddress }}" class="form-control mb-4 mb-md-0 {{$errors->has('streetAddress') ? 'is-invalid':''}}" placeholder="Organization Street Address" required>
                            @error('streetAddress')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>
   
                </div>


                <div class="row mb-3">
                <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Organization State:</label>
                            <input name="org_state" type="tel" value="{{ $data->orgState }}" class="form-control mb-4 mb-md-0 {{$errors->has('org_state') ? 'is-invalid':''}}" placeholder="Organization State" >
                            @error('org_state')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>  

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">ZipCode:</label>
                            <input type="text" name="zipcode" value="{{ $data->zipCode }}" class="form-control mb-4 mb-md-0 {{$errors->has('zipcode') ? 'is-invalid':''}}" placeholder="Zip Code" required>
                            @error('zipcode')
                            <label id="name-error" class="error invalid-feedback" for="name">{{$message}}</label>
                            @enderror
                        </div>
                    </div>

                </div>

                

               

                <div class="row mb-3">
                    <div class="col">
                    <div class="form-group">
                        <input type="submit" value="Add Student" class="btn btn-block btn-primary w-100">
                    </div>
                    </div>
                </div>
              
                </form>
    </div>
    </div>
  </div>


  <!-- Third col -->
  <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
    <div class="card rounded">
      <div class="card-body">
       
      <form class="forms-sample" method="POST" action="">
                <h4 class="mb-3">Update Password</h4>
                @csrf
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Old Password:</label>
                            <input name="old_password" class="form-control mb-4 mb-md-0" placeholder="******" required>
                        </div>
                    </div>

                    <div class="col-12">
                    <div class="form-group">
                            <label class="form-label">New Password:</label>
                            <input name="password" class="form-control mb-4 mb-md-0" placeholder="******" required>
                        </div>
                    </div>

                    <div class="col-12">
                    <div class="form-group">
                            <label class="form-label">Confirm Password:</label>
                            <input name="confirn_password" class="form-control mb-4 mb-md-0" placeholder="******" required>
                        </div>
                    </div> 
                </div>

            

                <div class="row mb-3">
                    <div class="col">
                    <div class="form-group">
                        <input type="submit" value="Add Student" class="btn btn-block btn-primary w-100">
                    </div>
                    </div>
                </div>
              
                </form>
        
      </div>
    </div>
  </div>


</div>


@endsection

@push('custom-scripts')
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
</script>
@endpush