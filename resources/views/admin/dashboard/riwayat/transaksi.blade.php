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
    <ul class="custom-scroll scrollbar p-0 m-0 mt-3" style="max-height: calc(65vh - 90px); max-width:auto; overflow-x: auto;">
        @foreach($transaksi as $trs)
            @php($total = 0)
            @php($arr = [])
            <li class="d-flex mb-4 pb-1">
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <table style="table-layout: fixed; width: 100%;">
                        <tr>
                            <th width="75%"></th>
                            <th></th>
                        </tr>
                        <td>
                            <div class="me-2">
                                <small class="text-muted d-block mb-1 content-list-body">
                                    <!--Iterate category to array-->
                                    @foreach($barang_transaksi as $btrs)
                                        @if($btrs->id_keranjang == $trs->id)
                                            @php($arr[] = $btrs->kategori_barang)
                                        @endif
                                    @endforeach

                                    <!--Make array unique-->
                                    <!-- @php($arr = array_unique($arr)) -->
                                    @foreach(array_unique($arr) as $ar => $val)
                                        {{$val}},
                                    @endforeach
                                </small>
                                <h6 class="mb-0 content-list-body">
                                    @foreach($barang_transaksi as $btrs)
                                        @if($btrs->id_keranjang == $trs->id)
                                            ({{$btrs->qty}}) {{$btrs->nama_barang}},
                                            @php($total += $btrs->qty * $btrs->harga_jual)
                                        @endif
                                    @endforeach
                                </h6>
                            </div>
                        </td>
                        <td>
                            <div class="me-2">
                                <small class="text-success d-block mb-1">{{$trs->nama_kasir}}</small>
                                <h6 class="mb-0">Rp. {{$total}}</h6>
                            </div>
                        </td>
                    </table>
                </div>
            </li>
        @endforeach
        
    </ul>
</div>