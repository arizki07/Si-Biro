@extends('layout.main')
@section('content')
    @include('components.alerts')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>
                        <div class="page-title-right">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#adduser"><i class="ri-user-add-fill"></i> Add Users</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (!$users)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-marketplace d-flex">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-md">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-img"
                                                class="img-thumbnail rounded-circle" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col">
                                        <div class="p-2">
                                            <h3 class="mb-1">Data Tidak Ada</h3>
                                            <p class="text-muted"></p>
                                            <div class="d-flex align-items-center text-muted">
                                                <i class="ri-map-pin-user-line me-1 fs-16"></i>
                                                <span></span>
                                            </div>
                                            <div class="d-flex align-items-center text-muted">
                                                <i class="ri-building-line me-1 fs-16"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($roles as $role)

                        @if (!$users->isEmpty())
                            @foreach ($users as $user)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body bg-marketplace d-flex">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar-md">
                                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                            alt="user-img" class="img-thumbnail rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="p-2">
                                                        <h3 class="mb-1">{{ $user->nama }}</h3>
                                                        <p class="text-muted">{{ $user->email }}</p>
                                                        <div class="d-flex align-items-center text-muted">
                                                            <i class="ri-map-pin-user-line me-1 fs-16"></i>
                                                            <span>
                                                                @foreach ($roles as $role)
                                                                    @if ($user->id_role == $role->id_role)
                                                                        {{ $role->nama_role }}
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                        <div class="d-flex align-items-center text-muted">
                                                            <i class="ri-building-line me-1 fs-16"></i>
                                                            <span>
                                                                @if ($user->status == 1)
                                                                    Akun Aktif
                                                                @elseif ($user->status == 2)
                                                                    Akun Nonaktif
                                                                @else
                                                                    Akun Ter-Blokir
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewUser{{ $user->id_user }}"><i
                                                                    class="ri-eye-fill"></i></button>
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editUser{{ $user->id_user }}"><i
                                                                    class=" ri-edit-2-fill"></i></button>
                                                            <form id="deleteForm{{ $user->id_user }}"
                                                                action="{{ route('users.destroy', $user->id_user) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" type="button"
                                                                    class="btn btn-danger btn-sm deletePengguna"
                                                                    data-toggle="tooltip"
                                                                    onclick="confirmDelete(event, {{ $user->id_user }})"
                                                                    data-original-title="Delete">
                                                                    <i class="ri-delete-bin-2-fill"></i>
                                                                </a>
                                                            </form>

                                                            {{-- <form method="POST"
                                                        action="{{ route('users.destroy', $user->id_user) }}"
                                                        id="delete-form{{ $user->id_user }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger btn-icon waves-effect waves-light btn-sm"
                                                            onclick="btnDelete()">
                                                            <i class="ri-delete-bin-2-fill"></i>
                                                        </button>
                                                    </form> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-marketplace d-flex">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-md">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="user-img"
                                                        class="img-thumbnail rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="p-2">
                                                    <h3 class="mb-1">Data Tidak Ada</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
            </div>
        </div>
    </div>

    {{-- Modal View --}}
    @foreach ($users as $user)
        <div class="modal fade" id="viewUser{{ $user->id_user }}" tabindex="-1" aria-labelledby="viewUserLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewUserLabel">Detail Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <form action="javascript:void(0);">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div>
                                        <label for="nama" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="nama"
                                            value="{{ $user->nama }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="email" class="form-label">Email</label>
                                        <div class="form-icon right">
                                            <input type="email" class="form-control form-control-icon" id="email"
                                                value="{{ $user->email }}" placeholder="example@gmail.com" disabled>
                                            <i class="ri-mail-unread-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="role" class="form-label">Role</label>
                                        <div class="form-icon right">
                                            <input type="text" class="form-control form-control-icon" id="role"
                                                value="{{ $user->role->nama_role }}" disabled>
                                            <i class="ri-folder-user-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control"
                                            value="{{ $user->status == 1 ? 'Active' : 'Inactive' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal view --}}

    {{-- Modal Edit --}}
    @foreach ($users as $user)
        <div id="editUser{{ $user->id_user }}" class="modal fade fadeInLeft" tabindex="-1"
            aria-labelledby="editUserLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Edit Data Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <form action="{{ route('users.update', ['user' => $user->id_user]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div>
                                        <label for="editNama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="editNama" name="nama"
                                            value="{{ $user->nama }}" placeholder="Masukkan nama">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="editEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="editEmail" name="email"
                                            value="{{ $user->email }}" placeholder="Masukkan email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="editIdRole" class="form-label">Role</label>
                                        <select class="form-select" id="editIdRole" name="id_role">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id_role }}"
                                                    {{ $user->id_role == $role->id_role ? 'selected' : '' }}>
                                                    {{ $role->nama_role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label for="editStatus" class="form-label">Status</label>
                                        <select class="form-select" id="editStatus" name="status">
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end row--><br>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Modal edit --}}

    {{-- Modal Add --}}
    <div id="adduser" class="modal fade fadeInLeft" tabindex="-1" aria-labelledby="adduserLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adduserLabel">Add Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-marketplace d-flex">
                    <form action="{{ route('users.add') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Username</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Enter Username" required>
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required>
                            </div>
                            <div class="col-md-12">
                                <label for="id_role" class="form-label">Role</label>
                                <select class="form-select" id="id_role" name="id_role" required>
                                    <option selected disabled>-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option selected disabled>-- Select Status --</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password" required>
                            </div>
                            <div class="col-md-12">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm password" required>
                            </div>
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
