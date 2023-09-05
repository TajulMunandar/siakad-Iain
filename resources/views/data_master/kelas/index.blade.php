@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data Kelas')

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
                                <th>Nama Kelas</th>
                                <th>Komisaris</th>
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $kela)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kela->name }}</td>
                                    @if (isset($kela->mahasiswa->where('isKomisaris', 1)->first()->name))
                                        <td>{{ $kela->mahasiswa->where('isKomisaris', 1)->first()->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $kela->prodi->name }}</td>
                                    <td>
                                        <button id="edit-button" class="btn btn-warning" id="edit-button"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Kelas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kelas.destroy', $kela->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf

                                                <div class="modal-body">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data kelas
                                                        <b>{{ $kela->name }} ?</b>
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

                                {{--  MODAL edit  --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kelas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kelas.update', $kela->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama</label>
                                                        <input type="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name"
                                                            value="{{ old('name', $kela->name) }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="id_prodi" class="form-label">Program Studi</label>
                                                        <select class="form-select @error('id_prodi') is-invalid @enderror"
                                                            name="id_prodi" id="id_prodi"
                                                            value="{{ old('id_prodi', $kela->id_prodi) }}">
                                                            @foreach ($prodis as $prodi)
                                                                @if (old('prodiId', $kela->id_prodi) == $prodi->id)
                                                                    <option value="{{ $prodi->id }}" selected>
                                                                        {{ $prodi->name }}</option>
                                                                @else
                                                                    <option value="{{ $prodi->id }}">
                                                                        {{ $prodi->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('id_prodi')
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
                                {{--  MODAL edit  --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
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
                            <label for="id_prodi" class="form-label">Program Studi</label>
                            <select class="form-select @error('id_prodi') is-invalid @enderror" name="id_prodi"
                                id="id_prodi">
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" selected>
                                        {{ $prodi->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_prodi')
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
