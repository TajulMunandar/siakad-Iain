@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Edit Data Mahasiswa')

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
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                         @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="oldImage" value="{{ $mahasiswa->foto }}">
                            <div class="mb-3">
                                <label for="npm" class="form-label">NPM</label>
                                <input type="number" class="form-control @error('npm') is-invalid @enderror" id="npm"
                                    name="npm" value="{{ old('npm', $mahasiswa->npm) }}">
                                @error('npm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $mahasiswa->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $mahasiswa->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="hp" class="form-label">No Hp</label>
                                <input type="name" class="form-control @error('hp') is-invalid @enderror" id="hp"
                                    name="nohp" value="{{ old('hp', $mahasiswa->nohp) }}">
                                @error('hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="isKomisaris" class="form-label">Penanggung Jawab</label>
                                <select class="form-select @error('isKomisaris') is-invalid @enderror" name="isKomisaris"
                                    id="isKomisaris">
                                    <option value="1" {{ $mahasiswa->isKomisaris == 1 ? 'selected' : '' }}>Komisaris</option>
                                    <option value="0" {{ $mahasiswa->isKomisaris == 0 ? 'selected' : '' }}>Anggota</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas"
                                    id="id_kelas">
                                      @foreach ($kelas as $kela)
                                        @if (old('id_kelas', $mahasiswa->id_kelas) == $kela->id)
                                            <option value="{{ $kela->id }}" selected>
                                                {{ $kela->name }}
                                            </option>
                                        @else
                                            <option value="{{ $kela->id }}">
                                                {{ $kela->name }}
                                            </option>
                                        @endif
                                      @endforeach
                                </select>
                                @error('id_kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
