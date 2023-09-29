@extends('layouts.app')
@section('title', 'Daftar Hadir dan Berita Acara')
@section('page-heading', 'Tambah Mahasiswa')

@section('content')
    @php
        $desiredParent = 'absensi'; // Set the desired parent value for this admin panel
    @endphp

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

    <a class="btn btn-outline-secondary mb-2" href="{{ route('absensi.index') }}">
        Kembali
    </a>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3 mb-3">
                    <form action="{{ route('absensi.mahasiswa', ['absensi' => $absensi->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p class="fw-bold fs-5">{{ $absensi->kelas->name }} - {{ $absensi->dosen->name }} -
                                    {{ $absensi->mataKuliah->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="id_mahasiswa" class="form-label">Mahasiswa</label>
                                <select class="form-select select2" id="id_mahasiswa" name="id_mahasiswa">
                                    @foreach ($mahasiswas as $mahasiswa)
                                        <option value="{{ old('id_mahasiswa', $mahasiswa->id) }}">{{ $mahasiswa->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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

@section('addon-script')
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme: 'bootstrap-5',

            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endsection
