@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data Mahasiswa')

@section('content')
    @php
        $desiredParent = 'data-master'; // Set the desired parent value for this admin panel
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
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Foto</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mhs)
                                <!-- Modal Foto -->
                                <div class="modal fade" id="foto{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Foto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <img class="rounded-3" style="object-fit: cover"
                                                            src="{{ asset('storage/' . $mhs->foto) }}" alt=""
                                                            height="250" width="350">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Foto --}}

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Mahasiswa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data mahasiswa
                                                        <b>{{ $mhs->name }} ?</b>
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
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="oldImage" value="{{ $mhs->foto }}">
                                                    <div class="mb-3">
                                                        <label for="npm" class="form-label">NPM</label>
                                                        <input type="number"
                                                            class="form-control @error('npm') is-invalid @enderror"
                                                            id="npm" name="npm"
                                                            value="{{ old('npm', $mhs->npm) }}">
                                                        @error('npm')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="Fakultas" class="form-label">Nama</label>
                                                        <input type="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name"
                                                            value="{{ old('name', $mhs->name) }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email"
                                                            value="{{ old('name', $mhs->email) }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="hp" class="form-label">No Hp</label>
                                                        <input type="name"
                                                            class="form-control @error('hp') is-invalid @enderror"
                                                            id="hp" name="nohp"
                                                            value="{{ old('nohp', $mhs->nohp) }}">
                                                        @error('hp')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="isKomisaris" class="form-label">Penanggung
                                                            Jawab</label>
                                                        <select
                                                            class="form-select @error('isKomisaris') is-invalid @enderror"
                                                            name="isKomisaris" id="isKomisaris">
                                                            <option value="1"
                                                                {{ $mhs->isKomisaris == 1 ? 'selected' : '' }}>Komisaris
                                                            </option>
                                                            <option value="0"
                                                                {{ $mhs->isKomisaris == 0 ? 'selected' : '' }}>Anggota
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="foto" class="form-label">Foto</label>
                                                        <input type="file"
                                                            class="form-control @error('foto') is-invalid @enderror"
                                                            id="foto" name="foto"
                                                            value="{{ old('foto', $mhs->foto) }}">
                                                        @error('foto')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="id_kelas" class="form-label">Kelas</label>
                                                        <select class="form-select @error('id_kelas') is-invalid @enderror"
                                                            name="id_kelas" id="id_kelas">
                                                            @foreach ($kelas as $kela)
                                                                @if (old('id_kelas', $mhs->id_kelas) == $kela->id)
                                                                    <option value="{{ $kela->id }}" selected>
                                                                        {{ $kela->name }}</option>
                                                                @else
                                                                    <option value="{{ $kela->id }}">
                                                                        {{ $kela->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('id_kelas')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input type="number" class="form-control @error('npm') is-invalid @enderror" id="npm"
                                name="npm">
                            @error('npm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hp" class="form-label">No Hp</label>
                            <input type="name" class="form-control @error('hp') is-invalid @enderror" id="hp"
                                name="nohp">
                            @error('hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isKomisaris" class="form-label">Penanggung Jawab</label>
                            <select class="form-select @error('isKomisaris') is-invalid @enderror" name="isKomisaris"
                                id="isKomisaris">
                                <option value="1" selected>Komisaris</option>
                                <option value="0">Anggota</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                id="foto" name="foto">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas"
                                id="id_kelas">
                                @foreach ($kelas as $kela)
                                    <option value="{{ $kela->id }}" selected>
                                        {{ $kela->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
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
     {{-- <script src="{{ asset('js/datatables.js') }}"></script> --}}
    <script type="text/javascript">
     $(function () {
       var table = $('#myTable').DataTable({
          processing:true,
          serverSide:true,
            ajax: '{{ route('mahasiswa.index') }}',
            columns: [
              {data: 'id', name: 'id'},
              {data: 'npm', name: 'npm'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'nohp', name: 'nohp'},
              {data: 'foto', name: 'foto', orderable: false, searchable: false}, // Kolom 'foto'
              {
                data: 'kelas.name', // Menggunakan 'kelas.name' untuk mengakses kolom 'name' pada tabel 'kelas'
                name: 'kelas.name',
                orderable: false,
                searchable: false
              },
              {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
      });
    </script>
@endsection
@endsection
