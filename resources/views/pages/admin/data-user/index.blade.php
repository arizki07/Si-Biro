@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
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
                                        <h3 class="mb-1">Anna Adame</h3>
                                        <p class="text-muted">Owner & Founder</p>
                                        <div class="d-flex align-items-center text-muted">
                                            <i class="ri-map-pin-user-line me-1 fs-16"></i>
                                            <span>California, United States</span>
                                        </div>
                                        <div class="d-flex align-items-center text-muted">
                                            <i class="ri-building-line me-1 fs-16"></i>
                                            <span>Themesbrand</span>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-info btn-sm me-2">View</button>
                                            <button class="btn btn-primary btn-sm me-2">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
@endsection
