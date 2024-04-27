@extends('layout.main')
@section('content')
    @include('components.alerts')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Datatables</h4>

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
                                            <img src="assets/images/users/avatar-1.jpg" alt="user-img"
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
                    @foreach ($users as $item)
                        @foreach ($roles as $role)
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
                                            <!--end col-->
                                            <div class="col">
                                                <div class="p-2">
                                                    <h3 class="mb-1">{{ $item->nama }}</h3>
                                                    <p class="text-muted">{{ $item->email }}</p>
                                                    <div class="d-flex align-items-center text-muted">
                                                        <i class="ri-map-pin-user-line me-1 fs-16"></i>
                                                        <span>
                                                            @if ($item->id_role == $role->id_role)
                                                                Role {{ $role->nama_role }}
                                                            @else
                                                                Role Tidak Ada
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="d-flex align-items-center text-muted">
                                                        <i class="ri-building-line me-1 fs-16"></i>
                                                        <span>
                                                            @if ($item->status == 1)
                                                                Akun Aktif
                                                            @elseif ($item->status == 2)
                                                                Akun Nonaktif
                                                            @else
                                                                Akun Ter-Blokir
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#viewUser"><i
                                                                class="ri-eye-fill"></i></button>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#editUser"><i
                                                                class=" ri-edit-2-fill"></i></button>
                                                        <button class="btn btn-danger btn-sm"><i
                                                                class=" ri-delete-bin-6-fill"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Modal View --}}
    <div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="viewUserLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserLabel">Detail Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="nama">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <div class="form-icon right">
                                        <input type="email" class="form-control form-control-icon" id="email"
                                            placeholder="example@gmail.com">
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="role" class="form-label">Role</label>
                                    <div class="form-icon right">
                                        <input type="text" class="form-control form-control-icon" id="role"
                                            placeholder="Role">
                                        <i class="ri-folder-user-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="basiInput" class="form-label">Status</label>
                                    <input type="password" class="form-control" id="basiInput">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    </div>
    {{-- end modal view --}}

    {{-- Modal Edit --}}
    <div id="editUser" class="modal fade fadeInLeft" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Edit Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName"
                                        placeholder="Enter firstname">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName"
                                        placeholder="Enter lastname">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailInput"
                                    placeholder="Enter your email">
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordInput" value="451326546"
                                    placeholder="Enter password">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
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
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf <!-- Laravel memerlukan token CSRF untuk form POST -->
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="namaInput"
                                        placeholder="Enter Username" name="nama" required>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailInput1"
                                    placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="col-xxl-6">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select mb-3" id="roleSelect" name="id_role" required>
                                    <option selected disabled>-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select mb-3" id="statusSelect" name="status" required>
                                    <option selected disabled>-- Select Status --</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordInput1"
                                    placeholder="Enter password" name="password" required>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
