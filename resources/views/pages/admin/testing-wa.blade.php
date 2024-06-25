@extends('layout.main')
@section('content')
    @include('components.alerts')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $title }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="form-grid-showcode" class="form-label text-muted">Hide</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form method="POST" action="{{ route('wa.testing') }}">
                                    @csrf
                                    <div class="col-xxl-12 col-md-6">
                                        <div>
                                            <label for="basiInput" class="form-label">Nomor</label>
                                            <input type="text" class="form-control" name="wa" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-12 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label">Pesan</label>
                                            <input type="text" class="form-control" name="pesan" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-3" type="submit">Send</button>
                                </form>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-marketplace d-flex">
                    <form action="{{ route('store.role') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <div>
                                    <label for="nama_role" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control" id="nama_role" name="nama_role"
                                        placeholder="Enter Nama Role">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
