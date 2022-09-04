<style>
    #uploadedAvatar{
        border-radius:100px !important;
    }
</style>

<li class="card shadow mb-4 data-item filter-{{str_replace(' ', '', $kr->jabatan_karyawan)}}">
    <h6 class="card-header text-white" style="background:#676AFB;">ID : {{$kr->id}} <span class="float-end"> Nama Lengkap: {{$kr->nama_lengkap_karyawan}}</span></h6>
    <!-- Account -->
    <div class="card-body p-4">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            @if($kr->karyawan_image_url == "null")
                <img src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
            @else
                <img src="{{url('storage/'.$kr->karyawan_image_url)}}" alt="{{$kr->karyawan_image_url}}.png" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
            @endif
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

                <p class="text-muted mb-0">Format gambar <b>JPG, GIF</b> or <b>PNG</b>. Ukuran maksimal <b>5 mb</b></p>
            </div>
        </div>
    </div>
    <hr class="my-0" style="background:#212121;"/>
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
                    <input type="text" class="form-control" name="email_karyawan" value="{{$kr->email_karyawan}}" required>
                    <label for="floatingInput">Email</label>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="ponsel_karyawan" value="{{$kr->ponsel_karyawan}}" required>
                    <label for="floatingInput">Ponsel</label>
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
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </div>
</li>