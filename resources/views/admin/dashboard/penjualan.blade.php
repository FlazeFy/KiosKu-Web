<div class="container-fluid p-3 rounded shadow h-100">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-penjualan" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-penjualan">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <button class="btn btn-transparent p-0 float-end mx-4" type="button" id="cardOpt-penjualan-view" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-regular fa-calendar more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-pembeli-view">
        <form action="/dashboard/filter/penjualan" method="POST">
            @csrf
            <button type="submit" class="dropdown-item <?php if(session()->get('view_penjualan_Key') == 1){echo "active";} ?>" name="view" value="1">Mingguan</button>
        </form>
        <form action="/dashboard/filter/penjualan" method="POST">
            @csrf
            <button type="submit" class="dropdown-item <?php if(session()->get('view_penjualan_Key') == 2){echo "active";} ?>" name="view" value="2">Bulanan</button>
        </form>
    </div>
    <a class="float-start title">Penjualan</a><br>
    <h5 class="price mt-3">Rp. 
        @php($count = 0)
        @foreach($transaksi as $ts)
            @foreach($barang_transaksi as $btrs)
                @if(($btrs->id_keranjang == $ts->id)&&(strtotime($ts->created_at) > strtotime('-7 day'))&&(session()->get('view_penjualan_Key') == '1'))
                    @php($count += $btrs->qty * $btrs->harga_stok)
                @elseif (($btrs->id_keranjang == $ts->id)&&(strtotime($ts->created_at) > strtotime('-30 day'))&&(session()->get('view_penjualan_Key') == '2'))
                    @php($count += $btrs->qty * $btrs->harga_stok)
                @endif
            @endforeach
        @endforeach
        {{$count}}  
    </h5>
    <a class="percentage text-success"><i class="fa-solid fa-arrow-up"></i> 24.40%</a>
</div>