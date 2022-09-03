<div class="card mb-4">
    <h5 class="card-header">ID : {{$kr->id}}</h5>
    <!-- Account -->
    <div class="card-body p-4">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
            <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Ganti Foto</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg"/>
                </label>
                <button type="button" class="btn btn-danger account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                </button>

                <p class="text-muted mb-0">Format gambar JPG, GIF or PNG. Ukuran maksimal 5 mb</p>
            </div>
        </div>
    </div>
    <hr class="my-0" />
    <div class="card-body p-4">
        <form method="POST" action="/karyawan/data/edit_karyawan/{{$kr->id}}">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="nama_karyawan" value="{{$kr->nama_karyawan}}" required>
                    <label for="floatingInput">Nama Panggilan</label>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="nama_lengkap_karyawan" value="{{$kr->nama_lengkap_karyawan}}" required>
                    <label for="floatingInput">Nama Lengkap</label>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="jabatan_karyawan" value="{{$kr->jabatan_karyawan}}" required>
                    <label for="floatingInput">Jabatan</label>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="form-floating mb-2">
                    <input type="number" class="form-control" name="gaji_karyawan" value="{{$kr->gaji_karyawan}}" required>
                    <label for="floatingInput">Gaji (Rp.)</label>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="form-floating mb-2">
                    <select class="form-select" id="floatingSelectGrid" name="status_karyawan">
                        <option <?php if($kr->status_karyawan == "aktif"){echo " selected ";} ?> value="aktif">Aktif</option>
                        <option <?php if($kr->status_karyawan == "non-aktif"){echo " selected ";} ?> value="non-aktif">Non-Aktif</option>
                    </select>
                    <label for="floatingInput">Status</label>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <a class="btn btn-danger border-0 text-white float-end" data-bs-target="#hapus-karyawan-Modal-{{$kr->id}}" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Hapus</a>
            <button type="submit" class="btn btn-success border-0"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </form>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
        </div>
    </div>
</div>