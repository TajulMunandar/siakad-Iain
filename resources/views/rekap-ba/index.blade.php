@extends('layouts.app')
@section('title', 'Rekap Berita Acara')
@section('page-heading')
    Rekap Berita Acar
@endsection

@section('content')
    @php
        $desiredParent = 'absensi';
    @endphp

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary text-dark">
                    <i class="fa-regular fa-chevron-left me-2"></i>
                    Kembali
                </a>
            </div>

            <div class="card col-sm-6 col-md-12">
                <div class="card-body">
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th class="align-middle text-center">No</th>
                                <th class="align-middle text-center">NIP/NK</th>
                                <th class="align-middle text-center">Nama Dosen</th>
                                <th class="align-middle text-center">Kelas</th>
                                <th class="text-center">Mata Kuliah</th>
                                <th class="align-middle text-center">Jumlah Berita Acara</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($beritas as $berita)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $berita->dosen->nip }}</td>
                                    <td>{{ $berita->dosen->name }}</td>
                                    <td>{{ $berita->kelas->name }}</td>
                                    <td>{{ $berita->mataKuliah->name }}</td>
                                    <td>{{ $berita->beritaAcaraDetail->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addon-script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5'
                ],
                "scrollX": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search...",
                    "decimal": ",",
                    "thousands": ".",
                },
            });

            $('.dataTables_filter input[type="search"]').css({
                "marginBottom": "10px"
            });
        });
    </script>
@endsection
