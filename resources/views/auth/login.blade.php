@extends('layouts.guest')

@section('content')
  <div class="col-lg-5">
    <div class="card-group d-block d-md-flex row">
      <div class="card col-md-7 p-4 mb-0">
        <div class="card-body">
          <h1>{{ __('Login') }}</h1>
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="">Username</label>
            <div class="input-group mb-3"><span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                </svg></span>
              <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" placeholder="{{ __('Username') }}" required autofocus>
              @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <label for="">Password</label>
            <div class="input-group mb-4">

              <span class="input-group-text">
                <svg class="icon">
                  <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                </svg></span>
              <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="{{ __('Password') }}" required>
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="row">
              <div class="col-12">
                <button class="btn btn-primary px-4 d-block w-100" type="submit">{{ __('Login') }}</button>
              </div>
              {{-- @if (Route::has('password.request'))
                <div class="col-6 text-end">
                  <a href="{{ route('password.request') }}" class="btn btn-link px-0" type="button">{{ __('Forgot Your Password?') }}</a>
                </div>
              @endif --}}
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
