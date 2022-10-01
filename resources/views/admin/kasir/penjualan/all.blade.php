<style>
    li {
        list-style-type: none;
    }
</style>

<div class="row">
    @foreach($kasir as $ks)
        <li class="col-lg-6 col-md-6 col-sm-12 p-2">
            <div class="card shadow mb-4">
                <h6 class="card-header text-white" style="background:#676AFB;">ID : {{$ks->id}}</h6>
                <!-- Account -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-7 col-md- col-sm-12">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" name="nama_kasir" value="{{$ks->nama_kasir}}" required>
                                    <label for="floatingInput">Nama Kasir</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" name="deskripsi_kasir" style="height:100px;" value="{{$ks->deskripsi_kasir}}">{{$ks->deskripsi_kasir}}</textarea>
                                    <label for="floatingInput">Deskripsi Kasir</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <form method="POST" action="">
                                @csrf
                                <h6 class="text-primary">Karyawan</h6>
                            </form>
                        </div>
                    </div><hr>
                    <h6 class="text-primary">Riwayat Transaksi</h6>
                </div>
                <hr class="my-0" style="background:#212121;"/>
                <div class="card-body p-3">
                    
                    <div class="mt-2">
                        <a class="btn btn-danger border-0 text-white float-end mt-2" data-bs-target="#hapus-kasir-Modal-{{$ks->id}}" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Hapus</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-print"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</div>