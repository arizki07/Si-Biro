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
                                Tambah Data Transaksi
                            </button>
                        </div>
                        <div class="card-body">
                            <style>
                                #scroll-horizontal thead th {
                                    border-bottom: 1px solid #ddd;
                                }

                                #scroll-horizontal tbody td {
                                    border-right: 1px solid #ddd;
                                }

                                #scroll-horizontal tbody tr:last-child td {
                                    border-bottom: 1px solid #ddd;
                                }
                            </style>
                            <table id="scroll-horizontal"
                                class="display table table-vcenter card-table table-sm table-striped table-bordered table-hover text-nowrap"
                                style="width:100%; font-family: 'Trebuchet MS', Helvetica, sans-serif;">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama Jamaah</th>
                                        <th>Layanan</th>
                                        <th>Tipe Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Foto Bukti Pembayaran</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td><?= $i++ ?></td>
                                            <td>{{ $item->jamaah->nama_lengkap }}</td>
                                            <td>{{ $item->layanan->judul_layanan }}</td>
                                            <td>{{ $item->tipe_pembayaran }}</td>
                                            <td>{{ $item->jumlah_pembayaran }}</td>
                                            <td>{{ $item->status_pembayaran }}</td>
                                            <td>{{ $item->tanggal_pembayaran }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailTrans{{ $item->id_transaksi }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailTrans{{ $item->id_transaksi }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-outline-success btn-icon waves-effect waves-light btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id_transaksi }}"><i
                                                        class=" ri-edit-2-fill"></i></button>
                                                <form method="POST"
                                                    action="{{ route('destroy.trans', $item->id_transaksi) }}"
                                                    id="delete-form" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-icon waves-effect waves-light btn-sm"
                                                        onclick="btnDelete()">
                                                        <i class="ri-delete-bin-2-fill"></i>
                                                    </button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel"><i class=" ri-user-add-fill"> Tambah Transaksi</i>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="createForm" action="{{ route('store.trans') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="card-stamp card-stamp-lg">
                                <div class="card-stamp-icon bg-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Jamaah</label>
                                <select name="id_jamaah" id="id_jamaah" class="form-select border border-dark">
                                    <option value="" hidden>-- Pilih Jamaah --</option>
                                    @foreach ($jamaahs as $jamaah)
                                        <option value="{{ $jamaah->id_jamaah }}"
                                            {{ old('id_jamaah') == $jamaah->id_jamaah ? 'selected' : '' }}>
                                            {{ $jamaah->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Layanan</label>
                                <select name="id_layanan" id="id_layanan" class="form-select border border-dark">
                                    <option value="" hidden>-- Pilih Layanan --</option>
                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id_layanan }}">{{ $layanan->judul_layanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipe Pembayaran</label>
                                <select name="tipe_pembayaran" id="tipe_pembayaran" class="form-select border border-dark">
                                    <option value="" hidden>-- Pilih Pembayaran --</option>
                                    <option value="cash">Cash</option>
                                    <option value="tranfer">Tranfer</option>
                                    <option value="agen">Agen</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input type="date" id="tanggal_pembayaran"
                                    class="form-control border border-dark bg-secondary-lt" name="tanggal_pembayaran"
                                    value="{{ old('tanggal_pembayaran') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input type="text" id="jumlah_pembayaran"
                                    class="form-control border border-dark bg-secondary-lt" name="jumlah_pembayaran"
                                    value="{{ old('jumlah_pembayaran') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bukti Pembayaran</label>
                                <input type="file" class="form-control border border-dark"
                                    name="foto_bukti_pembayaran" id="foto_passport">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    {{-- Modal edit --}}
    @foreach ($data as $trans)
        <div class="modal fade" id="editModal{{ $trans->id_transaksi }}" tabindex="-1"
            aria-labelledby="editModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><i class=" ri-user-add-fill"> Tambah Data
                                Jamaah</i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('update.trans', $trans->id_transaksi) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Jamaah</label>
                                    <select name="id_jamaah" id="id_jamaah" class="form-select border border-dark">
                                        <option value="" hidden>-- Pilih Jamaah --</option>
                                        @foreach ($jamaahs as $jamaah)
                                            <option value="{{ $jamaah->id_jamaah }}"
                                                {{ $jamaah->id_jamaah == old('id_jamaah', $trans->id_jamaah) ? 'selected' : '' }}>
                                                {{ $jamaah->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Layanan</label>
                                    <select name="id_layanan" id="id_layanan" class="form-select border border-dark">
                                        <option value="" hidden>-- Pilih Layanan --</option>
                                        @foreach ($layanans as $layanan)
                                            <option value="{{ $layanan->id_layanan }}"
                                                {{ $layanan->id_layanan == old('id_layanan', $trans->id_layanan ?? '') ? 'selected' : '' }}>
                                                {{ $layanan->judul_layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tipe Pembayaran</label>
                                    <select name="tipe_pembayaran" id="tipe_pembayaran"
                                        class="form-select border border-dark">
                                        <option value="" hidden>-- Pilih Pembayaran --</option>
                                        <option value="cash"
                                            {{ 'cash' == old('tipe_pembayaran', $trans->tipe_pembayaran ?? '') ? 'selected' : '' }}>
                                            Cash
                                        </option>
                                        <option value="transfer"
                                            {{ 'transfer' == old('tipe_pembayaran', $trans->tipe_pembayaran ?? '') ? 'selected' : '' }}>
                                            Transfer
                                        </option>
                                        <option value="agen"
                                            {{ 'agen' == old('tipe_pembayaran', $trans->tipe_pembayaran ?? '') ? 'selected' : '' }}>
                                            Agen
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                    <input type="date" id="tanggal_pembayaran"
                                        class="form-control border border-dark bg-secondary-lt" name="tanggal_pembayaran"
                                        value="{{ $trans->tanggal_pembayaran }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Pembayaran</label>
                                    <input type="text" id="jumlah_pembayaran"
                                        class="form-control border border-dark bg-secondary-lt" name="jumlah_pembayaran"
                                        value="{{ $trans->jumlah_pembayaran }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bukti Pembayaran</label>
                                    <input type="hidden" name="oldFoto" value="{{ $trans->foto_bukti_pembayaran }}">
                                    @if ($trans->foto_bukti_pembayaran)
                                        <img src="{{ asset('storage/transaksi/foto-bukti/' . $trans->foto_bukti_pembayaran) }}"
                                            class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                    @endif

                                    <input type="file" class="form-control border border-dark"
                                        name="foto_bukti_pembayaran" id="foto" onchange="previewImage()">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal"><i
                                        class="fa-solid fa-fw fa-arrow-rotate-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}

    <script>
        function formatRupiah(value) {
            let numberString = value.replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            // Tambahkan tanda titik jika ada angka ribuan
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }

        // Event listener untuk format input saat engetik
        document.getElementById("jumlah_pembayaran").addEventListener("input", function() {
            let formattedValue = formatRupiah(this.value);
            this.value = formattedValue;
        });

        function logFormData(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            const form = event.target; // Get the form element
            const formData = new FormData(form); // Create FormData from the form

            // Log all form data in the console
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            // Submit the form after logging
            form.submit(); // Now submit the form
        }

        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }

        // $("#createForm").submit(function(e) {
        //     e.preventDefault();

        //     var formData = $(this).serialize();

        //     $.ajax({
        //         url: $(this).attr("action"),
        //         type: "POST",
        //         data: formData,
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
        //             "Authorization": "Bearer " + parsedObj.token.access_token
        //         },
        //         success: function(response) {
        //             console.log('berhasil han');
        //             console.log(response);
        //             swal("Info", "Data Berhasil disimpan.", "success");
        //             $('#createForm')[0].reset();
        //         },
        //         error: function(error) {
        //             console.error(error);
        //             swal("Gagal Menyimpan Data.");
        //         },
        //     });

        // });
    </script>
@endsection
