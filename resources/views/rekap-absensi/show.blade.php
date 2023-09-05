@extends('layouts.app')
@section('title', 'Daftar Hadir')
@section('page-heading')
  Daftar Hadir Mahasiswa Kelas {{ $kelas }}
@endsection

@section('content')
  @php
    $desiredParent = 'absensi'; // Set the desired parent value for this admin panel
  @endphp

  {{-- {{ dd($absensi->groupBy(['mahasiswa.npm', 'mahasiswa.name'])) }} --}}
  <div class="row">
    <div class="col">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary text-dark">
          <i class="fa-regular fa-chevron-left me-2"></i>
          Kembali
        </a>
        <a href="{{ route('rekap-absensi.pdf', $idAbsensi) }}" class="btn btn-dark">
          <i class="fa-regular fa-arrow-down-to-bracket me-2"></i>
          Download PDF
        </a>
      </div>

      <div class="card col-sm-6 col-md-12">
        <div class="card-body">
          <table id="myTable"
            class="table responsive nowrap table-bordered table-striped align-middle"
            style="width:100%">
            <thead>
              <tr>
                <th rowspan="2" class="align-middle text-center">No</th>
                <th rowspan="2" class="align-middle text-center">NPM</th>
                <th rowspan="2" class="align-middle text-center">Nama Mahasiswa/i</th>
                <th colspan="16" class="text-center">Pertemuan dan Tanggal Pertemuan</th>
                <th rowspan="2" class="align-middle text-center">Keterangan</th>
              </tr>
              <tr>
                @for ($i = 1; $i <= 16; $i++)
                  <th>{{ $i }}</th>
                @endfor
              </tr>
            </thead>
            <tbody>
              @foreach ($rekapAbsensi as $rekap)
                {{-- {{ dd($rekap) }} --}}
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $rekap->first()->mahasiswa->npm }}</td>
                  <td>{{ $rekap->first()->mahasiswa->name }}</td>
                  @foreach ($rekap as $pertemuan)
                    <td>{{ mb_substr($pertemuan->status->status, 0, 1) }}</td>
                  @endforeach
                  <td></td>
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
        // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
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
