@if(session()->get('view_pengunjung_Key') == null)
    @php(session()->put('view_pengunjung_Key', '1'))
@endif

<div class="container-fluid p-3 rounded shadow h-100">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-pembeli" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-pembeli">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <button class="btn btn-transparent p-0 float-end mx-4" type="button" id="cardOpt-pembeli-view" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-regular fa-calendar more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-pembeli-view">
        <form action="/dashboard/filter/pembeli" method="POST">
            @csrf
            <button type="submit" class="dropdown-item <?php if(session()->get('view_pengunjung_Key') == 1){echo "active";} ?>" name="view" value="1">Mingguan</button>
        </form>
        <form action="/dashboard/filter/pembeli" method="POST">
            @csrf
            <button type="submit" class="dropdown-item <?php if(session()->get('view_pengunjung_Key') == 2){echo "active";} ?>" name="view" value="2">Bulanan</button>
        </form>
    </div>
    <a class="float-start title">Pembeli</a><br>
    <h5 class="price mt-3">
        @php($count = 0)
        @foreach($transaksi as $ts)
            @if((strtotime($ts->created_at) > strtotime('-7 day'))&&(session()->get('view_pengunjung_Key') == '1'))
                @php($count++)
            @elseif ((strtotime($ts->created_at) > strtotime('-30 day'))&&(session()->get('view_pengunjung_Key') == '2'))
                @php($count++)
            @endif
        @endforeach
        {{$count}}
    </h5>
    <a class="percentage text-success">
        @php($before = 0)
        @foreach($transaksi as $ts)
            @if((session()->get('view_pengunjung_Key') == '1')&&(strtotime($ts->created_at) > strtotime('-14 day'))&&(strtotime($ts->created_at) <= strtotime('-7 day')))
                @php($before++)
            @elseif((session()->get('view_pengunjung_Key') == '2')&&(strtotime($ts->created_at) > strtotime('-60 day'))&&(strtotime($ts->created_at) <= strtotime('-30 day')))
                @php($before++)
            @endif
        @endforeach
        
        @if($before != 0)
            <i class="fa-solid fa-arrow-up"></i> {{($count / $before * 100) - 100}} %
        @else
            no data before
        @endif
    </a>
</div>