@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Edit Data Mata Kuliah Dosen')

@section('content')
    @php
        $desiredParent = 'data-master'; // Set the desired parent value for this admin panel
    @endphp

    <a class="btn btn-outline-secondary mb-2" href="{{ route('matakuliah-dosen.index') }}">
        Kembali
    </a>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3 mb-3">
                    <form action="{{ route('matakuliah-dosen.update', $matakuliah_dosen->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="id_matakuliah" class="form-label">Mata Kuliah</label>
                            <select class="form-select" id="id_matakuliah" name="id_matakuliah"
                                value="{{ old('id_matakuliah', $matakuliah_dosen->id_matakuliah) }}">
                                <option selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($matkuls as $matkul)
                                    @if (old('id_matakuliah', $matakuliah_dosen->id_matakuliah) == $matkul->id)
                                        <option value="{{ $matkul->id }}" selected>
                                            {{ $matkul->name }}</option>
                                    @else
                                        <option value="{{ $matkul->id }}">
                                            {{ $matkul->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_dosen" class="form-label">Dosen Pengampu</label>
                            <select class="form-select" id="id_dosen" name="id_dosen"
                                value="{{ old('id_dosen', $matakuliah_dosen->id_dosen) }}">
                                <option selected disabled>Pilih Dosen Pengampu</option>
                                @foreach ($dosens as $dosen)
                                    @if (old('id_dosen', $matakuliah_dosen->id_dosen) == $dosen->id)
                                        <option value="{{ $dosen->id }}" selected>
                                            {{ $dosen->name }}</option>
                                    @else
                                        <option value="{{ $dosen->id }}">
                                            {{ $dosen->name }}</option>
                                    @endif
                                @endforeach
                            </select>
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
