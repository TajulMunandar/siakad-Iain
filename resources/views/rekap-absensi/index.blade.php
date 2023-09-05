@extends('layouts.app')
@section('title', 'RDaftar Hadir dan Berita Acara')
@section('page-heading', 'Rekap Daftar Hadir Mahasiswa')

@section('content')
  @php
    $desiredParent = 'absensi'; // Set the desired parent value for this admin panel
  @endphp

  {{-- {{ dd($absensis) }} --}}
  @forelse ($absensis as $absensi)
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Kelas {{ $absensi->kelas->name }}</h5>
          <p class="card-text mb-1">Komisaris :
            {{ $absensi->kelas->mahasiswa->where('isKomisaris')->first()->name }}</p>
          <p class="card-text mb-1">Dosen : {{ $absensi->dosen->name }}</p>
          <p class="card-text">Matakuliah : {{ $absensi->mataKuliah->name }}</p>
          <a href="{{ route('rekap-absensi.show', $absensi->id) }}" class="btn btn-primary w-100">
            Lihat
          </a>
        </div>
      </div>
    </div>
  @empty
    <div class="text-center mt-5">Belum ada Daftar Hadir yang dibuat.</div>
  @endforelse
  </div>
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
