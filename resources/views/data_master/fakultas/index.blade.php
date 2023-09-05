@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data Fakultas')

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
  {{--  /ALERT  --}}
  <div class="row">
    <div class="col">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </button>
      <div class="card mt-3 col-sm-6 col-md-12">
        <div class="card-body">
          {{-- tables --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Fakultas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fakultas as $fakultas)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $fakultas->name }}</td>
                  <td>
                    <button id="edit-button" class="btn btn-warning" id="edit-button" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button id="delete-button" class="btn btn-danger" id="delete-button" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>

                {{--  MODAL Edit  --}}
                <x-form_modal :id="'editModal' . $loop->iteration" title="Edit Data Fakultas" :route="route('fakultas.update', $fakultas->id)" method='put' btnTitle="Simpan Perubahan">
                  <div class="mb-3">
                    <label for="Fakultas" class="form-label">Nama Fakultas</label>
                    <input type="name" class="form-control" id="Fakultas" name="name" value="{{ old('name', $fakultas->name) }}">
                  </div>
                </x-form_modal>
                {{--  MODAL Edit  --}}

                {{--  MODAL DELETE  --}}
                <x-form_modal :id="'hapusModal' . $loop->iteration" title="Hapus Data Fakultas" :route="route('fakultas.destroy', $fakultas->id)" method='delete' btnTitle="Hapus" primaryBtnStyle="btn-outline-danger" secBtnStyle="btn-secondary">
                  <p class="fs-6">Apakah anda yakin akan menghapus data <b>{{ $fakultas->name }}</b> ?</p>
                </x-form_modal>
                {{--  MODAL DELETE  --}}
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  {{--  MODAL Add  --}}
  <x-form_modal id="tambahModal" title="Tambah Data Fakultas" :route="route('fakultas.store')">
    <div class="mb-3">
      <label for="Fakultas" class="form-label">Nama Fakultas</label>
      <input type="name" class="form-control" id="Fakultas" name="name">
    </div>
  </x-form_modal>
  {{--  MODAL Add  --}}
@section('addon-script')
  <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
