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

        }

        .table th {
            text-align: center;
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
    <table style="width: 100%; padding-left: 20px">
        <thead>
            <tr>
                <th>
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('template/logo.png'))) }}"
                        alt="" width="70" height="70" style="text-align: center">
                </th>
            </tr>
        </thead>
    </table>
    <br>
    <div style=" font-weight: 600; margin-left: 20px; text-align: center">
        RENCANA PERKULIAHAN SEMESTER <br>
        {{ strtoupper($rpses->fakultas->name) }} <br>
        IAIN TAKENGON
    </div>
    <table class="table" style="width: 100%;  table-layout: fixed; margin-top: 30px; font-weight: 600">
        <tr>
            <td>Prodi :{{ $rpses->prodi->name }}</td>
            <td>Jumlah SKS : {{ $rpses->mataKuliah->sks }}</td>
        </tr>
        <tr>
            <td>Nama Mata Kuliah : {{ $rpses->mataKuliah->name }}</td>
            <td>Semester : {{ $rpses->semester }}</td>
        </tr>
        <tr>
            <td>Kode Mata Kuliah : {{ $rpses->mataKuliah->kode_matakuliah }}</td>
            <td rowspan="2">Dosen : {{ $rpses->dosen->name }}</td>
        </tr>
        <tr>
            <td>TahunAjaran : {{ $rpses->tahun_ajaran }}</td>
        </tr>
    </table>
    <div>
        <span style="font-size: 24px; font-weight: 600">A. CPL:</span>
        <div style="margin: 20px">
            <span>1. Sikap : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpls as $index => $cpl)
                    @if ($cpl->cpl_sikap !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpl->cpl_sikap }}</span><br>
                    @endif
                @endforeach
            </div>
            <span>2. Keterampilan Umum : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpls as $index => $cpl)
                    @if ($cpl->cpl_k_umum !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpl->cpl_k_umum }}</span><br>
                    @endif
                @endforeach
            </div>
            <span>3. Keterampilan Khusus : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpls as $index => $cpl)
                    @if ($cpl->cpl_k_khusus !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpl->cpl_k_khusus }}</span><br>
                    @endif
                @endforeach
            </div>
            <span>4. Pengetahuan : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpls as $index => $cpl)
                    @if ($cpl->cpl_pengetahuan !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpl->cpl_pengetahuan }}</span><br>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div>
        <span style="font-size: 24px; font-weight: 600">B. Deskripsi Mata Kuliah :</span>
        <div style="margin: 20px">
            <span>{{ $capaians->desc }} </span>
        </div>
    </div>
    <div>
        <span style="font-size: 24px; font-weight: 600">C. Capaian Pembelajaran Mata Kuliah (CPMK) :</span>
        <div style="margin: 20px">
            <span>1. Sikap : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpmks as $index => $cpmk)
                    @if ($cpmk->cpmk_sikap !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpmk->cpmk_sikap }}</span><br>
                    @endif
                @endforeach
            </div>
            <span>2. Keterampilan Umum : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpmks as $index => $cpmk)
                    @if ($cpmk->cpmk_k_umum !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpmk->cpmk_k_umum }}</span><br>
                    @endif
                @endforeach
            </div>
            <span>3. Keterampilan Khusus : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpmks as $index => $cpmk)
                    @if ($cpmk->cpmk_k_khusus !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpmk->cpmk_k_khusus }}</span><br>
                    @endif
                @endforeach
            </div>
            <span>4. Pengetahuan : </span><br>
            <div style="margin-left: 30px">
                @foreach ($cpmks as $index => $cpmk)
                    @if ($cpmk->cpmk_pengetahuan !== '')
                        <span>{{ chr(97 + $index) }}. {{ $cpmk->cpmk_pengetahuan }}</span><br>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div>
        <span style="font-size: 24px; font-weight: 600">D. Sistem Evaluasi</span>
        <div style="padding: 0px 30px 0px 30px">
            <table class="table" style="width: 100%;  table-layout: fixed; padding:30px">
                <tr>
                    <th>Bentuk Evaluasi</th>
                    <th>Bobot Penilaian</th>
                    <th>Kategori Nilai Akhir</th>
                </tr>
                <tr>
                    <td>Quis</td>
                    <td style="text-align: center">{{ $capaians->kuis }}%</td>
                    <td rowspan="4"> A 86 &lt; &#61; Nilai Akhir &lt; &#61; 100 <br>
                        B 72 &lt; &#61; Nilai Akhir &lt; 86 <br>
                        C 55 &lt; &#61; Nilai Akhir &lt; 72 <br>
                        D 41 &lt; &#61; Nilai Akhir &lt; 55 <br>
                        E Nilai Akhir &lt; 41
                </tr>
                <tr>
                    <td>Tugas</td>
                    <td style="text-align: center">{{ $capaians->tugas }}%</td>

                </tr>
                <tr>
                    <td>UTS</td>
                    <td style="text-align: center">{{ $capaians->uts }}%</td>

                </tr>
                <tr>
                    <td>UAS</td>
                    <td style="text-align: center">{{ $capaians->uas }}%</td>

                </tr>
            </table>
        </div>

    </div>
    <table class="table" style="width: 100%;  table-layout: fixed; margin-top: 20px; padding:30px">
        <tr>
            <th>Minggu ke-</th>
            <th>Kemampuan Akhir yang Diharapkan
                (Sub-CPMK)
            </th>
            <th>Materi/TemaPokok</th>
            <th>Strategi / Metode Pembelajaran</th>
            <th>Waktu Belajar (menit)</th>
            <th>Pengalaman Belajar Mahasiswa</th>
            <th>Indikator dan Kriteria Penilaian</th>
            <th>Bobot Penilaian</th>
        </tr>
        <tr>
            <th>(1)</th>
            <th>(2)</th>
            <th>(3)</th>
            <th>(4)</th>
            <th>(5)</th>
            <th>(6)</th>
            <th>(7)</th>
            <th>(8)</th>
        </tr>
        @foreach ($tables as $table)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $table->sub_cpmk }}</td>
                <td>{{ $table->materi }}</td>
                <td>{{ $table->metode }}</td>
                <td>{{ $table->waktu }}</td>
                <td>{{ $table->pengalaman }}</td>
                <td>{{ $table->indikator }}</td>
                <td>{{ $table->nilai }}</td>
            </tr>
        @endforeach
    </table>

    <div>
        <h3>Daftar Referensi :</h3>
        <div style="margin-left: 10px">
            <span>Referensi Utama:</span><br>
            @foreach ($daftars as $daftar)
                @if ($daftar->utama !== '')
                    <span>{{ $loop->iteration }}. {{ $daftar->utama }}</span><br>
                @endif
            @endforeach
            <span>Referensi dari penelitian:</span><br>
            @foreach ($daftars as $daftar)
                @if ($daftar->penelitian !== '')
                    <span>{{ $loop->iteration }}. {{ $daftar->penelitian }}</span><br>
                @endif
            @endforeach
            <span>Referensi dari pengabdian:</span><br>
            @foreach ($daftars as $daftar)
                @if ($daftar->pengabdian !== '')
                    <span>{{ $loop->iteration }}. {{ $daftar->pengabdian }}</span><br>
                @endif
            @endforeach
        </div>
    </div>

    <div style="margin-top: 130px; padding: 0px 5px 0px 5px">
        <div style="display:flex; justify-content:space-between; padding-right: 20px ">
            <div style="float: left;">

            </div>
            @php
                date_default_timezone_set('Asia/Jakarta');

                // Get the current day, month, and year
                $day = date('j');
                $month = date('F');
                $year = date('Y');

                // Create the formatted date string
                $formattedDate = $day . ' ' . $month . ' ' . $year;
            @endphp
            <div style="float: right;">
                Takengon,<span style="width: 150px;"> {{ $formattedDate }}</span> <br>
                Dosen Pengampu<br><br><br><br>
                {{ strtoupper($rpses->dosen->name) }}
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
                NIP/NK. {{ $rpses->dosen->nip }} <br>
            </div>
        </div>
    </div>

</body>

</html>
