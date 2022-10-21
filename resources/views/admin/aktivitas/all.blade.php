<style>
    .riwayat-box{
        padding: 16px;
        border-radius: 6px;
        position: relative;
        height: 120px;
    }
    .riwayat-box:hover, .riwayat-box:hover h6, .riwayat-box:hover .riwayat-date{
        background: #df4759;
        color:white !important;
    }

    .riwayat-date{
        font-size: 13px;
        position: absolute;
        bottom: 10px;
        right: 10px;
        color: grey !important;
    }

    .riwayat-box a{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

<div class="row">
    @foreach($riwayat as $rw)
        <div class="col-lg-3 col-md-6 col-sm-12 p-2">
            <div class="riwayat-box shadow">
                <form class="d-inline" method="POST" action="/aktivitas/delete/{{$rw->id}}">
                    @csrf
                    <button class="btn btn-transparent m-0 p-0 position-absolute text-white" style="right:10px; top:5px;" type="submit"
                        title="Hapus"><i class="fa-solid fa-trash fa-lg"></i></button>
                </form>
                <h6>{{$rw->konteks_riwayat}}</h6>
                <a>Anda {{$rw->deskripsi_riwayat}}</a><br>
                <!--Date & time converter-->
                @if(date('Y-m-d' ,strtotime($rw->created_at)) == date('Y-m-d', strtotime("0 days")))
                    @php($date = "Hari ini ".date('h:i' ,strtotime($rw->created_at)))
                @elseif(date('Y-m-d' ,strtotime($rw->created_at)) == date('Y-m-d', strtotime("-1 days")))
                    @php($date = "Kemarin ".date('h:i' ,strtotime($rw->created_at)))
                @else
                    @php($date = date('Y-m-d h:i' ,strtotime($rw->created_at)))
                @endif

                <a class="riwayat-date">{{$date}}</a>
            </div>
        </div>
    @endforeach
</div>