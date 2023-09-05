@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data Mata Kuliah')

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

  <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="matakuliah-tab" data-bs-toggle="tab" data-bs-target="#matakuliah-tab-pane">Mata Kuliah</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="matakuliah-dosen-tab" data-bs-toggle="tab" data-bs-target="#matakuliah-dosen-tab-pane">Enroll Matakuliah-Dosen</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="matakuliah-tab-pane" role="tabpanel" aria-labelledby="matakuliah-tab" tabindex="0">
      @include('data_master.matakuliah.tabs.matakuliah')
    </div>
    <div class="tab-pane fade" id="matakuliah-dosen-tab-pane" role="tabpanel" aria-labelledby="matakuliah-dosen-tab" tabindex="0">
      @include('data_master.matakuliah.tabs.matakuliah-dosen')
    </div>
  </div>

@section('addon-script')
  <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
