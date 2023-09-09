<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('template/logo.png'))) }}"
                        alt="" width="70" height="70">
                </td>
                <td>
                    <div style=" font-weight: 600; margin-left: 20px">
                        BERITA ACARA PERKULIAHAN <br>
                        FAKULTAS {{ strtoupper($beritaAcara->Kelas->Prodi->Fakultas->name) }} <br>
                        INSTITUT AGAMA ISLAM NEGERI TAKENGON <br>
                        ACEH TENGAH – ACEH
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
                        <td style="font-weight: 600;">Program Studi </td>
                        <td>: {{ $beritaAcara->Kelas->Prodi->name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Mata Kuliah / SKS </td>
                        <td>: {{ $beritaAcara->mataKuliah->name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Kelas </td>
                        <td>: {{ $beritaAcara->Kelas->name }}</td>
                    </tr>
                </table>
            </div>
            <div style="width: 50%; float:right">
                <table style="width: 100%;">
                    <tr>
                        <td style="font-weight: 600;">Semester </td>
                        <td>: {{ $beritaAcara->semester }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Tahun Akademik </td>
                        <td>: {{ $beritaAcara->tahun_akademik }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600;">Dosen Pengampu </td>
                        <td>: {{ auth()->user()->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <table class="table" style="width: 100%; margin-top:15%;  table-layout: fixed;">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Pertemuan ke-</th>
                <th>Hari/tgl</th>
                <th>Materi</th>
                <th>Jumlah
                    Mahasiswa
                </th>
                <th>Bukti Pelaksanaan</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($beritas as $berita)
                <tr>
                    <td>{{ $berita->created_at }}</td>
                    <td>{{ $berita->pertemuan }}</td>
                    <td>{{ $tanggal }}</td>
                    <td>{{ $berita->materi }}</td>
                    <td>{{ $berita->jumlah_mahasiswa }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $berita->bukti_pelaksanaan) }}">
                            Gambar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 130px; padding: 0px 5px 0px 5px">
        <div style="display:flex; justify-content:space-between; padding-right: 20px ">
            <div style="float: left;">
                Divalidasi Oleh: <span style="width: 80px; display: inline-block;"></span><br>
                Ketua Prodi,
                <br>
                <br><br><br>
                {{ strtoupper($beritaAcara->kelas->prodi->dosen->name) }}
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
                NIP/NK. {{ $beritaAcara->kelas->prodi->dosen->nip }}<br>
            </div>
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
                Takengon,<span style="width: 150px;"> {{ $formattedDate }}</span> <br>
                Dosen Pengampu<br><br><br><br>
                {{ strtoupper($beritaAcara->dosen->name) }}
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
                NIP/NK. {{ $beritaAcara->dosen->nip }}<br>
            </div>
        </div>
    </div>
</body>

</html>
