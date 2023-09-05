<div class="row">
  <div class="col">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModalMatakuliah">
      <i class="fa-regular fa-plus me-2 "></i>
      Tambah
    </button>
    <div class="card mt-3 col-sm-6 col-md-12">
      <div class="card-body">
        {{-- tables --}}
        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
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
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $matkul->name }}</td>
                <td>{{ $matkul->kode_matakuliah }}</td>
                <td>{{ $matkul->sks }}</td>
                <td>{{ $matkul->prodi->name }}</td>
                <td>
                  <button id="edit-button" class="btn btn-warning" id="edit-button" data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button id="delete-button" class="btn btn-danger" id="delete-button" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
              </tr>

              {{--  MODAL DELETE  --}}
              <x-form_modal :id="'hapusModal' . $loop->iteration" title="Hapus Data Matakuliah" :route="route('matakuliah.destroy', $matkul->id)" method='delete' btnTitle="Hapus" primaryBtnStyle="btn-outline-danger" secBtnStyle="btn-secondary">
                <p class="fs-5">Apakah anda yakin akan menghapus data <b>{{ $matkul->name }} ?</b></p>
              </x-form_modal>
              {{--  MODAL DELETE  --}}

              {{-- Modal Edit --}}
              <x-form_modal :id="'editModal' . $loop->iteration" title="Edit Data Matakuliah" :route="route('matakuliah.update', $matkul->id)" method='put' btnTitle="Simpan Perubahan">
                <div class="mb-3">
                  <label for="Fakultas" class="form-label">Nama</label>
                  <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $matkul->name) }}">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="Fakultas" class="form-label">Kode Mata Kuliah</label>
                  <input type="name" class="form-control @error('kode_matakuliah') is-invalid @enderror" id="kode_matakuliah" name="kode_matakuliah" value="{{ old('kode_matakuliah', $matkul->kode_matakuliah) }}">
                  @error('kode_matakuliah')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="sks" class="form-label">SKS</label>
                  <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" value="{{ old('sks', $matkul->sks) }}">
                  @error('sks')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="prodi" class="form-label">prodi</label>
                  <select class="form-select @error('prodi') is-invalid @enderror" name="id_prodi" id="prodi" value="{{ old('id_prodi', $matkul->id_prodi) }}">
                    @foreach ($prodis as $prodi)
                      @if (old('id_prodi', $matkul->id_prodi) == $prodi->id)
                        <option value="{{ $prodi->id }}" selected>
                          {{ $prodi->name }}</option>
                      @else
                        <option value="{{ $prodi->id }}">
                          {{ $prodi->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('prodi')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
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
<x-form_modal id="tambahModalMatakuliah" title="Tambah Data Matakuliah" :route="route('matakuliah.store')">
  <div class="mb-3">
    <label for="name" class="form-label">Nama</label>
    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
    @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="Fakultas" class="form-label">Kode Mata Kuliah</label>
    <input type="name" class="form-control @error('kode_matakuliah') is-invalid @enderror" id="kode_matakuliah" name="kode_matakuliah">
    @error('kode_matakuliah')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="sks" class="form-label">SKS</label>
    <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks">
    @error('sks')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="prodi" class="form-label">Prodi</label>
    <select class="form-select @error('prodi') is-invalid @enderror" name="id_prodi" id="prodi">
      @foreach ($prodis as $prodi)
        <option value="{{ $prodi->id }}" selected>
          {{ $prodi->name }}
        </option>
      @endforeach
    </select>
    @error('prodi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
</x-form_modal>
{{--  MODAL Add  --}}
