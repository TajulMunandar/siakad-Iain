<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="theme-color" content="#ffffff">
  @vite('resources/sass/app.scss')
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
</head>

<body>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    {{-- Header --}}
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <ul class="header-nav d-flex">
          <li class="nav-item">
            <a class="nav-link fw-bold fs-5" href="{{ route('dashboard') }}">Dashboard</a>
          </li>
        </ul>
        <ul class="header-nav ms-auto">

        </ul>
        <ul class="header-nav ms-3">
          <li class="nav-item dropdown">
            <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
              <a class="dropdown-item" href="{{ route('profile.show') }}">
                <svg class="icon me-2">
                  <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                </svg>
                {{ __('My profile') }}
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); this.closest('form').submit();">
                  <svg class="icon me-2">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                  </svg>
                  {{ __('Logout') }}
                </a>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </header>

    <div class="container">
      <div class="row d-flex justify-content-center mt-md-5">
        <div class="col-sm-6">
          <div class="card mb-4">
            <div class="card-header">
              {{ __('My profile') }}
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
              @csrf
              @method('PUT')

              <div class="card-body">

                @if ($message = Session::get('success'))
                  <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg></span>
                  <input class="form-control" type="text" name="name"
                    placeholder="{{ __('Name') }}"
                    value="{{ old('name', auth()->user()->name) }}" required>
                  @error('name')
                    <span class="invalid-feedback">
                      {{ $message }}
                    </span>
                  @enderror
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                    </svg></span>
                  <input class="form-control" type="text" name="username"
                    placeholder="{{ __('Username') }}"
                    value="{{ old('username', auth()->user()->username) }}" required>
                  @error('username')
                    <span class="invalid-feedback">
                      {{ $message }}
                    </span>
                  @enderror
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                    </svg></span>
                  <input class="form-control @error('password') is-invalid @enderror"
                    type="password" name="password" placeholder="{{ __('New password') }}"
                    required>
                  @error('password')
                    <span class="invalid-feedback">
                      {{ $message }}
                    </span>
                  @enderror
                </div>

                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                    </svg></span>
                  <input class="form-control @error('password_confirmation') is-invalid @enderror"
                    type="password" name="password_confirmation"
                    placeholder="{{ __('New password confirmation') }}" required>
                </div>

              </div>

              <div class="card-footer d-flex justify-content-between">
                <a href="/dashboard" class="btn btn-outline-secondary text-dark" >
                  <i class="fa-regular fa-chevron-left me-1"></i>
                  {{ __('Kembali') }}
                </a>
                <button class="btn btn-primary" type="submit">{{ __('Simpan') }}</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>

</html>
