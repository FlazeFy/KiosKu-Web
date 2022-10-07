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
        margin-bottom:10px;
        margin-top:10px;
    }
</style>

<ul id="barang-flters" class="d-flex justify-content-center">
    <li data-filter="*" class="filter-active">Semua</li>
    <li data-filter=".filter-web">....</li>
</ul>

<div class="row barang-container">
    @foreach($barang as $brg)
        <div class="col-lg-4 col-md-6 barang-item filter-{{$brg->kategori_barang}}">
            <div class="container-fluid p-4 rounded shadow">
                <h6 class="text-secondary float-end">{{$brg->kategori_barang}}</h6>
                <h6 class="text-primary">{{$brg->nama_barang}}</h6>
                <img class="img img-fluid rounded w-100" src="{{$brg->image_url_barang}}">
                <div class="barang-item">
                    <div class="row">
                        <div class="col-4">
                            <h6 class="text-primary">Harga Stok</h6>
                            <h5>Rp. {{$brg->harga_stok}}</h5>
                            <h6 class="text-primary">Harga Jual</h6>
                            <h5>Rp. {{$brg->harga_jual}}</h5>
                        </div>  
                        <div class="col-8">
                            <h6 class="text-primary">Deskripsi</h6>
                            <textarea class="form-control desc-edit" name="deskripsi_barang" value="{{$brg->deskripsi_barang}}" onblur="">{{$brg->deskripsi_barang}}</textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="form-floating mb-2">
                                <input class="form-control num-edit" type="number" value="{{$brg->stok_barang}}" min="0">
                                <label for="floatingInput">Stok</label>
                            </div>
                        </div>  
                        <div class="col-8">
                            <div class="form-floating mb-2">
                                <input class="form-control" type="date" name="expired_at" value="<?php 
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
                </div>
            </div>
        </div>
    @endforeach
</div>