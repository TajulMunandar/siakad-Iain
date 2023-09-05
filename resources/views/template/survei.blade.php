@extends('layouts.app')
@section('title', 'Data Survei')
@section('page-heading', 'Data Survei')

@section('content')
    @php
        $desiredParent = 'skm'; // Set the desired parent value for this admin panel
    @endphp
    <div class="card mt-3 col-sm-6 col-md-12">
        <div class="card-body">
            {{-- tables --}}
            <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
                <thead>
                    <tr class="align-middle">
                        <th rowspan="2">No</th>
                        <th rowspan="2">NAMA DOSEN</th>
                        <th rowspan="2">MATA KULIAH</th>
                        <th rowspan="2">SEM</th>
                        @foreach ($indikators as $indikator)
                            <th colspan="{{ $jumlahSoalPerIndikator[$indikator->id] }}">{{ $indikator->indikator }}</th>
                        @endforeach
                        <th rowspan="2">Kendala</th>
                        <th rowspan="2">Saran</th>
                        @foreach ($indikators as $indikator)
                            <th rowspan="2">{{ $indikator->indikator }}</th>
                        @endforeach
                    </tr>

                    <tr>
                        @foreach ($indikators as $index => $indikator)
                            @php
                                $abjadIndikator = $abjad[$index];
                            @endphp
                            {{-- <th>{{ $abjadIndikator }}</th> --}}
                            @for ($i = 0; $i < $jumlahSoalPerIndikator[$indikator->id]; $i++)
                                <th>{{ $abjadIndikator . ($i + 1) }}</th>
                            @endfor
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach ($surveis as $loopSurvei => $survei)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $survei->dosen->name }}</td>
                            <td>{{ $survei->mataKuliah->name }}</td>
                            <td>{{ $survei->semester }}</td>
                            @foreach ($survei->surveiDetail as $detail)
                                <td>{{ $detail->skala_jawaban }}</td>
                            @endforeach
                            <td>{{ $survei->kendala }}</td>
                            <td>{{ $survei->saran }}</td>
                            @foreach ($newArray as $skalas)
                                @foreach ($skalas as $loopSkala => $skala)
                                    @if ($loopSurvei == $loopSkala)
                                        <td>{{ $skala }}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
                "paging": false,
            });
        });
    </script>
@endsection
@endsection
