<button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-more" data-bs-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <i class="fa-solid fa-ellipsis-vertical more"></i>
</button>
<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-more">
    <a class="dropdown-item" href="">Segarkan</a>
    <a class="dropdown-item" href="">Detail</a>
    <a class="dropdown-item" href="">Cetak</a>
</div>
<a class="title">Total Upah</a><br>
<div id="gajiStatisticsChart"></div>
<h3 class="position-absolute" style="right:15%; top:40%;"><b>Total</b></h3>
<h5 class="position-absolute" style="right:15%; top:60%;">
    Rp. 
    @php($total = 0)
    @foreach($jabatan as $jbt)
        @php($total += $jbt->total)
    @endforeach
    {{$total}}
</h5>