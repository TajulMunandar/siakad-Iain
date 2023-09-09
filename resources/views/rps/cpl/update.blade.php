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
                <form action="{{ route('cpl.update', $id) }}" method="POST" enctype="multipart/form-data">
                    <a class="btn btn-info text-white me-2" href="{{ route('rps.index') }}">
                        <i class="fa-regular fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Simpan Perubahan
                    </button>
                    <input type="hidden" name="id_rps" value="{{ $id }}">
                    <div class="card mt-3 col-sm-6 col-md-12">
                        <div class="card-body">
                            {{-- tables --}}
                            <p class="fw-bold">CPL</p>
                            <input type="hidden" v-for="(item, index) in id_cpl" :key="index" name="cpl_id[]" v-model="id_cpl[index].id">
                            <label for="sikap" class="form-label">Sikap</label>
                            <div class="mb-3" v-for="(item, index) in sikap_cpl" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('sikap') is-invalid @enderror"
                                            id="sikap" name="cpl_sikap[]" v-model="sikap_cpl[index].cpl_sikap">
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
                            <div class="mb-3" v-for="(item, index) in k_umum_cpl" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('k_umum') is-invalid @enderror"
                                            id="k_umum" name="cpl_k_umum[]" v-model="k_umum_cpl[index].cpl_k_umum">
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
                            <div class="mb-3" v-for="(item, index) in k_khusus_cpl" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('kusus') is-invalid @enderror"
                                            id="kusus" name="cpl_k_khusus[]" v-model="k_khusus_cpl[index].cpl_k_khusus">
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
                            <div class="mb-3" v-for="(item, index) in pengetahuan_cpl" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name"
                                            class="form-control @error('pengetahuan') is-invalid @enderror"
                                            id="pengetahuan" name="cpl_pengetahuan[]" v-model="pengetahuan_cpl[index].cpl_pengetahuan">
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
                                    name="desc" value="{{ old('deskripsi', $capaians->desc) }}"></textarea>
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
                            <input type="hidden" v-for="(item, index) in id_cpmk" :key="index" name="cpmk_id[]" v-model="id_cpmk[index].id">
                            <label for="sikap" class="form-label">Sikap</label>
                            <div class="mb-3" v-for="(item, index) in sikap_cpmk" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('sikap') is-invalid @enderror"
                                            id="sikap" name="cpmk_sikap[]" v-model="sikap_cpmk[index].cpmk_sikap">
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
                            <div class="mb-3" v-for="(item, index) in k_umum_cpmk" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('k_umum') is-invalid @enderror"
                                            id="k_umum" name="cpmk_k_umum[]" v-model="k_umum_cpmk[index].cpmk_k_umum">
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
                            <div class="mb-3" v-for="(item, index) in k_khusus_cpmk" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name" class="form-control @error('kusus') is-invalid @enderror"
                                            id="kusus" name="cpmk_k_khusus[]" v-model="k_khusus_cpmk[index].cpmk_k_khusus">
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
                            <div class="mb-3" v-for="(item, index) in pengetahuan_cpmk" :key="index">
                                <div class="row">
                                    <div class="col-lg-11 d-flex">
                                        <span class="me-2"> @{{ index + 1 }}. </span>
                                        <input type="name"
                                            class="form-control @error('pengetahuan') is-invalid @enderror"
                                            id="pengetahuan" name="cpmk_pengetahuan[]" v-model="pengetahuan_cpmk[index].cpmk_pengetahuan">
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
                                <input type="number" class="form-control" id="uas" name="uas"
                                    value="{{ old('uas', $capaians->uas) }}">
                            </div>
                            <div class="mb-3">
                                <label for="uts" class="form-label">UTS</label>
                                <input type="number" class="form-control" id="uts" name="uts"
                                    value="{{ old('uts', $capaians->uts) }}">
                            </div>
                            <div class="mb-3">
                                <label for="Tugas" class="form-label">Tugas</label>
                                <input type="number" class="form-control" id="Tugas" name="tugas"
                                    value="{{ old('tugas', $capaians->tugas) }}">
                            </div>
                            <div class="mb-3">
                                <label for="quis" class="form-label">Quis</label>
                                <input type="number" class="form-control" id="quis" name="kuis"
                                    value="{{ old('quis', $capaians->kuis) }}">
                            </div>

                            <p class="fw-bold">Tabel Evaluasi</p>
                            <div class="row" v-for="(row, index) in pertemuans" :key="index">
                                <div class="col">
                                    <div class="mb-3">
                                        <label :for="'sub_cpmk' + index" class="form-label">Sub - CPMK</label>
                                        <input type="name" :id="'sub_cpmk' + index" class="form-control"
                                            id="uas" name="sub_cpmk[]" v-model="row.sub_cpmk">
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
                                            name="pengalaman[]" v-model="row.pengalaman">
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
                            <input type="hidden" v-for="(item, index) in daftarId" :key="index" name="daftarId[]" v-model="daftarId[index].id">
                            <div class="mb-3">
                                <label for="utama" class="form-label">Referensi Utama</label>
                                <div class="row" v-for="(item, index) in daftarUtama" :key="index">
                                    <div class="col-11 d-flex">
                                        <span class="me-2">@{{ index + 1 }}. </span>
                                        <input type="name" class="form-control mb-2" id="utama" name="utama[]"
                                          v-model="daftarUtama[index].utama">
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
                                <div class="row" v-for="(item, index) in daftarPenelitian" :key="index">
                                    <div class="col-11 d-flex">
                                        <span class="me-2">@{{ index + 1 }}. </span>
                                        <input type="name" class="form-control mb-2" id="penelitian"
                                            name="penelitian[]"  v-model="daftarPenelitian[index].penelitian">
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
                                <div class="row" v-for="(item, index) in daftarPengabdian" :key="index">
                                    <div class="col d-flex">
                                        <span class="me-2">@{{ index + 1 }}. </span>
                                        <input type="name" class="form-control mb-2" id="pengabdian"
                                            name="pengabdian[]" v-model="daftarPengabdian[index].pengabdian">
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
                  id_cpl: @json($id_cpl),
                  sikap_cpl: @json($sikap_cpl),
                  k_umum_cpl: @json($k_umum_cpl),
                  k_khusus_cpl: @json($k_khusus_cpl),
                  pengetahuan_cpl: @json($pengetahuan_cpl),
                  id_cpmk: @json($id_cpmk),
                  sikap_cpmk: @json($sikap_cpmk),
                  k_umum_cpmk: @json($k_umum_cpmk),
                  k_khusus_cpmk: @json($k_khusus_cpmk),
                  pengetahuan_cpmk: @json($pengetahuan_cpmk),
                  daftarId: @json($daftarId),
                  daftarUtama: @json($daftarUtama),
                  daftarPenelitian: @json($daftarPenelitian),
                  daftarPengabdian: @json($daftarPengabdian),
                  pertemuans: @json($pertemuans),
                }
            },
            methods: {
                addSikap() {
                    this.sikap_cpl.push({
                        text: ''
                    });
                },
                removeSikap(index) {
                    this.sikap_cpl.splice(index, 1);
                },
                addPenelitian() {
                    this.daftarPenelitian.push({
                        text: ''
                    });
                },
                removePenelitian(index) {
                    this.daftarPenelitian.splice(index, 1);
                },
                addPengabdian() {
                    this.daftarPengabdian.push({
                        text: ''
                    });
                },
                removePengabdian(index) {
                    this.daftarPengabdian.splice(index, 1);
                },
                addUtama() {
                    this.daftarUtama.push({
                        text: ''
                    });
                },
                removeUtama(index) {
                    this.daftarUtama.splice(index, 1);
                },
                addKumum() {
                    this.k_umum_cpl.push({
                        text: ''
                    });
                },
                removeKumum(index) {
                    this.k_umum_cpl.splice(index, 1);
                },
                addKusus() {
                    this.k_khusus_cpl.push({
                        text: ''
                    });
                },
                removeKusus(index) {
                    this.k_khusus_cpl.splice(index, 1);
                },
                addPengetahuan() {
                    this.pengetahuan_cpl.push({
                        text: ''
                    });
                },
                removePengetahuan(index) {
                    this.pengetahuan_cpl.splice(index, 1);
                },
                addSikap2() {
                    this.sikap_cpmk.push({
                        text: ''
                    });
                },
                removeSikap2(index) {
                    this.sikap_cpmk.splice(index, 1);
                },
                addKumum2() {
                    this.k_umum_cpmk.push({
                        text: ''
                    });
                },
                removeKumum2(index) {
                    this.k_umum_cpmk.splice(index, 1);
                },
                addKusus2() {
                    this.k_khusus_cpmk.push({
                        text: ''
                    });
                },
                removeKusus2(index) {
                    this.k_khusus_cpmk.splice(index, 1);
                },
                addPengetahuan2() {
                    this.pengetahuan_cpmk.push({
                        text: ''
                    });
                },
                removePengetahuan2(index) {
                    this.pengetahuan_cpmk.splice(index, 1);
                },
                addTabelRow() {
                    this.pertemuans.push({
                        sub_cpmk: '',
                        materi: '',
                        metode: '',
                        waktu: '',
                        pengalaman: '',
                        indikator: '',
                        nilai: '',
                    });
                },
                removeTabelRow(index) {
                    this.pertemuans.splice(index, 1);
                },
            }
        }).mount('#CPL')
    </script>
@endsection
@endsection
