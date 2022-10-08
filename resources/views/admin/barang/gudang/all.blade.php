<style>
    .barang #barang-flters {
        list-style: none;
        margin-bottom: 20px;
    }
    .barang #barang-flters li {
        cursor: pointer;
        display: inline-block;
        margin: 0 10px 10px 10px;
        font-size: 15px;
        font-weight: 600;
        line-height: 1;
        padding: 7px 10px;
        text-transform: uppercase;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }
    .barang #barang-flters li:hover, .barang #barang-flters li.filter-active {
        color: #22A7F0;
    }
    .barang-item{
        margin-top:20px;
    }
    #headerBox{
        background-position: center;
        background-repeat:no-repeat;
        position: relative;
        background-size: cover;
        background-color: black;
        height:200px;
    }
    .image-upload>input {
        display: none;
    }
</style>

<ul id="barang-flters" class="d-flex justify-content-center">
    <li data-filter="*" class="filter-active">Semua</li>
    <li data-filter=".filter-web">....</li>
</ul>

<div class="row barang-container">
    @foreach($barang as $brg)
        <div class="col-lg-4 col-md-6 barang-item filter-{{$brg->kategori_barang}}">
            <div class="container-fluid p-0 rounded shadow">
                <form method="POST" action="/barang/gudang/edit_gambar/{{$brg->id}}"  id="formImage{{$brg->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header w-100 p-4 position-relative" id="headerBox" style=" 
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
                <div class="card-body barang-item">
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
                    <button class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                    <button class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#hapus-barang-Modal-{{$brg->id}}"><i class="fa-solid fa-trash"></i> Hapus</button>
                </div>
               
            </div>
        </div>

        <!--Modal-->
        @include('admin.barang.gudang.form.hapus_barang')
    @endforeach
</div>