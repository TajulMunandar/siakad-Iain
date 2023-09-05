<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap Core CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <title>Survei</title>
</head>

<body style="background-image: linear-gradient(to right, #F5F5F5, #F2EAD3);">

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="row">
                    <div class="col">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Login -->
                <div class="card shadow-md">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="justify-content-center">
                            <h1 class="navbar-brand fw-bold fs-1">
                                SKM-Kinerja Dosen
                            </h1>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Survei!</h4>

                        <form action="{{ route('survei-skm.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="dosen" class="form-label">Dosen</label>
                                        <select class="form-select @error('dosen') is-invalid @enderror" name="id_dosen"
                                            id="dosen">
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->id }}" selected>
                                                    {{ $dosen->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dosen')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="matakuliah" class="form-label">Mata Kuliah</label>
                                        <select class="form-select @error('matakuliah') is-invalid @enderror"
                                            name="id_matakuliah" id="matakuliah">
                                            @foreach ($matakuliahs as $matakuliah)
                                                <option value="{{ $matakuliah->id }}" selected>
                                                    {{ $matakuliah->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('matakuliah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Semester</label>
                                        <select class="form-select @error('semester') is-invalid @enderror"
                                            name="semester" id="semester">
                                              @for ($i = 1; $i <= 8; $i++)
                                              <option value="{{ $i }}" >
                                                  {{ $i }}
                                              </option>
                                              @endfor
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tahun" class="form-label">Tahun Akademik</label>
                                        <input type="name" class="form-control" id="tahun"
                                            aria-describedby="emailHelp" name="tahun_akademik">
                                    </div>
                                    @foreach ($surveis as $indikator => $questions)
                                        <h2 class="badge bg-primary mb-2 text-center"> Indikator
                                            {{ $questions->first()->indikatorSurvei->indikator }}</h2>
                                        @foreach ($questions as $soal)
                                            <div class="mb-3 fs-4">
                                                <label for="exampleInputPassword1"
                                                    class="form-label fs-4">{{ $loop->iteration }} .
                                                    {{ $soal->soal }}</label>
                                                <input type="hidden" name="id_soal[]" value="{{ $soal->id }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="skala_jawaban[{{ $soal->id }}]"
                                                            id="jawaban{{ $soal->id }}_{{ $i }}"
                                                            value="{{ $i }}"
                                                            >
                                                        <label class="form-check-label"
                                                            for="jawaban{{ $soal->id }}_{{ $i }}">
                                                            {{ $i }}
                                                        </label>
                                                    </div>
                                                @endfor
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label for="kendala" class="form-label">Kendala</label>
                                    <input type="name" class="form-control" id="kendala"
                                        aria-describedby="nameHelp" name="kendala">
                                </div>
                                <div class="mb-3">
                                    <label for="saran" class="form-label">Saran</label>
                                    <input type="name" class="form-control" id="saran"
                                        aria-describedby="emailHelp" name="saran">
                                </div>
                                <button type="submit" class="float-end btn btn-primary">submit</button>
                        </form>
                        <!-- /Login -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendor/js/menu.js') }}"></script>

</body>

</html>
