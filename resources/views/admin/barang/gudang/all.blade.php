<style>
    .barang #barang-flters {
        list-style: none;
        margin-bottom: 20px;
    }
    .barang #barang-flters li {
        cursor: pointer;
        display: inline-block;
        margin: 0 10px 10px 0;
        font-size: 18px;
        line-height: 1;
        padding: 10px;
        text-align: center;
        transition: all 0.3s ease-in-out;
        border: 2px solid #676AFB;
        border-radius:6px;
    }
    .barang #barang-flters li:hover, .barang #barang-flters li.filter-active {
        color: white;
        background: #676AFB;
    }
    .barang-item{
        margin-top:20px;
    }
    .headerBox{
        background-position: center;
        background-repeat:no-repeat;
        position: relative;
        background-size: cover;
        background-color: black;
        height:200px;
        border-radius: 20px 20px 0px 0px;
    }
    .image-upload>input {
        display: none;
    }
</style>

<ul id="barang-flters" class="d-flex">
    <li data-filter="*" class="filter-active shadow">Semua</li>
    <li data-filter=".filter-tandai" class="shadow">Di Tandai</li>
    <li data-filter=".filter-kosong" class="shadow">Stok Habis</li>
    @foreach($kategori as $kb)
        <li data-filter=".filter-{{str_replace(' ', '', $kb->nama_kategori)}}" class="shadow">{{$kb->nama_kategori}}</li>
    @endforeach
</ul>

<form method='POST' action='/barang/gudang/tambah_barang' enctype='multipart/form-data'> 
    @csrf
    @include('admin.barang.gudang.form.tambah_barang')
    <div class="row" id="barang_holder"></div>
</form>  

<div class="row barang-container">
    @foreach($barang as $brg)
        <!--Initial variable-->
        @php($status_bg = "")
        @php($status_filter = "")
        @php($status_filter_2 = "")

        <!--Check if item is pinned.-->
        @if($brg->id_context != null)
            @php($status_bg = "background:rgba(105, 122, 255, 0.15);")
            @php($status_filter = "filter-tandai")
        @endif

        <!--Check if item is pinned.-->
        @if($brg->stok_barang == 0)
            @php($status_bg = "background:rgba(217, 83, 79, 0.25);")
            @php($status_filter_2 = "filter-kosong")
        @endif
        <div class="col-lg-4 col-md-6 barang-item filter-{{str_replace(' ', '', $brg->kategori_barang)}} {{$status_filter}} {{$status_filter_2}}">
            <div class="container-fluid p-0 shadow" style="{{$status_bg}} border-radius: 20px;">
                <form method="POST" action="/barang/gudang/edit_gambar/{{$brg->id}}"  id="formImage{{$brg->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header w-100 p-4 position-relative headerBox" style=" 
                        <?php
                            if($brg->image_url_barang != null){
                                echo "background-image: linear-gradient(rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.75)), url('http://127.0.0.1:8000/storage/".$brg->image_url_barang."');";
                            } else {
                                echo "background-image: linear-gradient(rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.75)), url('http://127.0.0.1:8000/storage/default_image.png');";
                            }
                        ?>
                        ">
                    <div class="image-upload" id="formFileEditAcc{{$brg->id}}" onchange="previewEditAcc<?php echo $brg->id; ?>()">
                        <label class="btn btn-transparent position-absolute text-white" style="top:5px; right:15px;" title="Change Image" for="file-input{{$brg->id}}">
                            <i class="fa-solid fa-camera fa-lg"></i></label>
                        <input id="file-input{{$brg->id}}" type="file" name="image_url"/>
                    </div>
                </form>
                    <h6 class="text-white position-absolute" style="bottom:0px; right:15px;">{{$brg->kategori_barang}}</h6>
                    <h5 class="text-white position-absolute" style="bottom:0px;">{{$brg->nama_barang}}</h5>
                </div>
                <!-- <img class="img img-fluid rounded w-100" src="{{$brg->image_url_barang}}"> -->
                <div class="card-body">
                    <form action="/barang/gudang/edit_barang/{{$brg->id}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-primary">Harga Stok</h6>
                                <h6>Rp. {{$brg->harga_stok}}</h6>
                                <h6 class="text-primary">Harga Jual</h6>
                                <h6>Rp. {{$brg->harga_jual}}</h6>
                            </div>  
                            <div class="col-8">
                                <h6 class="text-primary">Deskripsi</h6>
                                <textarea class="form-control desc-edit" name="deskripsi_barang" value="{{$brg->deskripsi_barang}}" onblur="this.form.submit()">{{$brg->deskripsi_barang}}</textarea>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-4">
                                <div class="form-floating mb-2">
                                    <input class="form-control num-edit" type="number" name="stok_barang" value="{{$brg->stok_barang}}" min="0" onblur="this.form.submit()">
                                    <label for="floatingInput">Stok</label>
                                </div>
                            </div>  
                            <div class="col-8">
                                <div class="form-floating mb-2">
                                    <input class="form-control" onblur="this.form.submit()" type="date" name="expired_at" value="<?php 
                                        if($brg->expired_at != null){
                                            echo date('Y-m-d', strtotime($brg->expired_at));
                                        } else {
                                            echo "";
                                        }
                                    ?>">
                                    <label for="floatingInput">Tanggal Expired</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-harga-Modal-{{$brg->id}}"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    <div class="btn">
                        @if($brg->id_context != null)
                            <form action="/barang/gudang/unpin/{{$brg->id_tandai}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary py-1 bg-white" style="color:#676AFA; border:2px solid #676AFA;"><i class="fa-solid fa-thumbtack"></i> Lepaskan</button>
                            </form>
                        @else
                            <form action="/barang/gudang/pin/{{$brg->id}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                            </form>
                        @endif
                    </div>
                    <button class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#hapus-barang-Modal-{{$brg->id}}"><i class="fa-solid fa-trash"></i> Hapus</button>
                </div>
            </div>
        </div>

        <!--Modal-->
        @include('admin.barang.gudang.form.hapus_barang')
        @include('admin.barang.gudang.form.edit_harga')
    @endforeach
</div>

<script>
    <?php 
        foreach ($barang as $brg){
            echo"
                function totalKeuntungan_".$brg->id."(){
                    var stok = document.getElementById('harga_stok_".$brg->id."').value;
                    var jual = document.getElementById('harga_jual_".$brg->id."').value;

                    var total = jual - stok;

                    document.getElementById('keuntungan_".$brg->id."').innerHTML = 'Rp. ' + total;
                }
            ";
        }
    ?>
</script>