@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Tambah Data Mata Kuliah')

@section('content')
    @php
        $desiredParent = 'data-master'; // Set the desired parent value for this admin panel
    @endphp

    <a class="btn btn-outline-secondary mb-2" href="{{ route('matakuliah.index') }}">
        Kembali
    </a>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3 mb-3">
                    <form action="{{ route('matakuliah.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">Nama</label>
                          <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                          @error('name')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label for="Fakultas" class="form-label">Kode Mata Kuliah</label>
                          <input type="name" class="form-control @error('kode_matakuliah') is-invalid @enderror" id="kode_matakuliah"
                              name="kode_matakuliah">
                          @error('kode_matakuliah')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label for="sks" class="form-label">SKS</label>
                          <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks">
                          @error('sks')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label for="prodi" class="form-label">Prodi</label>
                          <select class="form-select select2 @error('prodi') is-invalid @enderror" name="id_prodi" id="prodi">
                              @foreach ($prodis as $prodi)
                                  <option value="{{ $prodi->id }}" selected>
                                      {{ $prodi->name }}
                                  </option>
                              @endforeach
                          </select>
                          @error('prodi')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                          @enderror
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
