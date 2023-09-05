@extends('layouts.app')
@section('title', 'Data Rps')
@section('page-heading', 'Data Rencana Perkuliahan Semester')

@section('content')
    @php
        $desiredParent = 'rps'; // Set the desired parent value for this admin panel
    @endphp
    <div id="CPL">
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

        <div class="row mb-3">
            <div class="col">
                <form action="{{ route('cpl.store') }}" method="POST" enctype="multipart/form-data">
                    <a class="btn btn-info text-white me-2" href="{{ route('rps.index') }}">
                        <i class="fa-regular fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Simpan Perubahan
                    </button>
                    <input type="hidden" name="id_rps" value="{{ request('id') }}">
                    <div class="card mt-3 col-sm-6 col-md-12">
                        <div class="card-body">
                            {{-- tables --}}
                            <p class="fw-bold">CPL</p>
                            <label for="sikap" class="form-label">Sikap</label>
                            <div class="mb-3" v-for="(sikap, index) in sikapList" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('sikap') is-invalid @enderror"
                                            id="sikap" name="cpl_sikap[]" v-model="sikap.text">
                                        @error('sikap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addSikap"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeSikap(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <label for="k_umum" class="form-label">Keterampilan Umum</label>
                            <div class="mb-3" v-for="(kumum, index) in kumumList" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('k_umum') is-invalid @enderror"
                                            id="k_umum" name="cpl_k_umum[]" v-model="kumum.text">
                                        @error('k_umum')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addKumum"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeKumum(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <label for="kusus" class="form-label">Keterampilan Khusus</label>
                            <div class="mb-3" v-for="(kusus, index) in kususList" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('kusus') is-invalid @enderror"
                                            id="kusus" name="cpl_k_khusus[]" v-model="kusus.text">
                                        @error('kusus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addKusus"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeKusus(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <label for="pengetahuan" class="form-label">Pengetahuan</label>
                            <div class="mb-3" v-for="(pengetahuan, index) in pengetahuanList" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name"
                                            class="form-control @error('pengetahuan') is-invalid @enderror"
                                            id="pengetahuan" name="cpl_pengetahuan[]" v-model="pengetahuan.text">
                                        @error('pengetahuan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addPengetahuan"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removePengetahuan(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 col-sm-6 col-md-12">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi Mata Kuliah</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi" id="Deskripsi"
                                    name="desc"></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 col-sm-6 col-md-12">
                        <div class="card-body">
                            <p class="fw-bold">CPMK</p>
                            <label for="sikap" class="form-label">Sikap</label>
                            <div class="mb-3" v-for="(sikap2, index) in sikapList2" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('sikap') is-invalid @enderror"
                                            id="sikap" name="cpmk_sikap[]" v-model="sikap2.text">
                                        @error('sikap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addSikap2"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeSikap2(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <label for="k_umum" class="form-label">Keterampilan Umum</label>
                            <div class="mb-3" v-for="(kumum2, index) in kumumList2" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('k_umum') is-invalid @enderror"
                                            id="k_umum" name="cpmk_k_umum[]" v-model="kumum2.text">
                                        @error('k_umum')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addKumum2"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeKumum2(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <label for="kusus" class="form-label">Keterampilan Khusus</label>
                            <div class="mb-3" v-for="(kusus2, index) in kususList2" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('kusus') is-invalid @enderror"
                                            id="kusus" name="cpmk_k_khusus[]" v-model="kusus2.text">
                                        @error('kusus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addKusus2"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeKusus2(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <label for="pengetahuan" class="form-label">Pengetahuan</label>
                            <div class="mb-3" v-for="(pengetahuan2, index) in pengetahuanList2" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name"
                                            class="form-control @error('pengetahuan') is-invalid @enderror"
                                            id="pengetahuan" name="cpmk_pengetahuan[]" v-model="pengetahuan2.text">
                                        @error('pengetahuan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1 d-flex ">
                                        <a class="btn btn-primary me-1" @click="addPengetahuan2"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removePengetahuan2(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 col-sm-6 col-md-12">
                        <div class="card-body">
                            <p class="fw-bold">Sistem Evaluasi</p>
                            <div class="mb-3">
                                <label for="uas" class="form-label">UAS</label>
                                <input type="number" class="form-control" id="uas" name="uas">
                            </div>
                            <div class="mb-3">
                                <label for="uts" class="form-label">UTS</label>
                                <input type="number" class="form-control" id="uts" name="uts">
                            </div>
                            <div class="mb-3">
                                <label for="Tugas" class="form-label">Tugas</label>
                                <input type="number" class="form-control" id="Tugas" name="tugas">
                            </div>
                            <div class="mb-3">
                                <label for="quis" class="form-label">Quis</label>
                                <input type="number" class="form-control" id="quis" name="kuis">
                            </div>

                            <p class="fw-bold">Tabel Evaluasi</p>
                            <div class="row" v-for="(row, index) in tabelRows" :key="index">
                                <div class="col d-flex align-items-center">
                                    <span class="me-2"> @{{ index + 1 }}. </span>
                                    <div class="mb-3">
                                        <label :for="'subCpmk' + index" class="form-label">Sub - CPMK</label>
                                        <input type="name" :id="'subCpmk' + index" class="form-control"
                                            id="uas" name="sub_cpmk[]" v-model="row.subCpmk">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'materi' + index" class="form-label">Materi</label>
                                        <input type="name" class="form-control" :id="'materi' + index"
                                            name="materi[]" v-model="row.materi">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'metode' + index" class="form-label">Metode</label>
                                        <input type="name" class="form-control" :id="'metode' + index"
                                            name="metode[]" v-model="row.metode">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'waktu' + index" class="form-label">Waktu</label>
                                        <input type="number" class="form-control" :id="'waktu' + index" name="waktu[]"
                                            v-model="row.waktu">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'pengalaman' + index" class="form-label">Pengalaman</label>
                                        <input type="name" class="form-control" :id="'pengalaman' + index"
                                            name="pengalaman[]" v-model="row.pengalman">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'indikator' + index" class="form-label">Indikator</label>
                                        <input type="name" class="form-control" :id="'indikator' + index"
                                            name="indikator[]" v-model="row.indikator">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'nilai' + index" class="form-label">Nilai</label>
                                        <input type="number" class="form-control" :id="'nilai' + index" name="nilai[]"
                                            v-model="row.nilai">
                                    </div>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="mb-3">
                                        <a class="btn btn-primary me-1" @click="addTabelRow"><i
                                                class="fa-regular fa-plus"></i></a>
                                        <a class="btn btn-danger text-white" @click="removeTabelRow(index)"><i
                                                class="fa-regular fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3 col-sm-6 col-md-12">
                        <div class="card-body">
                            <p class="fw-bold">Daftar Referensi</p>
                            <div class="mb-3">
                                <label for="utama" class="form-label">Referensi Utama</label>
                                <div class="row" v-for="(row, index) in tabelUtama" :key="index">
                                    <div class="col-11 d-flex">
                                        <span class="me-2">@{{ index + 1 }}. </span>
                                        <input type="name" class="form-control mb-2" id="utama" name="utama[]"
                                            v-model="row.utama">
                                    </div>
                                    <div class="col-1 d-flex">
                                        <div>
                                            <a class="btn btn-primary me-1" @click="addUtama"><i
                                                    class="fa-regular fa-plus"></i></a>
                                        </div>
                                        <div>
                                            <a class="btn btn-danger text-white" @click="removeUtama(index)"><i
                                                    class="fa-regular fa-minus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="penelitian" class="form-label">Referensi dari Penelitian</label>
                                <div class="row" v-for="(row, index) in tabelPenelitian" :key="index">
                                    <div class="col-11 d-flex">
                                        <span class="me-2">@{{ index + 1 }}. </span>
                                        <input type="name" class="form-control mb-2" id="penelitian"
                                            name="penelitian[]" v-model="row.penelitian">
                                    </div>
                                    <div class="col-1 d-flex">
                                        <div>
                                            <a class="btn btn-primary me-1" @click="addPenelitian"><i
                                                    class="fa-regular fa-plus"></i></a>
                                        </div>
                                        <div>
                                            <a class="btn btn-danger text-white" @click="removePenelitian(index)"><i
                                                    class="fa-regular fa-minus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pengabdian" class="form-label">Referensi dari Pengabdian</label>
                                <div class="row" v-for="(row, index) in tabelPengabdian" :key="index">
                                    <div class="col d-flex">
                                        <span class="me-2">@{{ index + 1 }}. </span>
                                        <input type="name" class="form-control mb-2" id="pengabdian"
                                            name="pengabdian[]" v-model="row.pengabdian">
                                    </div>
                                    <div class="col-1 d-flex">
                                      <div>
                                          <a class="btn btn-primary me-1" @click="addPengabdian"><i
                                                  class="fa-regular fa-plus"></i></a>
                                      </div>
                                      <div>
                                          <a class="btn btn-danger text-white" @click="removePengabdian(index)"><i
                                                  class="fa-regular fa-minus"></i></a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


@section('addon-script')
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    tabelUtama: [{
                        utama: ''
                    }],
                    tabelPenelitian: [{
                        penelitian: ''
                    }],
                    tabelPengabdian: [{
                        pengabdian: ''
                    }],
                    sikapList: [{
                        text: ''
                    }],
                    kumumList: [{
                        text: ''
                    }],
                    kususList: [{
                        text: ''
                    }],
                    pengetahuanList: [{
                        text: ''
                    }],
                    sikapList2: [{
                        text: ''
                    }],
                    kumumList2: [{
                        text: ''
                    }],
                    kususList2: [{
                        text: ''
                    }],
                    pengetahuanList2: [{
                        text: ''
                    }],
                    tabelRows: [{
                        subCpmk: '',
                        materi: '',
                        metode: '',
                        waktu: '',
                        pengalaman: '',
                        indikator: '',
                        nilai: '',
                    }],
                }
            },
            methods: {
                addSikap() {
                    this.sikapList.push({
                        text: ''
                    });
                },
                removeSikap(index) {
                    this.sikapList.splice(index, 1);
                },
                addPenelitian() {
                    this.tabelPenelitian.push({
                        text: ''
                    });
                },
                removePenelitian(index) {
                    this.tabelPenelitian.splice(index, 1);
                },
                addPengabdian() {
                    this.tabelPengabdian.push({
                        text: ''
                    });
                },
                removePengabdian(index) {
                    this.tabelPengabdian.splice(index, 1);
                },
                addUtama() {
                    this.tabelUtama.push({
                        text: ''
                    });
                },
                removeUtama(index) {
                    this.tabelUtama.splice(index, 1);
                },
                addKumum() {
                    this.kumumList.push({
                        text: ''
                    });
                },
                removeKumum(index) {
                    this.kumumList.splice(index, 1);
                },
                addKusus() {
                    this.kususList.push({
                        text: ''
                    });
                },
                removeKusus(index) {
                    this.kususList.splice(index, 1);
                },
                addPengetahuan() {
                    this.pengetahuanList.push({
                        text: ''
                    });
                },
                removePengetahuan(index) {
                    this.pengetahuanList.splice(index, 1);
                },
                addSikap2() {
                    this.sikapList2.push({
                        text: ''
                    });
                },
                removeSikap2(index) {
                    this.sikapList2.splice(index, 1);
                },
                addKumum2() {
                    this.kumumList2.push({
                        text: ''
                    });
                },
                removeKumum2(index) {
                    this.kumumList2.splice(index, 1);
                },
                addKusus2() {
                    this.kususList2.push({
                        text: ''
                    });
                },
                removeKusus2(index) {
                    this.kususList2.splice(index, 1);
                },
                addPengetahuan2() {
                    this.pengetahuanList2.push({
                        text: ''
                    });
                },
                removePengetahuan2(index) {
                    this.pengetahuanList2.splice(index, 1);
                },
                addTabelRow() {
                    this.tabelRows.push({
                        subCpmk: '',
                        materi: '',
                        metode: '',
                        waktu: '',
                        pengalaman: '',
                        indikator: '',
                        nilai: '',
                    });
                },
                removeTabelRow(index) {
                    this.tabelRows.splice(index, 1);
                },
            }
        }).mount('#CPL')
    </script>
@endsection
@endsection
