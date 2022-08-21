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
    <ul class="p-0 m-0 mt-3">
        @foreach($transaksi as $trs)
            @php($total = 0)
            @php($arr = [])
            <li class="d-flex mb-4 pb-1">
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">
                            <!--Iterate category to array-->
                            @foreach($barang_transaksi as $btrs)
                                @if($btrs->id_keranjang == $trs->id)
                                    @php($arr[] = $btrs->kategori_barang)
                                @endif
                            @endforeach

                            <!--Make array unique-->
                            @php($arr = array_unique($arr))
                            @foreach($arr as $ar => $val)
                                {{$val}},
                            @endforeach
                        </small>
                        <h6 class="mb-0">
                            @foreach($barang_transaksi as $btrs)
                                @if($btrs->id_keranjang == $trs->id)
                                    ({{$btrs->qty}}) {{$btrs->nama_barang}},
                                    @php($total += $btrs->qty * $btrs->harga_barang)
                                @endif
                            @endforeach
                        </h6>
                    </div>
                    <div class="me-2">
                        <small class="text-success d-block mb-1">{{$trs->nama_kasir}}</small>
                        <h6 class="mb-0">Rp. {{$total}}</h6>
                    </div>
                </div>
            </li>
        @endforeach
        
    </ul>
</div>