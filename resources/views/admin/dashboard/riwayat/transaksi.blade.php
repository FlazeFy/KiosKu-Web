<div class="container-fluid p-3 rounded shadow h-100">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-kalender" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-kalender">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <a class="float-start title">Riwayat Transaksi</a><br>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-kalender">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <ul class="p-0 m-0">
        @foreach($transaksi as $trs)
        <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <img src=".." class="rounded" />
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <small class="text-muted d-block mb-1">
                        @foreach($barang_transaksi as $btrs)
                            @if($btrs->id_keranjang == $trs->id)
                                {{$btrs->kategori_barang}},
                            @endif
                        @endforeach
                    </small>
                    <h6 class="mb-0">
                        @foreach($barang_transaksi as $btrs)
                            @if($btrs->id_keranjang == $trs->id)
                                ({{$btrs->qty}}) {{$btrs->nama_barang}},
                            @endif
                        @endforeach
                    </h6>
                </div>
                <div class="me-2">
                    <small class="text-success d-block mb-1">Kasir 1</small>
                    <h6 class="mb-0">Rp. 48K</h6>
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>
</div>