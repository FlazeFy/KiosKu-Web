<style>
    #uploadedAvatar{
        border-radius:100px !important;
    }
    .image-upload>input {
        display: none;
    }
</style>

@php($status_bg = "")
@php($status_filter = "")
@if(($kr->id_context != null)&&($kr->status_karyawan == "aktif"))
    @php($status_bg = "background:rgba(105, 122, 255, 0.15);")
    @php($status_filter = "filter-tandai")
@endif
<li class="card shadow mb-4 data-item filter-{{str_replace(' ', '', $kr->jabatan_karyawan)}} {{$status_filter}}" style="{{$status_bg}}">
    <h6 class="card-header text-white" style="background:#676AFB;">ID : {{$kr->id}} <span class="float-end"> Nama Lengkap: {{$kr->nama_lengkap_karyawan}}</span></h6>
    <!-- Account -->
    <div class="card-body p-4">
        <form method="POST" action="/karyawan/data/edit_foto/{{$kr->id}}"  id="formImage{{$kr->id}}" enctype="multipart/form-data">
        @csrf
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                @if($kr->karyawan_image_url == "null")
                    <img id="frame{{$kr->id}}" src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" height="100" width="100" class="img img-avatar rounded-circle shadow"/>
                @else
                    <img id="frame{{$kr->id}}" src="{{url('storage/'.$kr->karyawan_image_url)}}" alt="{{$kr->karyawan_image_url}}.png" height="100" width="100" class="img img-avatar rounded-circle shadow"/>
                @endif
                <div class="image-upload" id="formFileEditAcc{{$kr->id}}" onchange="previewEditAcc<?php echo $kr->id; ?>()">
                    <label for="file-input{{$kr->id}}">
                        <a class="btn btn-primary text-white">Ganti Foto</a>
                    </label>
                    <input id="file-input{{$kr->id}}" type="file" name="image_url"/>
                </div>
            </form>
            <button class="btn btn-danger"><i class="bx bx-reset d-block d-sm-none"></i> Reset</button>
            <p class="text-muted mb-0">Format gambar <b>JPG, GIF</b> or <b>PNG</b>. Ukuran maksimal <b>5 mb</b></p>
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
            <a class="btn btn-danger border-0 text-white float-end mt-2" data-bs-target="#hapus-karyawan-Modal-{{$kr->id}}" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Hapus</a>
            <button type="submit" class="btn btn-success border-0"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </form>
            <div class="btn">
            @if($kr->id_context != null)
                <form action="/karyawan/data/unpin/{{$kr->id_tandai}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary py-1 bg-white" style="color:#676AFA; border:2px solid #676AFA;"><i class="fa-solid fa-thumbtack"></i> Lepaskan</button>
                </form>
            @else
                <form action="/karyawan/data/pin/{{$kr->id}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                </form>
            @endif
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-print"></i> Cetak</button>
        </div>
    </div>
</li>