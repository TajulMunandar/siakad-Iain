<div class="row">
    <div class="col">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModalMatakuliahDosen">
            <i class="fa-regular fa-plus me-2 "></i>
            Tambah
        </button>
        <div class="card mt-3 col-sm-6 col-md-12">
            <div class="card-body">
                {{-- tables --}}
                <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen Pengampu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matkulDosens as $matkulDosen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $matkulDosen->mataKuliah->name }}</td>
                                <td>{{ $matkulDosen->dosen->name }}</td>
                                <td>
                                    <button id="edit-button" class="btn btn-warning" id="edit-button"
                                        data-bs-toggle="modal" data-bs-target="#editModalMKDosen{{ $loop->iteration }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button id="delete-button" class="btn btn-danger" id="delete-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#hapusModalMKDosen{{ $loop->iteration }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            {{--  MODAL DELETE  --}}
                            <x-form_modal :id="'hapusModalMKDosen' . $loop->iteration" title="Hapus Data Matakuliah - Dosen" :route="route('matakuliah-dosen.destroy', $matkulDosen->id)"
                                method='delete' btnTitle="Hapus" primaryBtnStyle="btn-outline-danger"
                                secBtnStyle="btn-secondary">
                                <p class="fs-5">Apakah anda yakin akan menghapus data
                                    <b>{{ $matkulDosen->dosen->name }} ?</b>
                                </p>
                            </x-form_modal>
                            {{--  MODAL DELETE  --}}

                            {{-- Modal Edit --}}
                            <x-form_modal :id="'editModalMKDosen' . $loop->iteration" title="Edit Enroll Matakuliah - Dosen" :route="route('matakuliah-dosen.update', $matkulDosen->id)"
                                method='put' btnTitle="Simpan Perubahan">
                                <div class="mb-3">
                                    <label for="id_matakuliah" class="form-label">Mata Kuliah</label>
                                    <select class="form-select" id="id_matakuliah" name="id_matakuliah"
                                        value="{{ old('id_matakuliah', $matkulDosen->id_matakuliah) }}">
                                        <option selected disabled>Pilih Mata Kuliah</option>
                                        @foreach ($matkuls as $matkul)
                                            @if (old('id_matakuliah', $matkulDosen->id_matakuliah) == $matkul->id)
                                                <option value="{{ $matkul->id }}" selected>
                                                    {{ $matkul->name }}</option>
                                            @else
                                                <option value="{{ $matkul->id }}">
                                                    {{ $matkul->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="id_dosen" class="form-label">Dosen Pengampu</label>
                                    <select class="form-select" id="id_dosen" name="id_dosen"
                                        value="{{ old('id_dosen', $matkulDosen->id_dosen) }}">
                                        <option selected disabled>Pilih Dosen Pengampu</option>
                                        @foreach ($dosens as $dosen)
                                            @if (old('id_dosen', $matkulDosen->id_dosen) == $dosen->id)
                                                <option value="{{ $dosen->id }}" selected>
                                                    {{ $dosen->name }}</option>
                                            @else
                                                <option value="{{ $dosen->id }}">
                                                    {{ $dosen->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </x-form_modal>
                            {{-- / Modal Edit --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{--  MODAL Add  --}}
<x-form_modal id="tambahModalMatakuliahDosen" title="Enroll Matakuliah - Dosen" :route="route('matakuliah-dosen.store')">
    <div class="mb-3">
        <label for="id_matakuliah" class="form-label">Mata Kuliah</label>
        <select class="form-select" id="id_matakuliah" name="id_matakuliah">
            <option selected disabled>Pilih Mata Kuliah</option>
            @foreach ($matkuls as $matkul)
                <option value="{{ $matkul->id }}">{{ $matkul->name }}-{{ $matkul->kelas->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="id_dosen" class="form-label">Dosen Pengampu</label>
        <select class="form-select" id="id_dosen" name="id_dosen">
            <option selected disabled>Pilih Dosen Pengampu</option>
            @foreach ($dosens as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
            @endforeach
        </select>
    </div>
</x-form_modal>
{{--  MODAL Add  --}}


