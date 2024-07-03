@extends('layout.main')
@section('content')
    @include('components.alerts')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ $judul }}</h4>
                        <div class="page-title-right">
                            <div class="d-flex align-items-center">
                                <!-- Button-tabs -->
                                <ul class="nav">
                                    <a href="#tabs-mcu"
                                        class="active nav-link btn btn-danger d-none d-sm-inline-block border border-primary text-white"
                                        data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1"
                                        style="margin-right: 10px">
                                        <i class="fa-solid fa-list-ul"></i> DATA JADWAL
                                    </a>
                                    {{-- <a href="#tabs-passport"
                                        class="nav-link btn btn-danger d-none d-sm-inline-block border border-primary text-white"
                                        data-bs-toggle="tab" aria-selected="false" role="tab"
                                        style="margin-right: 10px">
                                        <i class="fa-solid fa-hand-holding-medical"></i> PASSPORT
                                    </a>
                                    <a href="#tabs-bimbingan"
                                        class="nav-link btn btn-info d-none d-sm-inline-block border border-primary text-white"
                                        data-bs-toggle="tab" aria-selected="false" role="tab"
                                        style="margin-right: 10px">
                                        <i class="fa-solid fa-hand-holding-medical"></i> BIMBINGAN
                                    </a>
                                    <a href="#tabs-manasik"
                                        class="nav-link btn btn-secondary d-none d-sm-inline-block border border-primary text-white"
                                        data-bs-toggle="tab" aria-selected="false" role="tab"
                                        style="margin-right: 10px">
                                        <i class="fa-solid fa-hand-holding-medical"></i> MANASIK HAJI
                                    </a> --}}


                                </ul>
                                <!-- Button untuk tambah data biodata -->
                                <button type="button" class="btn btn-success waves-effect waves-light ms-3"
                                    data-bs-toggle="modal" data-bs-target="#import">
                                    <i class="ri-file-excel-line"></i> IMPORT JADWAL
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tabs-mcu" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <!-- Content for View Profile tab -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-marketplace d-flex">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Table {{ $judul }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <table id="scroll-horizontal"
                                                        class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                                        style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>No</th>
                                                                <th>Opsi</th>
                                                                <th>No Layanan</th>
                                                                <th>No Jadwal</th>
                                                                <th>Judul Jadwal</th>
                                                                <th>Tipe Jadwal</th>
                                                                <th>Tanggal Mulai</th>
                                                                <th>Tanggal Selesai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php($i = 1)
                                                            @foreach ($jadwal as $jad)
                                                                <tr class="text-center">
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>
                                                                        <a type="button"
                                                                            class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                                            <i class="ri-eye-fill"></i>
                                                                        </a>
                                                                        <a type="button"
                                                                            class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete{{ $jad->id_jadwal }}">
                                                                            <i class="ri-delete-bin-2-fill"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td>LA-{{ $jad->id_layanan }}</td>
                                                                    <td>{{ strtoupper(substr($jad->tipe_jadwal, 0, 2)) }}-{{ $jad->nomor_jadwal }}
                                                                    </td>
                                                                    <td>{{ $jad->judul_jadwal }}</td>
                                                                    <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}
                                                                    </td>
                                                                    <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}
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
                                {{-- <div class="tab-pane fade" id="tabs-passport" role="tabpanel" aria-labelledby="table-tab">
                                    <!-- Content for View Table tab -->
                                    <h1>passport</h1>
                                </div>
                                <div class="tab-pane fade" id="tabs-bimbingan" role="tabpanel" aria-labelledby="table-tab">
                                    <!-- Content for View Table tab -->
                                    <h1>bimbingan</h1>
                                </div>
                                <div class="tab-pane fade" id="tabs-manasik" role="tabpanel" aria-labelledby="table-tab">
                                    <!-- Content for View Table tab -->
                                    <h1>manasik</h1>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Import Excel --}}
    <div class="modal modal-blur fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="formImport" action="{{ route('import.office') }}?proses=upload_jadwal"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Excel Data Jadwal/Layanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-check-input" type="hidden" name="type" id="type1" value="add">
                        <div class="mb-3">
                            <label class="form-label">Pilih file excel (xlsx)</label>
                            <input type="file" name="file" required="required" accept=".xlsx" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ asset('doc/jadwal/TEMPLATE-JADWAL.xlsx') }}" class="btn btn-link link-secondary"
                            download>Download Contoh Excel</a>
                        <button type="submit" id="btn-import" class="btn btn-primary ms-auto"><i
                                class="ri-upload-cloud-line" style="margin-right:5px"></i> Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal IMport Excel --}}

    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/pages/sweetalerts.init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
    <script>
        document.getElementById('btn-import').addEventListener('click', function(e) {
            e.preventDefault();
            swal.fire({
                icon: 'info',
                html: `
                <center>
                    <lottie-player src="https://lottie.host/21d80ff7-b90a-4369-92df-57e25f70f139/sjHvF8uMTg.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
                    </lottie-player>
                </center>
                <br>
                <h4 class="h4 text-danger">Sedang melakukan import data, mohon menunggu.</h4>
            `,
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: false
            });

            // Simulate form submission after showing the loading animation
            setTimeout(function() {
                document.getElementById('formImport').submit(); // Submit the form using POST method
            }, 3000); // Adjust the timeout duration as needed

            setTimeout(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Import jadwal berhasil di import',
                    text: "{{ session()->get('success') }}",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000, // corrected time to timer
                    timerProgressBar: true, // corrected timeProgressBar to timerProgressBar
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal
                            .resumeTimer); // corrected second mouseenter to mouseleave
                    }
                });
            }, 6000);
        });
    </script>
@endsection
