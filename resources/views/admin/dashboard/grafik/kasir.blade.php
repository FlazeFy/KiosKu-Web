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
    <button class="btn btn-transparent p-0 float-end mx-4" type="button" id="cardOpt-terjual-view" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-regular fa-calendar more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-terjual-view">
        <a class="dropdown-item" href="">Mingguan</a>
        <a class="dropdown-item" href="">Bulanan</a>
    </div>
    <a class="float-start title">Kasir</a><br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column align-items-center gap-1">
        <h2 class="mb-2">
            {{count($kasir)}}
        </h2>
        <span>Total Kasir</span>
        </div>
        <div id="kasirStatisticsChart"></div>
    </div>
    <ul class="p-0 m-0">
        @foreach($kasir as $kr)
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"
                    ><i class="bx bx-mobile-alt"></i
                    ></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <table style="table-layout: fixed; width: 100%;">
                        <tr>
                            <th width="70%"></th>
                            <th></th>
                        </tr>
                        <td>
                            <div class="me-2">
                                <h6 class="mb-0">{{$kr->nama_kasir}}</h6>
                                <small class="text-muted">{{$kr->nama_karyawan}}</small>
                            </div>
                        </td>
                        <td>
                            <div class="user-progress float-end">
                                @php($total = 0)
                                @foreach($barang_transaksi as $btrs)
                                    @if($btrs->id_kasir == $kr->id)
                                        @php($total += $btrs->harga_stok * $btrs->qty)
                                    @endif
                                @endforeach
                                <small class="fw-semibold">Rp. {{$total}}</small>
                            </div>
                        </td>
                    </table>
                </div>
            </li>
        @endforeach
    </ul>                    
</div>