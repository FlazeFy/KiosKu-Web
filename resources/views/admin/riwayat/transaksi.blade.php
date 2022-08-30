<div class="row">
    <div class="col-md-10">
        <div class="container my-3 float-start rounded shadow p-3">
            <div class="position-relative">
                <a class="text-primary float-end"><i class="fa-solid fa-clock"></i> {{date('H:i', strtotime($trs->created_at))}}</a>
                <a class="float-end mx-3 
                    <?php 
                        if($trs->status_keranjang == "lunas"){ 
                            echo " text-success ";
                        } else {
                            echo " text-danger ";
                        }
                    ?>"
                    >{{$trs->status_keranjang}}
                </a>
                <h6>ID      : {{$trs->id}}</h6>
                <h6>Kasir   : {{$trs->nama_kasir}}</h6>
                <hr>
                    <table class="w-100">
                        <th width="15%">ID Barang</th>
                        <th>Nama, Harga, Qty</th>
                        <th width="15%">Subtotal</th>
                        @php($keuntungan_day = 0)
                        @foreach($barang_transaksi as $btrs)
                            @if($btrs->id_keranjang == $trs->id)
                                <tr>
                                    <td>{{$btrs->id}}</td>
                                    <td>
                                        <h7>{{$btrs->nama_barang}}</h7><br>
                                        <a><span>@</span>{{$btrs->qty}}</a>
                                        <a class="float-end me-4">Rp. {{$btrs->harga_jual}}</a>
                                    </td>
                                    <td class="fw-bold text-secondary">Rp. {{$btrs->qty * $btrs->harga_jual}}</td>
                                </tr>
                                @php($keuntungan_day += $btrs->qty * ($btrs->harga_jual -  $btrs->harga_stok))
                                @php($total += $btrs->qty * $btrs->harga_jual)
                                @php($bayar = $btrs->bayar)
                            @endif
                        @endforeach
                    </table>
                <hr>
                <h6 class="text-secondary fw-bold float-end me-4">Total : Rp. {{$total}}</h6>
                <h6 class="text-secondary fw-bold float-end me-4">Bayar : Rp. {{$bayar}}</h6><br>
                <h6 class="text-secondary fw-bold text-end me-4 position-absolute" style="right:0px;">Kembali : Rp. {{$bayar - $total}}</h6><br>
            </div>
        </div>
    </div>
    <div class="col-md-2 p-4">
        <div class="row" title="Total keuntungan">
            <div class="col-md-3">
                <i class="fa-solid fa-plus fa-2xl text-success"></i>
            </div>
            <div class="col-md">
                <h5 class="text-success ms-1"> Rp. {{$keuntungan_day}}</h5>
            </div>
        </div>
    </div>
</div>