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
    <a class="float-start title">Gudang</a><br>
    <table style="table-layout: fixed; width: 100%;">
        <tr>
            @php($stok = 0)
            @php($rentan = 0)
            @php($expired = 0)
            @php($pemesanan = 0)
            @php($date = new DateTime())

            @foreach($gudang as $gd)
                @if(strtotime($gd->expired_at) != strtotime('0000-00-00 00:00:00'))
                    @if((date("Y-m-d", strtotime($gd->expired_at)) > date("Y-m-d"))&&(date("Y-m-d", strtotime($gd->expired_at)) < date("Y-m-d", strtotime('sunday this week'))))
                        @php($rentan += $gd->stok_barang)
                    @elseif(new DateTime($gd->expired_at) < $date)
                        @php($expired += $gd->stok_barang)
                    @endif
                @endif
                @php($stok += $gd->stok_barang)
            @endforeach
            <th><h5 class="price mt-3">{{$stok}}</h5></th>
            <th><h5 class="price mt-3">{{$rentan}}</h5></th>
            <th><h5 class="price mt-3">{{$expired}}</h5></th>
            <th><h5 class="price mt-3">3</h5></th>
        </tr>
        <tr>
            <td><a class="percentage text-success">Stok</a></td>
            <td><a class="percentage text-warning">Rentan</a></td>
            <td><a class="percentage text-danger">Expired</a></td>
            <td><a class="percentage text-muted">Pemesanan</a></td>
        </tr>  
    </table>
</div>