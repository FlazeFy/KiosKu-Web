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
    <a class="float-start title">Barang Terjual</a><br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column align-items-center gap-1">
        <h2 class="mb-2">
            @php($count = 0)
            @foreach($barang_transaksi as $btrs)
                @php($count += $btrs->qty)
            @endforeach
            {{$count}}
        </h2>
        <span>Total Barang</span>
        </div>
        <div id="terjualStatisticsChart"></div>
    </div>
    <ul class="custom-scroll scrollbar p-0 pe-1 m-0 mt-3" style="max-height: calc(50vh - 120px); max-width:auto; overflow-x: auto;">
        <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                @php($total_sembako = 0)
                @php($arr = [])
                <table style="table-layout: fixed; width: 100%;">
                    <tr>
                        <th width="90%"></th>
                        <th></th>
                    </tr>
                    <td>
                        <div class="me-2">
                            <h6 class="mb-0">Sembako</h6>
                            <!--Iterate category to array-->
                            @foreach($barang_transaksi as $btrs)
                                @if($btrs->kategori_barang == "Sembako")
                                    @php($arr[] = $btrs->nama_barang)
                                    @php($total_sembako += $btrs->qty)
                                @endif
                            @endforeach

                            <!--Make array unique-->
                            @php($arr = array_unique($arr))
                            @foreach($arr as $ar => $val)
                                <small class="text-muted">{{$val}}, </small>
                            @endforeach

                            <!--Empty variabel-->
                            @if(count($arr) == 0)
                                <small class="text-muted">-</small>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="me-2 float-end">
                            <small class="fw-semibold">{{$total_sembako}}</small>
                        </div>
                    </td>
                </table>
            </div>
        </li>
        <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                @php($total_makanan = 0)
                @php($arr = [])
                <table style="table-layout: fixed; width: 100%;">
                    <tr>
                        <th width="90%"></th>
                        <th></th>
                    </tr>
                    <td>
                        <div class="me-2">
                            <h6 class="mb-0">Makanan</h6>
                            <!--Iterate category to array-->
                            @foreach($barang_transaksi as $btrs)
                                @if($btrs->kategori_barang == "Makanan")
                                    @php($arr[] = $btrs->nama_barang)
                                    @php($total_makanan += $btrs->qty)
                                @endif
                            @endforeach

                            <!--Make array unique-->
                            @php($arr = array_unique($arr))
                            <small class="text-muted content-list-body">
                            @foreach($arr as $ar => $val)
                                {{$val}}, 
                            @endforeach
                            </small>

                            <!--Empty variabel-->
                            @if(count($arr) == 0)
                                <small class="text-muted">-</small>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="me-2 float-end">
                            <small class="fw-semibold m-0">{{$total_makanan}}</small>
                        </div>
                    </td>
                </table>
            </div>
        </li>
        <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                @php($total_peralatan = 0)
                @php($arr = [])
                <table style="table-layout: fixed; width: 100%;">
                    <tr>
                        <th width="90%"></th>
                        <th></th>
                    </tr>
                    <td>
                        <div class="me-2">
                            <h6 class="mb-0">Peralatan Rumah Tangga</h6>
                            <!--Iterate category to array-->
                            @foreach($barang_transaksi as $btrs)
                                @if($btrs->kategori_barang == "Peralatan Rumah Tangga")
                                    @php($arr[] = $btrs->nama_barang)
                                    @php($total_peralatan += $btrs->qty)
                                @endif
                            @endforeach

                            <!--Make array unique-->
                            @php($arr = array_unique($arr))
                            @foreach($arr as $ar => $val)
                                <small class="text-muted">{{$val}}, </small>
                            @endforeach

                            <!--Empty variabel-->
                            @if(count($arr) == 0)
                                <small class="text-muted">-</small>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="me-2 float-end">
                            <small class="fw-semibold">{{$total_peralatan}}</small>
                        </div>
                    </td>
                </table>
            </div>
        </li>
    </ul>                    
</div>