@extends('layouts.app')
@section('title', 'Data Master')
@section('page-heading', 'Data User')

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

    <div class="row">
        <div class="col">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                      {{ $user->isAdmin == 1 ? 'Super Admin' : 'Dosen' }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#resetPassword{{ $loop->iteration }}">
                                            <i class="fa-solid fa-unlock-keyhole"></i>
                                        </button>
                                        <button id="edit-button" class="btn btn-warning" id="edit-button"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data
                                                        <b>{{ $user->name }} ?</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL DELETE  --}}

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.update', $user->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="Fakultas" class="form-label">Nama</label>
                                                        <input type="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name"
                                                            value="{{ old('name', $user->name) }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="name"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            id="username" name="username"
                                                            value="{{ old('username', $user->username) }}">
                                                        @error('username')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="isAdmin" class="form-label">Role</label>
                                                        <select class="form-select @error('isAdmin') is-invalid @enderror"
                                                            name="isAdmin" id="isAdmin">
                                                            <option value="1"
                                                                {{ $user->isAdmin == 1 ? 'selected' : '' }}>Admin
                                                            </option>
                                                            <option value="0"
                                                                {{ $user->isAdmin == 0 ? 'selected' : '' }}>Dosen
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- / Modal Edit --}}

                                {{--  MODAL RESET PASSWORD  --}}
                                <div class="modal fade" id="resetPassword{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.reset') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" name="id"
                                                            value="{{ $user->id }}">

                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password
                                                                Baru</label>
                                                            <div id="pwd1" class="input-group">
                                                                <input type="password"
                                                                    class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                                    name="password" id="password"
                                                                    value="{{ old('password') }}" required>
                                                                <span class="input-group-text cursor-pointer">
                                                                    <i class="fa-regular fa-eye-slash"
                                                                        id="togglePassword"></i>
                                                                </span>
                                                                @error('password')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="password2" class="form-label">Konfirmasi
                                                                Password
                                                                Baru</label>
                                                            <div id="pwd2" class="input-group">
                                                                <input type="password"
                                                                    class="form-control border-end-0 @error('password2') is-invalid @enderror"
                                                                    name="password2" id="password2"
                                                                    value="{{ old('password2') }}" required>
                                                                <span class="input-group-text cursor-pointer">
                                                                    <i class="fa-regular fa-eye-slash"
                                                                        id="togglePassword"></i>
                                                                </span>
                                                                @error('password2')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dark">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL RESET PASSWORD  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  MODAL Add  --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="name" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="isAdmin" class="form-label">Role</label>
                        <select class="form-select @error('isAdmin') is-invalid @enderror" name="isAdmin" id="isAdmin">
                            <option value="1">Admin
                            </option>
                            <option value="0">Dosen
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  MODAL Add  --}}
@section('addon-script')
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
@endsection
