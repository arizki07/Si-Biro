@extends('layout.main')
@section('content')
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
                                Tambah Data Role
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th data-ordering="false">SR No.</th>
                                        <th data-ordering="false">ID</th>
                                        <th data-ordering="false">Purchase ID</th>
                                        <th data-ordering="false">Title</th>
                                        <th data-ordering="false">User</th>
                                        <th>Assigned To</th>
                                        <th>Created By</th>
                                        <th>Create Date</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                                    value="option1">
                                            </div>
                                        </th>
                                        <td>01</td>
                                        <td>VLZ-452</td>
                                        <td>VLZ1400087402</td>
                                        <td><a href="#!">Post launch reminder/ post list</a></td>
                                        <td>Joseph Parker</td>
                                        <td>Alexis Clarke</td>
                                        <td>Joseph Parker</td>
                                        <td>03 Oct, 2021</td>
                                        <td><span class="badge badge-soft-info">Re-open</span></td>
                                        <td><span class="badge bg-danger">High</span></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="#!" class="dropdown-item"><i
                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                            View</a></li>
                                                    <li><a class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
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
                    <h5 class="modal-title" id="exampleModalgridLabel">Grid Modals</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter firstname">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter lastname">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label class="form-label">Gender</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio3" value="option3">
                                        <label class="form-check-label" for="inlineRadio3">Others</label>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
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
    {{-- End Modal Tambah --}}
@endsection
