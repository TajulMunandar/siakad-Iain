@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Enroll Data Mata Kuliah Dosen')

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
                    <form action="{{ route('matakuliah-dosen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="id_matakuliah" class="form-label">Mata Kuliah</label>
                            <select class="form-select select2" id="id_matakuliah" name="id_matakuliah">
                                <option selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($matkuls as $matkul)
                                    <option value="{{ $matkul->id }}">{{ $matkul->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_dosen" class="form-label">Dosen Pengampu</label>
                            <select class="form-select select2" id="id_dosen" name="id_dosen">
                                <option selected disabled>Pilih Dosen Pengampu</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
