<div class="text-nowrap  table-responsive">
@if(count($transaksi) > 0)
    <table class="table table-paginate" id="riwayatTable-{{$ks->id}}" cellspacing="0">
        <thead>
        <tr>
            <th>Kategori</th>
            <th>Rincian</th>
            <th width="140px">Total</th>
            <th width="60px">Tanggal</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($transaksi as $trs)
                @if($trs->id_kasir == $ks->id)
                    @php($total = 0)
                    @php($untung = 0)
                    @php($arr = [])
                    <tr>
                        <td>
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
                        </td>
                        <td>
                            <div class="container" style="width:240px; white-space:normal;">
                                @foreach($barang_transaksi as $btrs)
                                    @if($btrs->id_keranjang == $trs->id)
                                        ({{$btrs->qty}}) {{$btrs->nama_barang}},
                                        @php($total += $btrs->qty * $btrs->harga_jual)
                                        @php($untung += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok))
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <h6 style="font-size:14px;">Keuntungan : </h6>
                            <h6 class="text-primary">Rp. {{$untung}}</h6>
                            <h6 style="font-size:14px;">Terjual : </h6>
                            <h6 class="text-primary">Rp. {{$total}}</h6>
                        </td>
                        <td><a style="font-size:14px;">{{date('Y/m/d h:i', strtotime($trs->created_at))}}</a></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@else
    <div class="container text-center d-block mx-auto">
        <img class="mx-2" src="{{asset('assets/img/storyset/Empty_1.png')}}" alt='Empty.png' style="width:250px;">
        <h5>Transaksi masih kosong...</h5>
    </div>
@endif
</div>