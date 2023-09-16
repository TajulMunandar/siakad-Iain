@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data Program Studi')

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
                                <th>Nama</th>
                                <th>Ketua Prodi</th>
                                <th>Fakultas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodis as $prodi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prodi->name }}</td>
                                    <td>{{ $prodi->dosen->name }}</td>
                                    <td>{{ $prodi->fakultas->name }}</td>
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

                                {{--  MODAL Edit  --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Prodi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('prodi.update', $prodi->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama</label>
                                                        <input type="name" class="form-control" id="name"
                                                            name="name" value="{{ old('name', $prodi->name) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kaprodi" class="form-label">Ketua Prodi</label>
                                                        <select
                                                            class="form-select  @error('kaprodi') is-invalid @enderror"
                                                            name="kaprodi" id="select2-edit">
                                                            @foreach ($dosens as $dosen)
                                                                @if (old('kaprodi', $prodi->kaprodi) == $dosen->id)
                                                                    <option value="{{ $dosen->id }}" selected>
                                                                        {{ $dosen->name }}</option>
                                                                @else
                                                                    <option value="{{ $dosen->id }}">
                                                                        {{ $dosen->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="id_fakultas" class="form-label">Fakultas</label>
                                                        <select
                                                            class="form-select @error('id_fakultas') is-invalid @enderror"
                                                            name="id_fakultas" id="select2-edita">
                                                            @foreach ($fakultas as $fakulta)
                                                                @if (old('id_fakultas', $prodi->id_fakultas) == $fakulta->id)
                                                                    <option value="{{ $fakulta->id }}" selected>
                                                                        {{ $fakulta->name }}</option>
                                                                @else
                                                                    <option value="{{ $fakulta->id }}">
                                                                        {{ $fakulta->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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
                                {{--  MODAL Edit  --}}

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Prodi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('prodi.destroy', $prodi->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data
                                                        <b>{{ $prodi->name }} ?</b>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Data Program studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('prodi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="name" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="kaprodi" class="form-label">Ketua Prodi</label>
                            <select class="form-select select2 @error('kaprodi') is-invalid @enderror" name="kaprodi"
                                id="kaprodi">
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" selected>
                                        {{ $dosen->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_fakultas" class="form-label">Fakultas</label>
                            <select class="form-select select2 @error('id_fakultas') is-invalid @enderror"
                                name="id_fakultas" id="id_fakultas">
                                @foreach ($fakultas as $fakulta)
                                    <option value="{{ $fakulta->id }}" selected>
                                        {{ $fakulta->name }}
                                    </option>
                                @endforeach
                            </select>
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
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#tambahModal")
            });
        });

        $(document).ready(function() {
            $("#select2-edit").select2({
                theme: 'bootstrap-5',
            });
        });

        $(document).ready(function() {
            $("#select2-edita").select2({
                theme: 'bootstrap-5',
            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
