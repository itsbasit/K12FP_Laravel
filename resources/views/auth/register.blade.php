@extends('layouts.app')

@section('content')
<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url(https://www.nobleui.com/laravel/template/demo1-ds/assets/images/photos/img6.jpg)">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
            <a href="#" class="noble-ui-logo d-block mb-2"> {{ config('app.name', 'K12FP') }}</span></a>
              <h5 class="text-muted fw-normal mb-4">Create a free account. </h5>
              <form class="forms-sample" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                          <div class="col">
                          <div class="mb-3">
                  <label for="exampleInputUsername1" class="form-label">First Name:</label>
                  <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                          </div>

                          <div class="col">

                          <div class="mb-3">
                  <label for="exampleInputUsername1" class="form-label">Last Name:</label>
                  <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                          </div>
                        </div>
                



                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email address</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

          
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              
                </div>
      
                <div>
                  <button type="submit" class="btn btn-primary me-2 w-100 mb-2 mb-md-0">Sign up</button>
                  
                </div>
                <a href="/login" class="d-block mt-3 text-muted">Already a user? Sign in</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
    </div>
  </div>

@endsection
