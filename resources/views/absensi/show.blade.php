@extends('layouts.app')
@section('title', 'Daftar Hadir')
@section('page-heading')
    Daftar Hadir Mahasiswa Kelas {{ $absensi->kelas->name }}
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

    {{-- {{ dd($absensi->absensiDetail->where('pertemuan', $pertemuan)) }} --}}
    <div class="row">
        <form action="{{ route('absensi.update', $absensi->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="pertemuan" value="{{ $pertemuan }}">
            <div class="col">
                <div class="d-flex gap-2 justify-content-start align-items-center">
                    <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary text-dark">
                        <i class="fa-regular fa-chevron-left me-2"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-regular fa-floppy-disk me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <p class="fs-6 fw-bold">Pertemuan Ke-{{ $pertemuan }}</p>
                </div>

                <div class="card col-sm-6 col-md-12">
                    <div class="card-body">
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Status Kehadiran</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $absensiDetail = $absensiDetail->where('pertemuan', $pertemuan)->get(); // Menggunakan get() untuk mendapatkan koleksi data
                                @endphp
                                @foreach ($absensiDetail as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->mahasiswa->npm }}</td>
                                        <td>{{ $detail->mahasiswa->name }}</td>
                                        <td>
                                            @foreach ($statusAbsensis as $status)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="statusRadio[{{ $detail->mahasiswa->id }}]"
                                                        id="status{{ $status->id }}_{{ $detail->mahasiswa->id }}"
                                                        value="{{ $status->id }}"
                                                        {{-- {{ optional($detail->mahasiswa->absensiDetail->where('pertemuan', $pertemuan)->first())->id_status == $status->id ? 'checked' : '' }} --}}
                                                        {{ $detail->id_status == $status->id ? 'checked' : '' }}>
                                                        {{-- {{ dd($status->get()) }} --}}
                                                    <label class="form-check-label"
                                                        for="status{{ $status->id }}_{{ $detail->mahasiswa->id }}">
                                                        {{ $status->status }}
                                                    </label>
                                                </div>
                                            @endforeach

                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="keterangan[{{ $detail->mahasiswa->id }}]"
                                                id="keterangan{{ $detail->mahasiswa->id }}"
                                                value="{{ optional($detail->mahasiswa->absensiDetail->where('pertemuan', $pertemuan)->first())->keterangan }}"
                                                placeholder="Keterangan">
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('addon-script')
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
