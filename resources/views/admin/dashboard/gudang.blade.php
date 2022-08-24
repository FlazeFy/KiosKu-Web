<div class="container-fluid p-3 rounded shadow">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-kalender" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-kalender">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <button class="btn btn-transparent p-0 float-end mx-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-question mt-1 float-end more"></i> 
    </button>
    <a class="float-start title">Gudang</a><br>
    <table style="table-layout: fixed; width: 100%;">
        <tr>
            @php($stok = 0)
            @php($rentan = 0)
            @php($expired = 0)
            @php($pemesanan = 0)
            @php($date = new DateTime())

            @foreach($gudang as $gd)
                @if($gd->stok_barang != 0)
                    @if(strtotime($gd->expired_at) != strtotime('0000-00-00 00:00:00'))
                        @if((date("Y-m-d", strtotime($gd->expired_at)) > date("Y-m-d"))&&(date("Y-m-d", strtotime($gd->expired_at)) < date("Y-m-d", strtotime('sunday this week'))))
                            @php($rentan += $gd->stok_barang)
                        @elseif(new DateTime($gd->expired_at) < $date)
                            @php($expired += $gd->stok_barang)
                        @endif
                    @endif
                    @php($stok += $gd->stok_barang)
                @else
                    @php($pemesanan++)
                @endif
            @endforeach
            <th><h5 class="price mt-3">{{$stok}}</h5></th>
            <th><h5 class="price mt-3">{{$rentan}}</h5></th>
            <th><h5 class="price mt-3">{{$expired}}</h5></th>
            <th><h5 class="price mt-3">{{$pemesanan}}</h5></th>
        </tr>
        <tr>
            <td><a class="percentage text-success">Stok</a></td>
            <td><a class="percentage text-warning">Rentan</a></td>
            <td><a class="percentage text-danger">Expired</a></td>
            <td><a class="percentage text-muted">Pemesanan</a></td>
        </tr>  
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bantuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-success">Stok</h6>
                <a>Jumlah Barang yang <b>tersedia</b> didalam gudang</a><hr>
                <h6 class="text-warning mt-2">Rentan</h6>
                <a>Jumlah Barang yang memiliki <b>masa kadaluarsa kurang dari 1 minggu</b> didalam gudang</a><hr>
                <h6 class="text-danger mt-2">Expired</h6>
                <a>Jumlah Barang yang <b>sudah kadaluarsa</b> didalam gudang</a><hr>
                <h6 class="text-muted mt-2">Pemesanan</h6>
                <a>Jumlah Barang yang akan atau sedang <b>dipesan</b> dan stok barang yang <b>kosong</b>  didalam gudang</a>
            </div>
        </div>
    </div>
</div>