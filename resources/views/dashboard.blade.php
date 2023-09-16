<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    <style>
        .image {
            height: 270px;
            background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(90,92,106,1) 0%, rgba(32,45,58,1) 81.3% );
            background-repeat: no-repeat;
            background-size: cover;
        }

        .card {
            height: auto;
            border: none;
            background-color: #f4f4f5;
            box-shadow: 0 20px 34px rgb(196 201 219 / 50%);
            transition: 0.5s;
        }

        .card:hover {
            box-shadow: 0 20px 34px #3c91d65d;
        }

        .card-body {
            padding-left: 30px;
            padding-right: 40px;
            margin-top: 10px;
        }

        .caption {
            padding: 60px;
            padding-left: 110px;
        }
    </style>
    @vite('resources/sass/app.scss')
</head>

<body>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        {{-- Header --}}
        <header class="header header-sticky ">
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

        {{-- En Header --}}

        <div class="row-cols-12 image d-flex mb-3">
            <div class="col caption d-none d-md-block text-white mt-3">
                <div id="current_date" ></div>
                <p class="fs-2 mb-0 fw-bold">Selamat Datang {{ auth()->user()->name }}!</p>
                <p >Semoga Harimu Menyenangkan.</p>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="px-5">
                    <lottie-player src="https://lottie.host/3a3cba81-7c1a-43fa-b3f2-71b6964a60ce/6WZsFOX4Wb.json"
                        speed="1" style="width: 450px; height: 280px" loop autoplay direction="1"
                        mode="normal"></lottie-player>
                </div>
            </div>
        </div>

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
                                        <a href="{{ route('fakultas.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
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
                                        <a href="{{ route('absensi.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
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
                                        <a href="{{ route('kontrak.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
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
                                        <a href="{{ route('rps.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
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
                                        <a href="{{ route('survei.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="body flex-grow-1 px-3">
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
                                        <a href="{{ route('absensi.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
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
                                        <a href="{{ route('kontrak.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
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
                                        <a href="{{ route('rps.index') }}"
                                            class="btn btn-primary stretched-link d-block">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        const zeroFill = n => {
            return ('0' + n).slice(-2);
        }

        // Creates interval
        const interval = setInterval(() => {
            // Get current time
            const now = new Date();

            // Format date as in mm/dd/aaaa hh:ii:ss
            const dateTime = zeroFill((now.getMonth() + 1)) + '/' + zeroFill(now.getUTCDate()) + '/' + now
                .getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(
                    now.getSeconds());

            // Display the date and time on the screen using div#date-time
            document.getElementById('current_date').innerHTML = dateTime;
        }, 1000);
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>

</html>
