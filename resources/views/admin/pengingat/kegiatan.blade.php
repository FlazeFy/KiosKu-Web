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
</style>

@for($i = 0; $i < 24; $i++)
    <div class="hour-box hour_box_holder rounded  
        <?php if(date("H") == $i){ echo " active ";}?>">
        @foreach($kegiatan as $kg)
            @if(date("H", strtotime($kg->waktu_mulai)) == $i)
                <div class="kegiatan-box shadow">
                    <a class="title">{{$kg->kegiatan_title}}</a>
                    <a class="time"><i class="fa-regular fa-clock"></i> {{date("H:i", strtotime($kg->waktu_mulai))}}-{{date("H:i", strtotime($kg->waktu_selesai))}}</a>
                    <a class="desc">{{$kg->kegiatan_desc}}</a>
                </div>
            @endif
        @endforeach
    </div>
@endfor