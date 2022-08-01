@extends('layouts.app')

@section('content')

<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">

      @if ($message = Session::get('success'))
    <div class="w3-panel w3-green w3-display-container">
        <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-green w3-large w3-display-topright">&times;</span>
        <p>{!! $message !!}</p>
    </div>
    <?php Session::forget('success');?>
    @endif
@if ($message = Session::get('error'))
    <div class="w3-panel w3-red w3-display-container">
        <span onclick="this.parentElement.style.display='none'"
                class="w3-button w3-red w3-large w3-display-topright">&times;</span>
        <p>{!! $message !!}</p>
    </div>
    <?php Session::forget('error');?>
    @endif
    
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
              <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account. </h5>
              <form class="forms-sample" method="POST" action="{{ route('login') }}">
                        @csrf
              
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email address</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
               
                </div>

                <div class="form-group">
                <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="authCheck">
                    Remember me
                  </label>
                </div>
                </div>

                
                <div>
                  <button type="submit" class="btn btn-primary me-2 w-100 mb-2 mb-md-0">Sign In</button>
                  
                </div>
                <div class="d-flex">
                <a href="{{route('register')}}" class="d-block mt-3 text-muted">Not a user? Sign Up</a>
                @if (Route::has('password.request'))
                    <a class="d-block mt-3 mx-3 btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
               
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
