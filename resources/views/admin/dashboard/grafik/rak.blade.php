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
    <a class="float-start title">Rak</a><br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column align-items-center gap-1">
        <h2 class="mb-2">{{count($rak)}}</h2>
        <span>Total Rak</span>
        </div>
        <div id="rakStatisticsChart"></div>
    </div>
    <ul class="custom-scroll scrollbar p-0 pe-1 m-0 mt-3" style="max-height: calc(50vh - 120px); max-width:auto; overflow-x: auto;">
        @foreach($rak as $rk)
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"
                    ><i class="bx bx-mobile-alt"></i
                    ></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">{{$rk->nama_rak}}</h6>
                        <small class="text-muted">
                            @php($count = 0)
                            @foreach($barang_rak as $brk)
                                @if($brk->id_rak == $rk->id)
                                    {{$brk->nama_barang}},
                                    @php($count += $brk->stok_barang)
                                @endif
                            @endforeach
                        </small>
                    </div>
                    <div class="user-progress">
                        <small class="fw-semibold">{{$count}}</small>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>                    
</div>