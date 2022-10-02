<style>
    li {
        list-style-type: none;
    }
</style>

<div class="row">
    @foreach($kasir as $ks)
        @php($status_bg = "")
        @if($ks->id_context != null)
            @php($status_bg = "background:rgba(105, 122, 255, 0.15);")
        @endif
        <li class="col-lg-6 col-md-6 col-sm-12 p-2">
            <div class="card shadow mb-4" style="{{$status_bg}}">
                <h6 class="card-header text-white" style="background:#676AFB;">ID : {{$ks->id}} <span class="float-end" style="font-size:14px;"> Diedit pada: {{date('y/m/d h:i' , strtotime($ks->updated_at))}}</span></h6>
                <!-- Account -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-7 col-md- col-sm-12">
                            <form method="POST" action="/kasir/penjualan/edit_kasir/{{$ks->id}}">
                                @csrf
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" name="nama_kasir" value="{{$ks->nama_kasir}}" onblur="this.form.submit()" required>
                                    <label for="floatingInput">Nama Kasir</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" name="deskripsi_kasir" style="height:100px;" value="{{$ks->deskripsi_kasir}}" onblur="this.form.submit()">{{$ks->deskripsi_kasir}}</textarea>
                                    <label for="floatingInput">Deskripsi Kasir</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <h6 class="text-primary">Karyawan</h6>
                            @include('admin.kasir.penjualan.karyawan')
                        </div>
                    </div><hr>
                    <h6 class="text-primary">Riwayat Transaksi</h6>
                    @include('admin.kasir.penjualan.riwayat')
                </div>
                <hr class="my-0" style="background:#212121;"/>
                <div class="card-body p-3">
                    <div class="mt-2">
                        <div class="btn">
                            @if($ks->id_context != null)
                                <form action="/kasir/penjualan/unpin/{{$ks->id_tandai}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary py-1 bg-white" style="color:#676AFA; border:2px solid #676AFA;"><i class="fa-solid fa-thumbtack"></i> Lepaskan</button>
                                </form>
                            @else
                                <form action="/kasir/penjualan/pin/{{$ks->id}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                                </form>
                            @endif
                        </div>
                        <a class="btn btn-danger border-0 text-white float-end mt-2" data-bs-target="#hapus-kasir-Modal-{{$ks->id}}" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Hapus</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-print"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </li>

        <!--Modal-->
        @include('admin.kasir.penjualan.form.add_karyawan')
        @include('admin.kasir.penjualan.form.delete')
    @endforeach
</div>