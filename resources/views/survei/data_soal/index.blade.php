@extends('layouts.app')
@section('title', 'Data Soal')
@section('page-heading', 'Data Soal')

@section('content')
    @php
        $desiredParent = 'skm'; // Set the desired parent value for this admin panel
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
                                <th>Indikator</th>
                                <th>Soal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soals as $soal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $soal->indikatorSurvei->indikator }}</td>
                                    <td>{{ $soal->soal }}</td>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Soal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('soal.destroy', $soal->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data
                                                        <b>{{ $soal->soal }} ?</b>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Indikator</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('soal.update', $soal->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                  <div class="mb-3">
                                                    <label for="indikator" class="form-label">Indikator</label>
                                                    <select
                                                        class="form-select @error('indikator') is-invalid @enderror"
                                                        name="id_indikator" id="indikator"
                                                        value="{{ old('id_indikator', $soal->id_indikator) }}">
                                                        @foreach ($indikators as $indikator)
                                                            @if (old('id_indikator', $soal->id_indikator) == $indikator->id)
                                                                <option value="{{ $indikator->id }}"
                                                                    selected>
                                                                    {{ $indikator->indikator }}</option>
                                                            @else
                                                                <option value="{{ $indikator->id }}">
                                                                    {{ $indikator->indikator }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('indikator')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Soal</label>
                                                        <input type="name" class="form-control" id="name"
                                                            aria-describedby="emailHelp" name="soal"
                                                            value="{{ old('name', $soal->soal) }}">
                                                        @error('name')
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Soal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('soal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="indikator" class="form-label">Indikator</label>
                            <select class="form-select @error('indikator') is-invalid @enderror" name="id_indikator"
                                id="indikator">
                                @foreach ($indikators as $indikator)
                                    <option value="{{ $indikator->id }}" selected>
                                        {{ $indikator->indikator }}
                                    </option>
                                @endforeach
                            </select>
                            @error('indikator')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Soal</label>
                            <input type="name" class="form-control" id="name" aria-describedby="emailHelp"
                                name="soal">
                            @error('name')
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
