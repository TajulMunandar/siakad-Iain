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
                        IAIN Takengon <br>
                        INSTITUT AGAMA ISLAM NEGERI TAKENGON <br>
                        Jalan Yos Sudarso/A.Dimot No.10 Takengon, A. Tengah, (0643) 23268
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr class="fw-bolder">
    <h3 style="text-align: center; padding: 40px">KONTRAK PERKULIAHAN</h3>
    <table class="table" style="width: 100%;  table-layout: fixed;">
        <tr>
            <td colspan="2">Nama Dosen Pengampu</td>
            <td colspan="2">{{ $kontrak->dosen->name }}</td>
        </tr>
        <tr>
            <td colspan="2">Mata Kuliah</td>
            <td colspan="2">{{ $kontrak->mataKuliah->name }}</td>
        </tr>
        <tr>
            <td colspan="2">Fakultas</td>
            <td colspan="2">{{ $kontrak->fakultas->name }}</td>
        </tr>
        <tr>
            <td colspan="2">Program Studi</td>
            <td colspan="2">{{ $kontrak->prodi->name }}</td>
        </tr>
        <tr>
            <td colspan="2">Semester</td>
            <td colspan="2">{{ $kontrak->semester }}</td>
        </tr>
        <tr>
            <td colspan="2">Tahun Akademik</td>
            <td colspan="2">{{ $kontrak->tahun_akademik }}</td>
        </tr>
        <tr>
            <th colspan="2">Item Penilaian</th>
            <th colspan="2">Ketentuan yang harus diperbaiki</th>
        </tr>
        <tr>
            <td>1. Ujian Akhir Semester</td>
            <td style="width: 10% ">: {{ $kontrak->uas }}%</td>
            <td colspan="2" rowspan="4">Kehadiran kuliah mahasiswa minimal 75% dari total tatap muka. Mahasiswa
                yang kehadiran
                kurang dari 75% tidak dibenarkan mengikuti ujian final.</td>
        </tr>
        <tr>
            <td>2. Ujian Tengah Semester</td>
            <td style="width: 10% ">: {{ $kontrak->uts }}%</td>
        </tr>
        <tr>
            <td>3. Tugas</td>
            <td style="width: 10% ">: {{$kontrak->tugas  }}%</td>
        </tr>
        <tr>
            <td>4. Kuis</td>
            <td style="width: 10% ">: {{ $kontrak->kuis }}%</td>
        </tr>
    </table>
    <div style="padding: 0px 5px 0px 5px">
        <p>Hal-Hal yang perlu di sampaikan:</p>
        <p >
          {!! str_replace(',', '<br><br>', $kontrak->ket) !!}
        </p>
    </div>

    <div style="margin-top: 130px; padding: 0px 5px 0px 5px">
      <div style="display:flex; justify-content:space-between; padding-right: 20px ">
          <div style="float: left;">
              Komisaris <span style="width: 80px; display: inline-block;"></span>
              <br><br>
              <br><br><br>
              {{ strtoupper($kontrak->kelas->mahasiswa->where('isKomisaris', 1)->first()->name) }}
              <hr style="border-width: 1px; border-color: black; border-style: solid;">
              NPM. {{ $kontrak->kelas->mahasiswa->where('isKomisaris', 1)->first()->npm }}<br>
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
              Takengon,<span style="width: 150px;"></span> {{ $formattedDate }}<br>
              Dosen Pengampu<br><br><br><br>
              {{ strtoupper($kontrak->dosen->name) }}
              <hr style="border-width: 1px; border-color: black; border-style: solid;">
              NIP/NK.{{ $kontrak->dosen->nip }}<br>
          </div>
      </div>
  </div>



</body>

</html>
