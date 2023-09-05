@extends('layouts.app')
@section('title', 'Daftar Hadir dan Berita Acara')
@section('page-heading', 'Daftar Hadir Mahasiswa')

@section('content')
  @php
    $desiredParent = 'absensi'; // Set the desired parent value for this admin panel
  @endphp

  {{-- {{ dd($absensis) }} --}}

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

  <div class="row">
    <div class="col-12 mb-4">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah Daftar Hadir
      </button>
    </div>


    @forelse ($absensis as $absensi)
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kelas {{ $absensi->kelas->name }}</h5>
            <p class="card-text mb-1">Komisaris :
              {{ $absensi->kelas->mahasiswa->where('isKomisaris')->first()->name }}</p>
            <p class="card-text mb-1">Dosen : {{ $absensi->dosen->name }}</p>
            <p class="card-text">Matakuliah : {{ $absensi->mataKuliah->name }}</p>
            <div class="d-flex gap-2">
              <div class="w-100">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#pilihPertemuan{{ $loop->iteration }}">
                  Masuk
                </button>
                {{-- <a href="{{ route('absensi.show', $absensi->id) }}" class="btn btn-primary d-block">Masuk</a> --}}
              </div>
              {{-- Admin only --}}
              <div class="w-25">
                <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                  <i class="fa-regular fa-trash-can"></i>
                </button>
              </div>
              {{-- Admin only --}}
            </div>
          </div>
        </div>
      </div>

      {{-- Modal Pilih Pertemuan --}}
      <div class="modal fade" id="pilihPertemuan{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Pertemuan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row g-2">
                @for ($i=1; $i <= 16; $i++)
                <div class="col-md-3">
                  <a href="{{ route('absensi.show', [$absensi->id, $i]) }}" class="fs-5 btn btn-primary py-3 w-100">{{ $i }}</a>
                </div>
                @endfor
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
      {{-- / Modal Pilih Pertemuan --}}

      {{-- Modal Delete --}}
      <x-form_modal :id="'hapusModal' . $loop->iteration" title="Hapus Daftar Hadir" :route="route('absensi.destroy', $absensi->id)" method='delete' btnTitle="Hapus" primaryBtnStyle="btn-outline-danger" secBtnStyle="btn-secondary">
        <p class="fs-6">Apakah anda yakin akan menghapus daftar hadir kelas <b>{{ $absensi->kelas->name }}</b> ?</p>
        <div class="alert alert-warning fade show" role="alert">
          <i class="fa-duotone fa-triangle-exclamation me-2"></i>
          Semua Data Absensi Mahasiswa akan terhapus!
        </div>
      </x-form_modal>
      {{-- /Modal Delete --}}
    @empty
      <div class="text-center mt-5">Belum ada Daftar Hadir yang dibuat.</div>
    @endforelse
  </div>

  <x-form_modal id="createModal" title="Tambah Daftar Hadir" :route="route('absensi.store')">
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
      <select class="select2 form-select" id="id_matakuliah" name="id_matakuliah">
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
      <label for="hari" class="form-label">Hari / Jam</label>
      <input type="datetime-local" class="form-control" id="hari" name="hari">
      @error('hari')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="id_dosen" class="form-label">Dosen</label>
      <select class="select2 form-select" id="id_dosen" name="id_dosen">
        @foreach ($dosens as $dosen)
          <option value="{{ old('id_dosen', $dosen->id) }}">{{ $dosen->name }}</option>
        @endforeach
      </select>
      @error('id_dosen')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="asisten" class="form-label">Asisten</label>
      <input type="text" class="form-control" id="asisten" name="asisten">
      @error('asisten')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="nama_unit" class="form-label">Nama Unit</label>
      <input type="text" class="form-control" id="nama_unit" name="nama_unit">
      @error('nama_unit')
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
  </x-form_modal>
@endsection

@section('addon-script')
  <script>
    $(document).ready(function() {
      $(".select2").select2({
        theme: 'bootstrap-5',
        dropdownParent: $("#createModal")
      });
    });

    $(document).on('select2:open', () => {
      document.querySelector('.select2-search__field').focus();
    });
  </script>
@endsection
