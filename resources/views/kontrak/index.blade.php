@extends('layouts.app')
@section('title', 'Data Kontrak')
@section('page-heading', 'Data Kontrak')

@section('content')
    @php
        $desiredParent = 'kontrak'; // Set the desired parent value for this admin panel
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

    <div class="row">
        <div class="col">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fa-regular fa-plus me-2 "></i>
                Tambah
            </button>
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>Prodi</th>
                                <th>Fakultas</th>
                                <th>Semester</th>
                                <th>Tahun Akademik</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontraks as $kontrak)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kontrak->kelas->name }}</td>
                                    <td>{{ $kontrak->mataKuliah->name }}</td>
                                    <td>{{ $kontrak->prodi->name }}</td>
                                    <td>{{ $kontrak->fakultas->name }}</td>
                                    <td>{{ $kontrak->semester }}</td>
                                    <td>{{ $kontrak->tahun_akademik }}</td>
                                    <td>
                                        <button id="edit-button" class="btn btn-primary" id="edit-button"
                                            onclick="window.open('{{ route('kontrak.pdf', ['id' => $kontrak->id]) }}', '_blank')">
                                            <i class="fa-solid fa-download"></i>
                                        </button>
                                        <button id="edit-button" class="btn btn-warning" id="edit-button"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Mata Kuliah</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kontrak.destroy', $kontrak->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data
                                                        <b>{{ $kontrak->kelas->name }} ?</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL DELETE  --}}

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kontrak</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kontrak.update', $kontrak->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="kelas" class="form-label">Kelas</label>
                                                                <select
                                                                    class="form-select @error('kelas') is-invalid @enderror"
                                                                    name="id_kelas" id="kelas"
                                                                    value="{{ old('id_kelas', $kontrak->id_kelas) }}">
                                                                    @foreach ($kelases as $kelas)
                                                                        @if (old('id_kelas', $kontrak->id_kelas) == $kelas->id)
                                                                            <option value="{{ $kelas->id }}" selected>
                                                                                {{ $kelas->name }}</option>
                                                                        @else
                                                                            <option value="{{ $kelas->id }}">
                                                                                {{ $kelas->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('kelas')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="dosen" class="form-label">Dosen</label>
                                                                <select
                                                                    class="form-select @error('dosen') is-invalid @enderror"
                                                                    name="id_dosen" id="dosen"
                                                                    value="{{ old('id_dosen', $kontrak->id_dosen) }}">
                                                                    @foreach ($dosens as $dosen)
                                                                        @if (old('id_dosen', $kontrak->id_dosen) == $dosen->id)
                                                                            <option value="{{ $dosen->id }}" selected>
                                                                                {{ $dosen->name }}</option>
                                                                        @else
                                                                            <option value="{{ $dosen->id }}">
                                                                                {{ $dosen->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('dosen')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="matakuliah" class="form-label">Mata
                                                                    Kuliah</label>
                                                                <select
                                                                    class="form-select @error('matakuliah') is-invalid @enderror"
                                                                    name="id_matakuliah" id="matakuliah"
                                                                    value="{{ old('id_matakuliah', $kontrak->id_matakuliah) }}">
                                                                    @foreach ($matakuliahs as $matakuliah)
                                                                        @if (old('id_matakuliah', $kontrak->id_matakuliah) == $matakuliah->id)
                                                                            <option value="{{ $matakuliah->id }}"
                                                                                selected>
                                                                                {{ $matakuliah->name }}</option>
                                                                        @else
                                                                            <option value="{{ $matakuliah->id }}">
                                                                                {{ $matakuliah->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('matakuliah')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="prodi" class="form-label">Prodi</label>
                                                                <select
                                                                    class="form-select @error('prodi') is-invalid @enderror"
                                                                    name="id_prodi" id="prodi"
                                                                    value="{{ old('id_prodi', $kontrak->id_prodi) }}">
                                                                    @foreach ($prodis as $prodi)
                                                                        @if (old('id_prodi', $kontrak->id_prodi) == $prodi->id)
                                                                            <option value="{{ $prodi->id }}" selected>
                                                                                {{ $prodi->name }}</option>
                                                                        @else
                                                                            <option value="{{ $prodi->id }}">
                                                                                {{ $prodi->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('prodi')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="fakultas" class="form-label">Fakultas</label>
                                                                <select
                                                                    class="form-select @error('fakultas') is-invalid @enderror"
                                                                    name="id_fakultas" id="fakultas"
                                                                    value="{{ old('id_fakultas', $kontrak->id_fakultas) }}">
                                                                    @foreach ($fakultases as $fakultas)
                                                                        @if (old('id_fakultas', $kontrak->id_fakultas) == $fakultas->id)
                                                                            <option value="{{ $fakultas->id }}" selected>
                                                                                {{ $fakultas->name }}</option>
                                                                        @else
                                                                            <option value="{{ $fakultas->id }}">
                                                                                {{ $fakultas->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('fakultas')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="col">
                                                          <div class="mb-3">
                                                            <label for="semester" class="form-label">Semester</label>
                                                            <select class="form-select" id="semester" name="semester">
                                                                <option value="GANJIL" {{ $kontrak->semester == "GANJIL" ? 'selected' : '' }}>Ganjil</option>
                                                                <option value="GENAP" {{ $kontrak->semester == "GENAP" ? 'selected' : '' }}>Genap</option>
                                                            </select>
                                                            @error('semester')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                            <div class="mb-3">
                                                                <label for="tahun" class="form-label">Tahun
                                                                    Akademik</label>
                                                                <input type="name"
                                                                    class="form-control @error('tahun') is-invalid @enderror"
                                                                    id="tahun" name="tahun_akademik"
                                                                    value="{{ old('tahun', $kontrak->tahun_akademik) }}">
                                                                    <div id="tahun_akademikHelp" class="form-text">Contoh: 2021/2022</div>
                                                                @error('tahun')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="uas" class="form-label">UAS</label>
                                                                <input type="number"
                                                                    class="form-control @error('uas') is-invalid @enderror"
                                                                    id="uas" name="uas"
                                                                    value="{{ old('uas', $kontrak->uas) }}">
                                                                @error('uas')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="uts" class="form-label">UTS</label>
                                                                <input type="number"
                                                                    class="form-control @error('uts') is-invalid @enderror"
                                                                    id="uts" name="uts"
                                                                    value="{{ old('uts', $kontrak->uts) }}">
                                                                @error('uts')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="kuis" class="form-label">KUIS</label>
                                                                <input type="number"
                                                                    class="form-control @error('kuis') is-invalid @enderror"
                                                                    id="kuis" name="kuis"
                                                                    value="{{ old('kuis', $kontrak->kuis) }}">
                                                                @error('kuis')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tugas" class="form-label">TUGAS</label>
                                                                <input type="number"
                                                                    class="form-control @error('tugas') is-invalid @enderror"
                                                                    id="tugas" name="tugas"
                                                                    value="{{ old('tugas', $kontrak->tugas) }}">
                                                                @error('tugas')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kuis" class="form-label">Keterangan</label>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" id="ket" name="ket">{{ old('ket', $kontrak->ket) }}</textarea>
                                                            <label for="ket">Keterangan</label>
                                                            <div id="ket" class="form-text">contoh mengisi
                                                                keterangan= 1.(keterangan), 2.(keterangan), 3.dst "Akhiri
                                                                dengan ',' (koma)"</div>
                                                        </div>
                                                        @error('ket')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- / Modal Edit --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  MODAL Add  --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data Kontrak Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kontrak.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="form-select @error('kelas') is-invalid @enderror" name="id_kelas"
                                        id="kelas">
                                        @foreach ($kelases as $kelas)
                                            <option value="{{ $kelas->id }}" selected>
                                                {{ $kelas->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="dosen" class="form-label">Dosen</label>
                                    <select class="form-select @error('dosen') is-invalid @enderror" name="id_dosen"
                                        id="dosen">
                                        @if (auth()->user()->isAdmin == 1)
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->id }}" selected>
                                                    {{ $dosen->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="{{ $dosens->id }}" selected>
                                                {{ $dosens->name }}
                                            </option>
                                        @endif
                                    </select>
                                    @error('dosen')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="matakuliah" class="form-label">Mata Kuliah</label>
                                    <select class="form-select @error('matakuliah') is-invalid @enderror"
                                        name="id_matakuliah" id="matakuliah">
                                        @foreach ($matakuliahs as $matakuliah)
                                            <option value="{{ $matakuliah->id }}" selected>
                                                {{ $matakuliah->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('matakuliah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="prodi" class="form-label">Prodi</label>
                                    <select class="form-select @error('prodi') is-invalid @enderror" name="id_prodi"
                                        id="prodi">
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
                                <div class="mb-3">
                                    <label for="fakultas" class="form-label">Fakultas</label>
                                    <select class="form-select @error('fakultas') is-invalid @enderror"
                                        name="id_fakultas" id="fakultas">
                                        @foreach ($fakultases as $fakultas)
                                            <option value="{{ $fakultas->id }}" selected>
                                                {{ $fakultas->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fakultas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col">
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
                                    <label for="uas" class="form-label">UAS</label>
                                    <input type="number" class="form-control @error('uas') is-invalid @enderror"
                                        id="uas" name="uas">
                                    @error('uas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="uts" class="form-label">UTS</label>
                                    <input type="number" class="form-control @error('uts') is-invalid @enderror"
                                        id="uts" name="uts">
                                    @error('uts')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kuis" class="form-label">KUIS</label>
                                    <input type="number" class="form-control @error('kuis') is-invalid @enderror"
                                        id="kuis" name="kuis">
                                    @error('kuis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tugas" class="form-label">TUGAS</label>
                                    <input type="number" class="form-control @error('tugas') is-invalid @enderror"
                                        id="tugas" name="tugas">
                                    @error('tugas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="kuis" class="form-label">Keterangan</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="ket" name="ket"></textarea>
                                <label for="ket">Keterangan</label>
                                <div id="ket" class="form-text">contoh mengisi keterangan= 1.(keterangan),
                                    2.(keterangan), 3.dst. "Akhiri dengan ',' (koma)"</div>
                            </div>
                            @error('ket')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  MODAL Add  --}}
@section('addon-script')
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
