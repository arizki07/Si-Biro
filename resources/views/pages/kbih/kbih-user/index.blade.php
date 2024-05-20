@extends('layout.main')
@section('content')
    @include('components.alerts')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>
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
                                                                    {{ $role->role }}
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
                                                                class="ri-eye-fill"></i>
                                                        </button>
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
                                                value="{{ $user->role->role }}" disabled>
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
@endsection
