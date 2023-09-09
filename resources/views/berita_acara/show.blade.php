@extends('layouts.app')
@section('title', 'Daftar Berita Detail')
@section('page-heading')
    Daftar Berita Detail
@endsection

@section('content')
    @php
        $desiredParent = 'absensi'; // Set the desired parent value for this admin panel
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
            <div class="d-flex align-items-center justify-content-between gap-2">
                <div>
                    <a type="submit" class="btn btn-outline-secondary mt-3 " href="{{ route('berita-acara.index') }}">
                        <i class="fa-regular fa-chevron-left me-2"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary mt-3" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="fa-regular fa-plus me-2"></i>
                        Tambah Berita
                    </button>
                </div>
                <div>
                    @if ($detail)
                        <a type="submit" class="btn btn-info mt-3 text-white"
                            href="{{ route('berita.pdf', ['id' => $berita_acara->id]) }}">
                            <i class="fa-regular fa-download me-2"></i>
                            Download Pdf
                        </a>
                    @endif
                </div>
            </div>

            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pertemuan</th>
                                <th>Materi</th>
                                <th>Jumlah Mahasiswa</th>
                                <th>Bukti Pelaksanaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->tanggal }}</td>
                                    <td>{{ $detail->pertemuan }}</td>
                                    <td>{{ $detail->materi }}</td>
                                    <td>{{ $detail->jumlah_mahasiswa }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#foto{{ $loop->iteration }}">
                                            Foto
                                        </button>
                                    </td>
                                    <td>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Materi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('berita-acara-detail.destroy', $detail->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data
                                                        <b>{{ $detail->materi }} ?</b>
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

                                <!-- Modal Foto -->
                                <div class="modal fade" id="foto{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Foto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        @if ($detail->bukti_pelaksanaan)
                                                            <img class="rounded-3" style="object-fit: cover"
                                                                src="{{ asset('storage/' . $detail->bukti_pelaksanaan) }}"
                                                                alt="" height="250" width="350">
                                                        @else
                                                            <p>Belum ada Bukti Pelaksanaan</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Foto --}}

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('berita-acara-detail.update', $detail->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="oldImage"
                                                        value="{{ $detail->bukti_pelaksanaan }}">
                                                    <input type="hidden" name="id_berita_acara"
                                                        value="{{ $berita_acara->id }}">
                                                    <div class="mb-3">
                                                        <label for="tanggal" class="form-label">Tanggal</label>
                                                        <input type="date"
                                                            class="form-control @error('tanggal') is-invalid @enderror"
                                                            id="tanggal" name="tanggal"
                                                            value="{{ old('tanggal', $detail->tanggal) }}">
                                                        @error('tanggal')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pertemuan" class="form-label">Pertemuan</label>
                                                        <input type="number"
                                                            class="form-control @error('pertemuan') is-invalid @enderror"
                                                            name="pertemuan" id="pertemuan" value="{{ old('pertemuan', $detail->pertemuan) }}" readonly>
                                                        @error('pertemuan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="materi" class="form-label">Materi</label>
                                                        <input type="text"
                                                            class="form-control @error('materi') is-invalid @enderror"
                                                            id="materi" name="materi"
                                                            value="{{ old('materi', $detail->materi) }}">
                                                        @error('materi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jumlah_mahasiswa" class="form-label">Jumlah
                                                            Mahasiswa</label>
                                                        <input type="number"
                                                            class="form-control @error('jumlah_mahasiswa') is-invalid @enderror"
                                                            id="jumlah_mahasiswa" name="jumlah_mahasiswa"
                                                            value="{{ old('jumlah_mahasiswa', $detail->jumlah_mahasiswa) }}">
                                                        @error('jumlah_mahasiswa')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bukti_pelaksanaan" class="form-label">Bukti
                                                            Pelaksanaan</label>
                                                        <input type="file"
                                                            class="form-control @error('bukti_pelaksanaan') is-invalid @enderror"
                                                            id="bukti_pelaksanaan" name="bukti_pelaksanaan">
                                                        @error('bukti_pelaksanaan')
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

    <x-form_modal id="createModal" title="Tambah Daftar Berita Acara" :route="route('berita-acara-detail.store')" enctype="multipart/form-data">
        <input type="hidden" name="id_berita_acara" value="{{ $berita_acara->id }}">
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                name="tanggal">
            @error('tanggal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pertemuan" class="form-label">Pertemuan</label>
            <input type="number" class="form-control @error('pertemuan') is-invalid @enderror" id="pertemuan"
                name="pertemuan" value="{{ $jumlah }}" readonly>
            @error('pertemuan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="materi" class="form-label">Materi</label>
            <input type="text" class="form-control @error('materi') is-invalid @enderror" id="materi"
                name="materi">
            @error('materi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah_mahasiswa" class="form-label">Jumlah Mahasiswa Hadir</label>
            <input type="number" class="form-control @error('jumlah_mahasiswa') is-invalid @enderror"
                id="jumlah_mahasiswa" name="jumlah_mahasiswa">
            @error('jumlah_mahasiswa')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="bukti_pelaksanaan" class="form-label">Bukti Pelaksanaan</label>
            <input type="file" class="form-control @error('bukti_pelaksanaan') is-invalid @enderror"
                id="bukti_pelaksanaan" name="bukti_pelaksanaan">
            @error('bukti_pelaksanaan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

    </x-form_modal>
@endsection

@section('addon-script')
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
