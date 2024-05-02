{{-- Modal Import Excel --}}
<div class="modal modal-blur fade" id="importExcel" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <form method="post" action="{{ route('import') }}?proses=upload_jadwal" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Excel Data Jadwal/Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Pilih Type Proses</label>
                    <div class="col-lg-4 col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type1"
                                        value="add">
                                    <label class="form-check-label" for="type1">
                                        Add
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type2"
                                        value="update">
                                    <label class="form-check-label" for="type2">
                                        Update
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih file excel (xlsx)</label>
                    <input type="file" name="file" required="required" accept=".xlsx"
                        class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-link link-secondary">Download Contoh Excel</a>
                <button type="submit" class="btn btn-primary ms-auto"><i class="ri-upload-cloud-line"
                        style="margin-right:5px"></i> Import</button>
            </div>
        </div>
    </form>
</div>
</div>
{{-- End Modal IMport Excel --}}