@extends('layouts.app')
@section('title', 'Data Rps')
@section('page-heading', 'Data Rencana Perkuliahan Semester')

@section('content')
    @php
        $desiredParent = 'rps'; // Set the desired parent value for this admin panel
    @endphp
    {{--  ALERT  --}}
    <div class="row mt-3">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{--  ALERT  --}}

    <div class="row">
        <div class="col">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fa-regular fa-plus me-2 "></i>
                Tambah
            </button>
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Dosen</th>
                                <th>Mata Kuliah</th>
                                <th>Prodi</th>
                                <th>Fakultas</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rpses as $rps)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rps->kelas->name }}</td>
                                    <td>{{ $rps->dosen->name }}</td>
                                    <td>{{ $rps->mataKuliah->name }}</td>
                                    <td>{{ $rps->prodi->name }}</td>
                                    <td>{{ $rps->fakultas->name }}</td>
                                    <td>{{ $rps->semester }}</td>
                                    <td>{{ $rps->tahun_ajaran }}</td>
                                    <td>
                                        <button id="delete-button" class="btn btn-success"
                                            onclick="window.open('{{ route('rps.pdf', ['id' => $rps->id]) }}', '_blank')">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                        <button id="edit-button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="deleteModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Soal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('rps.destroy', $rps->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data
                                                        <b>{{ $rps->kelas->name }} ?</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL DELETE  --}}

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Rps</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('rps.update', $rps->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="kelas" class="form-label">Kelas</label>
                                                        <select class="form-select @error('kelas') is-invalid @enderror"
                                                            name="id_kelas" id="kelas">
                                                            @foreach ($kelases as $kelas)
                                                                @if (old('id_kelas', $rps->id_kelas) == $kelas->id)
                                                                    <option value="{{ $kelas->id }}" selected>
                                                                        {{ $kelas->name }}</option>
                                                                @else
                                                                    <option value="{{ $kelas->id }}">
                                                                        {{ $kelas->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('kelas')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="dosen" class="form-label">Dosen</label>
                                                        <select class="form-select @error('dosen') is-invalid @enderror"
                                                            name="id_dosen" id="dosen">
                                                            @foreach ($dosens as $dosen)
                                                                @if (old('id_dosen', $rps->id_dosen) == $dosen->id)
                                                                    <option value="{{ $dosen->id }}" selected>
                                                                        {{ $dosen->name }}</option>
                                                                @else
                                                                    <option value="{{ $dosen->id }}">
                                                                        {{ $dosen->name }}</option>
                                                                @endif
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
                                                        <select
                                                            class="form-select @error('matakuliah') is-invalid @enderror"
                                                            name="id_matakuliah" id="matakuliah">
                                                            @foreach ($matakuliahs as $matakuliah)
                                                                @if (old('id_matakuliah', $rps->id_matakuliah) == $matakuliah->id)
                                                                    <option value="{{ $matakuliah->id }}" selected>
                                                                        {{ $matakuliah->name }}</option>
                                                                @else
                                                                    <option value="{{ $matakuliah->id }}">
                                                                        {{ $matakuliah->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('matakuliah')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="prodi" class="form-label">Prodi</label>
                                                        <select class="form-select @error('prodi') is-invalid @enderror"
                                                            name="id_prodi" id="prodi">
                                                            @foreach ($prodis as $prodi)
                                                                @if (old('id_prodi', $rps->id_prodi) == $prodi->id)
                                                                    <option value="{{ $prodi->id }}" selected>
                                                                        {{ $prodi->name }}</option>
                                                                @else
                                                                    <option value="{{ $prodi->id }}">
                                                                        {{ $prodi->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('prodi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="fakultas" class="form-label">Fakultas</label>
                                                        <select class="form-select @error('fakultas') is-invalid @enderror"
                                                            name="id_fakultas" id="fakultas">
                                                            @foreach ($fakultases as $fakultas)
                                                                @if (old('id_fakultas', $rps->id_fakultas) == $fakultas->id)
                                                                    <option value="{{ $fakultas->id }}" selected>
                                                                        {{ $fakultas->name }}</option>
                                                                @else
                                                                    <option value="{{ $fakultas->id }}">
                                                                        {{ $fakultas->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('fakultas')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="semester" class="form-label">Semester</label>
                                                        <select class="form-select @error('semester') is-invalid @enderror"
                                                            name="semester" id="semester">
                                                            <option value="1"
                                                                {{ $rps->semester == 1 ? 'selected' : '' }}>
                                                                Ganjil
                                                            </option>
                                                            <option value="2"
                                                                {{ $rps->semester == 2 ? 'selected' : '' }}>
                                                                Genap
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tahun" class="form-label">Tahun Ajaran</label>
                                                        <input type="name"
                                                            class="form-control @error('tahun') is-invalid @enderror"
                                                            id="tahun" name="tahun_ajaran"
                                                            value="{{ old('tahun', $rps->tahun_ajaran) }}">
                                                        @error('tahun')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Edit</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- / Modal Edit --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  MODAL Add  --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data RPS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rps.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select @error('kelas') is-invalid @enderror" name="id_kelas" id="kelas">
                                @foreach ($kelases as $kelas)
                                    <option value="{{ $kelas->id }}" selected>
                                        {{ $kelas->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dosen" class="form-label">Dosen</label>
                            <select class="form-select @error('dosen') is-invalid @enderror" name="id_dosen" id="dosen">
                                @if (auth()->user()->isAdmin == 1)
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id }}" selected>
                                            {{ $dosen->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="{{ $dosens->id }}" selected>
                                        {{ $dosens->name }}
                                    </option>
                                @endif

                            </select>
                            @error('dosen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="matakuliah" class="form-label">Mata Kuliah</label>
                            <select class="form-select @error('matakuliah') is-invalid @enderror" name="id_matakuliah"
                                id="matakuliah">
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
                            <label for="prodi" class="form-label">Prodi</label>
                            <select class="form-select @error('prodi') is-invalid @enderror" name="id_prodi"
                                id="prodi">
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" selected>
                                        {{ $prodi->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fakultas" class="form-label">Fakultas</label>
                            <select class="form-select @error('fakultas') is-invalid @enderror" name="id_fakultas"
                                id="fakultas">
                                @foreach ($fakultases as $fakultas)
                                    <option value="{{ $fakultas->id }}" selected>
                                        {{ $fakultas->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fakultas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select @error('semester') is-invalid @enderror" name="semester"
                                id="semester">
                                <option value="GANJIL" selected>
                                    Ganjil
                                </option>
                                <option value="GENAP">
                                    Genap
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Ajaran</label>
                            <input type="name" class="form-control @error('tahun') is-invalid @enderror"
                                id="tahun" name="tahun_ajaran">
                            <div id="emailHelp" class="form-text">Contoh Inputan "2022/2023"</div>
                            @error('tahun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--  MODAL Add  --}}
@section('addon-script')
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
