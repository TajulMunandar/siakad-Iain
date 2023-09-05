@extends('layouts.app')
@section('title', 'Data Survei')
@section('page-heading', 'Data Survei')

@section('content')
    @php
        $desiredParent = 'skm'; // Set the desired parent value for this admin panel
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
            <a class="btn btn-primary" href="{{ route('survei-skm.index') }}">
                <i class="fa-solid fa-chart-mixed "></i>
                Survei
            </a>
            <a class="btn btn-info text-white" href="{{ route('exports.view') }}">
                <i class="fa-solid fa-eye "></i>
                Lihat Rekaputilasi
            </a>
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dosen</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>Tahun Akademik</th>
                                <th>Kendala</th>
                                <th>Saran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveis as $survei)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $survei->dosen->name }}</td>
                                    <td>{{ $survei->mataKuliah->name }}</td>
                                    <td>{{ $survei->semester }}</td>
                                    <td>{{ $survei->tahun_akademik }}</td>
                                    <td>{{ $survei->kendala }}</td>
                                    <td>{{ $survei->saran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@section('addon-script')
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
