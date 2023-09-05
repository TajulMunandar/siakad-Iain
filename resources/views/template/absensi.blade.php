<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rekap Daftar Hadir</title>
  <style>
    .table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #000;
      margin-bottom: 20px;
    }

    .table th,
    .table td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    .table th {
      font-weight: bold;
    }

    .header-table {
      font-weight: 600;
    }

    .text-center {
      text-align: center;
    }

    hr {
      border-top: 2px solid #000;
    }
  </style>
</head>

<body style="padding-left: 0px 20px 0px 20px; ">
  <table>
    <tbody width="100%">
      <tr>
        <td>
          <img
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('template/logo.png'))) }}"
            alt="" width="70" height="70">
        </td>
        <td>
          <div style=" font-weight: 600; margin-left: 20px">
            DAFTAR HADIR PERKULIAHAN MAHASISWA/I<br>
            FAKULTAS {{ strtoupper($absensi->kelas->prodi->fakultas->name) }} <br>
            INSTITUT AGAMA ISLAM NEGERI TAKENGON <br>
            SEMESTER {{ strtoupper($absensi->semester) }} TAHUN AKADEMIK {{ $absensi->tahun_akademik }}
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <div style="margin-top: 40px; width: 100%">
    <div style="display:flex; justify-content: space-between;">
      <div style="width: 50%; float:left">
        <table style="width: 100%;">
          <tr>
            <td style="font-weight: 600;">Kode / SKS </td>
            <td>: </td>
          </tr>
          <tr>
            <td style="font-weight: 600;">Nama Mata Kuliah</td>
            <td>: </td>
          </tr>
          <tr>
            <td style="font-weight: 600;">Hari / Jam </td>
            <td>: {{ $absensi->hari }}</td>
          </tr>
          <tr>
            <td style="font-weight: 600;">Ruang / Lokasi </td>
            <td>: {{ $absensi->kelas->name }}</td>
          </tr>
        </table>
      </div>
      <div style="width: 50%; float:right">
        <table style="width: 100%;">
          <tr>
            <td style="font-weight: 600;">Nama Unit / Kelp. Belajar </td>
            <td>:  {{ $absensi->nama_unit }}</td>
          </tr>
          <tr>
            <td style="font-weight: 600;">Dosen </td>
            <td>: </td>
          </tr>
          <tr>
            <td style="font-weight: 600;">Asisten</td>
            <td>:  {{ $absensi->asisten }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <table class="table" style="width: 100%; margin-top:10%;">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">NPM</th>
        <th rowspan="2">Nama Mahasiswa/i</th>
        <th colspan="16">Pertemuan dan Tanggal Pertemuan</th>
        <th rowspan="2">Keterangan</th>
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

  <div>
    <p>Note:</p>
    <p>
      1.	Mahasiswa yang tidak ada namanya dalam daftar ini tidak dibenarkan mengikuti perkuliahan;<br>
      2.	Dilarang mencantumkan nama mahasiswa dalam daftar ini tanpa proses uniting.
    </p>
  </div>

  <div style="margin-top: 24px; padding: 0px 5px 0px 5px">
    <div style="display:flex; justify-content:end; margin-right: 48px ">
      <div style="float: right;">
        @php
          date_default_timezone_set('Asia/Jakarta');

          // Get the current day, month, and year
          $day = date('j');
          $month = date('F');
          $year = date('Y');

          // Create the formatted date string
          $formattedDate = $day . ' ' . $month . ' ' . $year;
        @endphp
        Takengon, <span>{{ $formattedDate }}</span> <br>
        Dosen Pengampu<br><br><br><br>
        {{ $absensi->dosen->name }}
        <hr style="border-width: 1px; border-color: black; border-style: solid;">
        NIP.<br>
      </div>
    </div>
  </div>
</body>

</html>
