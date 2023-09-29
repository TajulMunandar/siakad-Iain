@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data Mata Kuliah')

@section('content')
    @php
        $desiredParent = 'data-master'; // Set the desired parent value for this admin panel
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
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('matakuliah-dosen.index') }}">Enroll Matakuliah-Dosen</a>
        </li>
    </ul>

    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('matakuliah.create') }}">
                <i class="fa-regular fa-plus me-2 "></i>
                Tambah
            </a>
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable"
                        class="data-table table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Kode Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkuls as $matkul)
                                {{--  MODAL DELETE  --}}
                                <x-form_modal :id="'hapusModal' . $loop->iteration" title="Hapus Data Matakuliah" :route="route('matakuliah.destroy', $matkul->id)"
                                    method='delete' btnTitle="Hapus" primaryBtnStyle="btn-outline-danger"
                                    secBtnStyle="btn-secondary">
                                    <p class="fs-5">Apakah anda yakin akan menghapus data <b>{{ $matkul->name }} ?</b></p>
                                </x-form_modal>
                                {{--  MODAL DELETE  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@section('addon-script')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('matakuliah.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'kode_matakuliah',
                        name: 'kode_matakuliah'
                    },
                    {
                        data: 'sks',
                        name: 'sks'
                    },
                    {
                        data: 'prodi.name',
                        name: 'prodi.name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
@endsection
