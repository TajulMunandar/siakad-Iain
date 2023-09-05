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
</head>

<body>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light" >
    {{-- Header --}}
    <header class="header header-sticky mb-4" >
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
            <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
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
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
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

    {{-- En Header --}}
    @if (auth()->user()->isAdmin == 1)

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <div class="row">
          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Data Master</h5>
                <p class="card-text">
                  Mengelola Data Master.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('fakultas.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Absensi dan Berita Acara</h5>
                <p class="card-text">
                  Mengelola absensi dan berita acara mata kuliah.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('absensi.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Kontrak Mahasiswa</h5>
                <p class="card-text">
                  Mengelola Kontrak Mahasiswa.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('kontrak.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Rencana Perkuliahan Semester</h5>
                <p class="card-text">
                  Mengelola Rencana Perkuliahan Tiap Semester.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('rps.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-lg-3 mt-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Survei</h5>
                <p class="card-text">
                  Mengelola Survei .
                </p>
                <div class="mt-auto">
                  <a href="{{ route('survei.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    @else
    <div class="body flex-grow-1 px-3" >
      <div class="container-lg">

        <div class="row">
          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Absensi dan Berita Acara</h5>
                <p class="card-text">
                  Mengelola absensi dan berita acara mata kuliah.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('absensi.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Kontrak Mahasiswa</h5>
                <p class="card-text">
                  Mengelola Kontrak Mahasiswa.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('kontrak.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Rencana Perkuliahan Semester</h5>
                <p class="card-text">
                  Mengelola Rencana Perkuliahan Tiap Semester.
                </p>
                <div class="mt-auto">
                  <a href="{{ route('rps.index') }}" class="btn btn-primary stretched-link d-block">Masuk</a>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    @endif
  </div>
  <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>

</html>
