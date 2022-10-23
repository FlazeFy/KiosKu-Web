<div class="card shadow my-3">
    <h6 class="card-header text-white" style="background:#676AFB;">ID : {{$ak->id}}</h6>
    <!-- Account -->
    <div class="card-body p-4">
        <form method="POST" action="/profil/edit_foto"  id="formImage" enctype="multipart/form-data">
        @csrf
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                @if($ak->kios_image_url == null)
                    <img id="frame" src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" height="100" width="100" class="img img-avatar rounded-circle shadow"/>
                @else
                    <img id="frame" src="{{url('storage/'.$ak->kios_image_url)}}" alt="{{$ak->kios_image_url}}.png" height="100" width="100" class="img img-avatar rounded-circle shadow"/>
                @endif
                <div class="image-upload" id="formFileEditAcc" onchange="previewEditAcc()">
                    <label for="file-input">
                        <a class="btn btn-primary text-white">Ganti Foto</a>
                    </label>
                    <input id="file-input" type="file" name="image_url"/>
                </div>
            </form>
            @if($ak->kios_image_url != null)
                <form method="POST" action="/profil/reset_foto">
                    @csrf
                    <button class="btn btn-danger" type="submit"><i class="bx bx-reset d-block d-sm-none"></i> Reset</button>
                </form>
            @endif
            <p class="text-muted mb-0">Format gambar <b>JPG, GIF</b> or <b>PNG</b>. Ukuran maksimal <b>5 mb</b></p>
        </div>
    </div>
    <hr class="my-0" style="background:#212121;"/>
    <div class="card-body p-4">
        <form method="POST" action="profil/edit">
            @csrf
            <input name="username_old" value="{{$ak->username}}" hidden>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="username" class="form-control" name="username" value="{{$ak->username}}" required>
                        <label for="floatingInput">Username</label>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="password" value="{{$ak->password}}" required>
                        <label for="floatingInput">Password</label>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="nama_kios" value="{{$ak->nama_kios}}" required>
                        <label for="floatingInput">Nama Kios</label>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="address" class="form-control" name="alamat_kios" value="{{$ak->alamat_kios}}">
                        <label for="floatingInput">Alamat</label>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="phone" class="form-control" name="kontak_kios" value="{{$ak->kontak_kios}}">
                        <label for="floatingInput">Kontak</label>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="email_kios" value="{{$ak->email_kios}}" required>
                        <label for="floatingInput">Email</label>
                    </div>
                </div>
                <div class="mb-3 col-md-12">
                    <div class="form-floating mb-2">
                        <textarea class="form-control" value="{{$ak->deskripsi_kios}}" name="deskripsi_kios" id="floatingTextarea2" style="height: 100px">{{$ak->deskripsi_kios}}</textarea>
                        <label for="floatingTextarea2">Deskripsi</label>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success border-0"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>          
            </div>
        </form> 
    </div>
</div>
