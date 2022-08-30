<table class="w-100">
    <tr>
        <td width="25%">
            <button class="float-end me-3 bg-transparent border-0 text-primary" data-bs-toggle="collapse" data-bs-target="#collapse-{{$clps}}"><i class="fa-solid fa-circle-chevron-down fa-xl"></i></button>
        </td>
        <td>
            <div class="container my-2 w-100 float-start rounded p-3" style="background:#e7e7ff;">
                @foreach($transaksi as $trs)
                    @foreach($barang_transaksi as $btrs)
                        @if(($btrs->id_keranjang == $trs->id)&&(date('Y-m-d', strtotime($trs->created_at)) == $date_now))
                            @php($item += $btrs->qty)
                            @php($total_day += $btrs->qty * $btrs->harga_jual)
                        @endif
                    @endforeach
                @endforeach
                <h6 class="text-primary float-end"><i class="fa-solid fa-money-bill-wave" title="Total penjualan"></i> Rp. {{$total_day}} | <i class="fa-solid fa-box" title="Total barang"></i> {{$item}}</h6>
                <h6 class="text-primary"><i class="fa-regular fa-calendar"></i> {{$date_now}}</h6> 
            </div>
        </td>
    </tr>
</table>