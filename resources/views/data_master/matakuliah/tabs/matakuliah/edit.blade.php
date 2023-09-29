@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Edit Data Mata Kuliah')

@section('content')
    @php
        $desiredParent = 'data-master'; // Set the desired parent value for this admin panel
    @endphp

    <a class="btn btn-outline-secondary mb-2" href="{{ route('matakuliah.index')}}">
        Kembali
    </a>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3 mb-3">
                    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="Fakultas" class="form-label">Nama</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $matakuliah->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Fakultas" class="form-label">Kode Mata Kuliah</label>
                            <input type="name" class="form-control @error('kode_matakuliah') is-invalid @enderror"
                                id="kode_matakuliah" name="kode_matakuliah"
                                value="{{ old('kode_matakuliah', $matakuliah->kode_matakuliah) }}">
                            @error('kode_matakuliah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sks" class="form-label">SKS</label>
                            <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks"
                                name="sks" value="{{ old('sks', $matakuliah->sks) }}">
                            @error('sks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">prodi</label>
                            <select class="form-select @error('prodi') is-invalid @enderror" name="id_prodi" id="prodi"
                                value="{{ old('id_prodi', $matakuliah->id_prodi) }}">
                                @foreach ($prodis as $prodi)
                                    @if (old('id_prodi', $matakuliah->id_prodi) == $prodi->id)
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
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
