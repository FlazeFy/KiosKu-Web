<div class="modal fade" id="tambah-karyawan-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/karyawan/data/tambah_karyawan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <img id="frame" src="{{asset('assets/img/icons/default_avatar.png')}}" class="img-fluid d-block mx-auto" style="width:150px; height:150px; border-radius:100%;"/>
                            <a class="text-white">Foto Profil</a>
                            <div class="row">
                                <div class="col-md-8">
                                    <input class="form-control" type="file" id="formFileAddKaryawan" onchange="previewCreateAcc()" name="image_url" accept="image/png, image/jpg, image/jpeg">
                                </div>
                                <div class="col-md-4">
                                    <a onclick="clearImageCreateAcc()" style="width:120px;" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i> Reset</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="nama_karyawan" required>
                                <label for="floatingInput">Nama Panggilan</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="nama_lengkap_karyawan" required>
                                <label for="floatingInput">Nama Lengkap</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="email_karyawan" required>
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="ponsel_karyawan" required>
                                <label for="floatingInput">Ponsel</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="jabatan_karyawan" required>
                                <label for="floatingInput">Jabatan</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="gaji_karyawan" required>
                                <label for="floatingInput">Gaji (Rp.)</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <div class="form-floating mb-2">
                                <select class="form-select" id="floatingSelectGrid" name="status_karyawan">
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                                <label for="floatingInput">Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //Image upload preview.
    function previewCreateAcc() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImageCreateAcc() {
        document.getElementById('formFileAddKaryawan').value = null;
        frame.src = "{{asset('assets/img/icons/default_avatar.png')}}";
    }
</script>