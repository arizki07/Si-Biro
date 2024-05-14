@extends('layout.main')
@section('content')
    @include('components.alerts')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Datatables</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Datatables</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Basic Datatables</h5>
                            <button type="button" class="btn btn-primary" style="float: right" data-bs-toggle="modal"
                                data-bs-target="#exampleModalgrid">
                                <i class=" ri-user-add-fill"></i> Tambah Data Role
                            </button>
                        </div>
                        <div class="card-body">

                            <table id="example"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $key => $item)
                                        <tr class="text-center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['nama_role'] }}</td>
                                            <td>

                                                <button type="button"
                                                    class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#editmodal{{ $item->id_role }}">
                                                    <i class=" ri-edit-2-fill"></i>
                                                </button>
                                                <form id="deleteForm{{ $item->id_role }}"
                                                    action="{{ route('destroy.role', $item->id_role) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" type="button"
                                                        class="btn btn-danger btn-sm deletePengguna" data-toggle="tooltip"
                                                        onclick="confirmDelete(event, {{ $item->id_role }})"
                                                        data-original-title="Delete">
                                                        <i class="ri-delete-bin-2-fill"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

    {{-- End Modal Tambah --}}

    {{-- modal edit --}}
    @foreach ($role as $item)
        <div class="modal fade" id="editmodal{{ $item->id_role }}" tabindex="-1" aria-labelledby="editmodalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editmodalLabel">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <form action="{{ route('update.role', $item->id_role) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="nama_role" class="form-label">Nama Role</label>
                                        <input type="text" class="form-control" id="nama_role" name="nama_role"
                                            value="{{ old('nama_role', $item->nama_role) }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}
@endsection
