<style>
    .kegiatan-box{
        border-radius:6px;
        padding: 6px;
        height: 100%;
        width:230px;
        margin-right: 5px; 
        background: white;
        border: 2px solid #676AFB;
        display:inline-block;
        text-align:left;
    }
    .kegiatan-box .desc{
        font-size:12px;
        color: #808080 !important;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
    }
    .kegiatan-box .time{
        font-size:13px;
        color: #676AFB !important;
        float: right;
        margin-top:3px;
        font-weight: 500;
    }
    .kegiatan-box .title{
        font-size:14px;
        color: #676AFB !important;
        font-weight: 500;
    }
    .hour_box_holder{
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }
    .btn-resume-next{
        color: #676AFB !important;
        border:none;
        background:transparent;
    }
    .btn-resume-prev{
        color: #676AFB !important;
        border:none;
        background:transparent;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
        transform: rotate(270deg);
    }
    .more-progress-box{
        background:#676AFB;
        color:white;
        border-radius:6px;
        border:none;
        padding:8px;
        width:50px;
        height:50px;
        font-size:16.5px;
    }
</style>

@for($i = 0; $i < 24; $i++)
    <div class="hour-box hour_box_holder rounded  
        <?php if(date("H") == $i){ echo " active ";}?>">
        @php($j = 0)
        @foreach($kegiatan as $kg)
            @php($continue = false)
            
            <!--Start of activity-->
            @if(date("H", strtotime($kg->waktu_mulai)) == $i)
                <button class="kegiatan-box shadow" data-bs-toggle="modal" data-bs-target="#edit-kegiatan-{{$kg->id}}">
                    <div style="position:relative; top:-10px !important;">
                        <a class="title">{{$kg->kegiatan_title}}</a>
                        <a class="time"><i class="fa-regular fa-clock"></i> {{date("H:i", strtotime($kg->waktu_mulai))}}-{{date("H:i", strtotime($kg->waktu_selesai))}}</a>
                        <a class="desc">{{$kg->kegiatan_desc}}</a>
                    <div>
                </button>
                @if(date("H", strtotime($kg->waktu_selesai)) > $i)
                    @php($continue = true)
                    <button class="btn-resume-next" title="Lihat waktu selesai"><i class="fa-solid fa-arrow-turn-down fa-2xl"></i></button>
                @endif
            @endif

            <!--In progress of activity-->
            @if((date("H", strtotime($kg->waktu_selesai)) > $i)&&(date("H", strtotime($kg->waktu_mulai)) < $i))
                @php($j++)
            @endif
            
            <!--End of activity-->
            @if((date("H", strtotime($kg->waktu_selesai)) == $i)&&(date("H", strtotime($kg->waktu_mulai)) != $i))
                <button class="btn-resume-prev" title="Lihat waktu mulai"><i class="fa-solid fa-arrow-turn-down fa-2xl" style="-webkit-transform: scaleX(-1);
                    transform: scaleX(-1);"></i></button>
                <button class="kegiatan-box shadow" data-bs-toggle="modal" data-bs-target="#edit-kegiatan-{{$kg->id}}">
                    <div style="position:relative; top:-10px !important;">
                        <a class="title">{{$kg->kegiatan_title}}</a>
                        <a class="time"><i class="fa-regular fa-clock"></i> {{date("H:i", strtotime($kg->waktu_mulai))}}-{{date("H:i", strtotime($kg->waktu_selesai))}}</a>
                        <a class="desc">{{$kg->kegiatan_desc}}</a>
                    <div>
                </button>
            @endif
        @endforeach
        @if($j > 0)
            <button class="more-progress-box shadow" title="Dalam proses"><div >{{$j}} <i class="fa-solid fa-plus fa-sm"></i></div></button>
        @endif
    </div>
@endfor