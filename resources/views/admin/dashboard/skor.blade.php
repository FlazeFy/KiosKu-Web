<div class="container-fluid p-3 rounded shadow h-100">
    <i class="fa-solid fa-question float-end more"></i>                                            
    <a class="float-start title">Skor</a><br>
        <!--Initial variable-->
        @php($final = "")
        @php($grade1 = 0)
        @php($grade2 = 0)
        @php($grade3 = 0)

        <!--Count keuntungan grade-->
        @php($c_keuntungan = 0)
        @php($b_keuntungan = 0)
        @foreach($transaksi as $ts)
            @foreach($barang_transaksi as $btrs)
                @if(($btrs->id_keranjang == $ts->id)&&(strtotime($ts->created_at) > strtotime('-30 day')))
                    @php($c_keuntungan += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok))
                @elseif(($btrs->id_keranjang == $ts->id)&&(strtotime($ts->created_at) > strtotime('-60 day'))&&(strtotime($ts->created_at) <= strtotime('-30 day')))
                    @php($b_keuntungan += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok))
                @endif
            @endforeach
        @endforeach

        <!--Count pembeli-->
        @php($c_pembeli = 0)
        @php($b_pembeli = 0)
        @foreach($transaksi as $ts)
            @if(strtotime($ts->created_at) > strtotime('-30 day'))
                @php($c_pembeli++)
            @elseif((strtotime($ts->created_at) > strtotime('-60 day'))&&(strtotime($ts->created_at) <= strtotime('-30 day')))
                @php($b_pembeli++)
            @endif
        @endforeach

        <!--Count gudang grade-->
        @php($stok = 0)
        @php($expired = 0)
        @php($date = new DateTime())

        @foreach($gudang as $gd)
            @if(strtotime($gd->expired_at) != strtotime('0000-00-00 00:00:00'))
                @if(new DateTime($gd->expired_at) < $date)
                    @php($expired += $gd->stok_barang)
                @endif
            @endif
            @php($stok += $gd->stok_barang)
        @endforeach

        @if(($c_keuntungan != 0)&&($c_pembeli != 0)&&($stok != 0))
            <!--Final percentage-->
            @php($val1 = number_format((float)($c_keuntungan / $b_keuntungan * 100) - 100, 2, '.', ''))
            @php($val2 = number_format((float)($c_pembeli / $b_pembeli * 100) - 100, 2, '.', ''))
            @php($val3 = number_format((float)($expired / $stok * 100), 2, '.', ''))

            <!--Grade keuntungan-->
            @if($val1 >= 10)
                @php($grade1 = 4)
            @elseif(($val1 >= 0)&&($val1 < 10))
                @php($grade1 = 3)
            @elseif(($val1 >= -10)&&($val1 < 0))
                @php($grade1 = 2)
            @elseif($val1 < -10)
                @php($grade1 = 1)
            @endif

            <!--Grade pembeli-->
            @if($val2 >= 10)
                @php($grade2 = 4)
            @elseif(($val2 >= 0)&&($val2 < 10))
                @php($grade2 = 3)
            @elseif(($val2 >= -10)&&($val2 < 0))
                @php($grade2 = 2)
            @elseif($val2 < -10)
                @php($grade2 = 1)
            @endif

            <!--Grade gudang-->
            @if($val3 < 0)
                @php($grade3 = 4)
            @elseif(($val3 >= 0)&&($val3 < 10))
                @php($grade3 = 3)
            @elseif(($val3 >= 10)&&($val3 < 20))
                @php($grade3 = 2)
            @elseif($val3 >= 20)
                @php($grade3 = 1)
            @endif

            <!--Final grade-->
            @php($final = $grade1 + $grade2 + $grade3) 
            @if($final >= 11)
                @php($final = "A+")
            @elseif(($final >= 9)&&($final < 11))
                @php($final = "A")
            @elseif(($final >= 7)&&($final < 9))
                @php($final = "B+")
            @elseif(($final >= 5)&&($final < 7))
                @php($final = "B")
            @elseif(($final >= 3)&&($final < 5))
                @php($final = "C+")
            @elseif($final < 3)
                @php($final = "C")
            @endif
        @else
            @php($final = "Data Belum Lengkap")
        @endif
    <h2 class="score mt-2">{{$final}}</h2>
    <a class="percentage text-muted">Bulan Ini</a>
</div>