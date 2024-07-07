@extends('layout.main')

@section('css')
    <style>
        #scroll-horizontal thead th {
            border-bottom: 1px solid #ddd;
            /* Garis bawah untuk header */
        }

        #scroll-horizontal tbody td {
            border-right: 1px solid #ddd;
            /* Garis kanan untuk sel dalam tabel */
        }

        #scroll-horizontal tbody tr:last-child td {
            border-bottom: 1px solid #ddd;
            /* Garis bawah untuk baris terakhir */
        }
    </style>
@endsection

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
                    <div class="card bg-marketplace d-flex">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Table {{ $title }}</h5>
                            {{-- <div style="float: right;">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalgrid">
                                    <i class="ri-book-mark-fill"></i> Tambah Data Jadwal
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#importExcel">
                                    <i class=" ri-file-excel-fill"></i> Upload Excel
                                </button>
                            </div> --}}
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
                                        {{-- <th>Jangka Waktu</th> --}}
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($jadwal as $jad)
                                        @if ($jad->tipe_jadwal == 'MCU')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#whatsapp{{ $jad->id_jadwal }}"><i
                                                            class="ri-whatsapp-line"></i></a>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>LA-{{ $jad->id_layanan }}</td>
                                                <td>MCU-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'PASSPORT')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#whatsapp{{ $jad->id_jadwal }}"><i
                                                            class="ri-whatsapp-line"></i></a>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    </button>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>LA-{{ $jad->id_layanan }}</td>
                                                <td>PA-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'BIMBINGAN')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#whatsapp{{ $jad->id_jadwal }}"><i
                                                            class="ri-whatsapp-line"></i></a>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    </button>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>LA-{{ $jad->id_layanan }}</td>
                                                <td>BM-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @elseif ($jad->tipe_jadwal == 'MANASIK')
                                            <tr class="text-center">
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#whatsapp{{ $jad->id_jadwal }}"><i
                                                            class="ri-whatsapp-line"></i></a>
                                                    <a type="button"
                                                        class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail{{ $jad->id_jadwal }}">
                                                        <i class="ri-eye-fill"></i></a>
                                                    </button>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $jad->id_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                                <td>LA-{{ $jad->id_layanan }}</td>
                                                <td>MA-{{ $jad->nomor_jadwal }}</td>
                                                <td>{{ $jad->judul_jadwal }}</td>
                                                <td>Jadwal {{ $jad->tipe_jadwal }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_mulai)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jad->tgl_selesai)->format('d M Y') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripting')
    @foreach ($jadwal as $jad)
        {{-- MODAL DELETE JADWAL --}}
        <div class="modal fade" id="delete{{ $jad->id_jadwal }}" tabindex="-1" aria-labelledby="detailModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel"><i class="ri-phone-fill"></i>Konfirmasi Penghapusan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <div class="row g-3">
                            <p class="mt-3">Yakin ingin menghapus data ini?</p>
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <a type="button" href="/data-jadwal-office/delete/{{ $jad['id_jadwal'] }}"
                                    class="btn btn-danger">Hapus</a>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL DELETE JADWAL --}}

        {{-- MODAL DETAIL JADWAL --}}
        <div class="modal fade" id="detail{{ $jad->id_jadwal }}" tabindex="-1" aria-labelledby="detialUrj">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detialUrj"><i class="ri-phone-fill"></i>
                            @if ($jad->tipe_jadwal == 'MCU')
                                Detail Jadwal No MCU-{{ $jad->nomor_jadwal }}
                            @elseif ($jad->tipe_jadwal == 'PASSPORT')
                                Detail Jadwal No PA-{{ $jad->nomor_jadwal }}
                            @elseif ($jad->tipe_jadwal == 'BIMBINGAN')
                                Detail Jadwal No BM-{{ $jad->nomor_jadwal }}
                            @else
                                Tipe Jadwal Tidak Ditemukan
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <div class="col-12">
                            <table id="scroll-horizontal"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>Tahap</th>
                                        <th>No Jadwal</th>
                                        <th>Judul</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Tempat</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @php($i = 1)
                                @foreach ($urJadwal as $urj)
                                    <tbody>
                                        <tr class="text-center">
                                            @if ($jad->tipe_jadwal == 'MCU' && $urj->nomor_jadwal == $jad->nomor_jadwal)
                                                <td>{{ $urj->tahap }}</td>
                                                <td>MCU-{{ $urj->nomor_jadwal }}</td>
                                                <td>{{ $urj->judul_mcu }}</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_mulai_mcu)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_selesai_mcu)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_mulai_mcu)->format('H:i:s') }} WIB
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_selesai_mcu)->format('H:i:s') }} WIB
                                                </td>
                                                <td>{{ $urj->tempat_mcu }}</td>
                                                <td>{{ $urj->keterangan_mcu }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $urj->id_uraian_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                            @elseif ($jad->tipe_jadwal == 'PASSPORT' && $urj->nomor_jadwal == $jad->nomor_jadwal)
                                                <td>{{ $urj->tahap }}</td>
                                                <td>PA-{{ $urj->nomor_jadwal }}</td>
                                                <td>{{ $urj->judul_passport }}</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_mulai_passport)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_selesai_passport)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_mulai_passport)->format('H:i:s') }}
                                                    WIB</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_selesai_passport)->format('H:i:s') }}
                                                    WIB</td>
                                                <td>{{ $urj->tempat_passport }}</td>
                                                <td>{{ $urj->keterangan_passport }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $urj->id_uraian_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                            @elseif ($jad->tipe_jadwal == 'BIMBINGAN' && $urj->nomor_jadwal == $jad->nomor_jadwal)
                                                <td>{{ $urj->tahap }}</td>
                                                <td>BM-{{ $urj->nomor_jadwal }}</td>
                                                <td>{{ $urj->judul_bimbingan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_mulai_bimbingan)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_selesai_bimbingan)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_mulai_bimbingan)->format('H:i:s') }}
                                                    WIB</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_selesai_bimbingan)->format('H:i:s') }}
                                                    WIB</td>
                                                <td>{{ $urj->tempat_bimbingan }}</td>
                                                <td>{{ $urj->keterangan_bimbingan }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $urj->id_uraian_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                            @elseif ($jad->tipe_jadwal == 'MANASIK' && $urj->nomor_jadwal == $jad->nomor_jadwal)
                                                <td>{{ $urj->tahap }}</td>
                                                <td>BM-{{ $urj->nomor_jadwal }}</td>
                                                <td>{{ $urj->judul_manasik }}</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_mulai_manasik)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->tgl_selesai_manasik)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_mulai_manasik)->format('H:i:s') }}
                                                    WIB</td>
                                                <td>{{ \Carbon\Carbon::parse($urj->jam_selesai_manasik)->format('H:i:s') }}
                                                    WIB</td>
                                                <td>{{ $urj->tempat_manasik }}</td>
                                                <td>{{ $urj->keterangan_manasik }}</td>
                                                <td>
                                                    <a type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $urj->id_uraian_jadwal }}"><i
                                                            class="ri-delete-bin-2-fill"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <div class="row g-3">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL DETAIL JADWAL --}}

        @foreach ($urJadwal as $urj)
            {{-- MODAL DELETE URAIAN JADWAL --}}
            <div class="modal fade" id="delete{{ $urj->id_uraian_jadwal }}" tabindex="-1"
                aria-labelledby="detailModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel"><i class="ri-phone-fill"></i>Konfirmasi
                                Penghapusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-marketplace d-flex">
                            <div class="row g-3">
                                <p class="mt-3">Yakin ingin menghapus data uraian jadwal ini?</p>
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <a type="button"
                                        href="/data-uraian-jadwal-office/delete/{{ $urj['id_uraian_jadwal'] }}"
                                        class="btn btn-danger">Hapus</a>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END MODAL DELETE URAIAN JADWAL --}}
        @endforeach
        <div class="modal fade" id="whatsapp{{ $jad->id_jadwal }}" tabindex="-1"
            aria-labelledby="exampleModalgridLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalgridLabel">Proses Kirim Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-marketplace d-flex">
                        <form action="{{ route('office.whatsapp', $jad->id_jadwal) }}" id="formWhatsapp" method="POST">
                            @csrf
                            <input value="{{ $jad->id_layanan }}" type="hidden" name="id_layanan">
                            <input value="{{ $jad->nomor_jadwal }}" type="hidden" name="nomor_jadwal">
                            <input value="{{ $jad->tipe_jadwal }}" type="hidden" name="tipe_jadwal">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div>
                                        <label for="nama_role" class="form-label">Pilih Grup</label>
                                        <select name="kode_grup" class="form-select border border-dark" required>
                                            <option selected disabled>-- Pilih Grup --</option>
                                            @foreach ($grup as $g)
                                                @if ($g->id_layanan == $jad->id_layanan)
                                                    <option value="{{ $g->kode_grup }}">
                                                        {{ $g->kode_grup }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <label for="nama_role" class="form-label">Pilih Tahap</label>
                                        <select name="tahap" class="form-select border border-dark" required>
                                            <option selected disabled>-- Pilih Tahap --</option>
                                            @foreach ($urJadwal as $u)
                                                @if ($u->nomor_jadwal == $jad->nomor_jadwal)
                                                    <option value="{{ $u->tahap }}">
                                                        {{ $u->tahap }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="btn-whatsapp-{{ $jad->id_jadwal }}"
                                            class="btn btn-primary">Kirim Whatsapp</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('btn-whatsapp-{{ $jad->id_jadwal }}').addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        html: `
                         <center>
                            <lottie-player src="https://lottie.host/c68dc8b2-2eee-461c-9191-e760770816c1/CH1teS0p92.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
                            </lottie-player>
                        </center>
                    <br>
                    <h4 class="h4 text-danger">Sedang menghubungkan ke WhatsApp, mohon menunggu.</h4>
                    `,
                        showConfirmButton: false,
                        showCancelButton: false,
                        allowOutsideClick: false
                    });

                    // Simulate form submission after showing the loading animation
                    setTimeout(function() {
                        document.getElementById('formWhatsapp')
                            .submit(); // Submit the form using POST method
                    }, 3000); // Adjust the timeout duration as needed

                    setTimeout(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pesan telah berhasil terkirim ke WhatsApp',
                            text: "{{ session()->get('success') }}",
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                    }, 6000);
                });
            });
        </script>
    @endforeach
@endsection
@endsection
