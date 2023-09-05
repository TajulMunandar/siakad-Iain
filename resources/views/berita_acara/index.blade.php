@extends('layouts.app')
@section('title', 'Absensi dan Berita Acara')
@section('page-heading', 'Berita Acara Mahasiswa')

@section('content')
    @php
        $desiredParent = 'absensi'; // Set the desired parent value for this admin panel
    @endphp

    <div class="row">
      <div class="col-12 mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
          <i class="fa-regular fa-plus me-2"></i>
          Tambah Berita Acara
        </button>
      </div>
        @forelse ($beritas as $berita)
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelas {{ $berita->kelas->name }}</h5>
                        <p class="card-text mb-1">Komisaris :
                            {{ $berita->kelas->mahasiswa->where('isKomisaris')->first()->name }}
                        </p>
                        <p class="card-text">Matakuliah : {{ $berita->mataKuliah->name }}</p>
                        <a href="{{ route('berita-acara.show', $berita->id) }}"
                            class="btn btn-primary d-block stretched-link">Masuk</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center mt-5">Belum ada Daftar Berita Acara yang dibuat.</div>
        @endforelse
    </div>

    <x-form_modal id="createModal" title="Tambah Daftar Berita Acara" :route="route('berita-acara.store')">
      <div class="mb-3">
        <label for="id_kelas" class="form-label">Kelas</label>
        <select class="form-select" id="id_kelas" name="id_kelas">
          @foreach ($classes as $class)
            <option value="{{ old('id_kelas', $class->id) }}">{{ $class->name }}</option>
          @endforeach
        </select>
        @error('id_kelas')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="id_matakuliah" class="form-label">Matakuliah</label>
        <select class="form-select" id="id_matakuliah" name="id_matakuliah">
          @foreach ($matakuliahs as $matakuliah)
            <option value="{{ old('id_matakuliah', $matakuliah->mataKuliah->id) }}">
              {{ $matakuliah->mataKuliah->name }}</option>
          @endforeach
        </select>
        @error('id_matakuliah')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
        <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik">
        <div id="tahun_akademikHelp" class="form-text">Contoh: 2021/2022</div>
        @error('tahun_akademik')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="semester" class="form-label">Semester</label>
        <select class="form-select" id="semester" name="semester">
          <option value="GANJIL">Ganjil</option>
          <option value="GENAP">Genap</option>
        </select>
        @error('semester')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
    </x-form_modal>
@endsection
