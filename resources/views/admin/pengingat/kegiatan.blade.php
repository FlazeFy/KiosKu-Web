<style>
    .kegiatan-box{
        border-radius:6px;
        padding: 6px;
        height: 100%;
        width:240px;
        margin-right: 5px; 
        background: white;
        border: 2px solid #676AFB;
        display:inline-block;
    }
    .kegiatan-box .desc{
        font-size:12px;
        color: #808080;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .kegiatan-box .time{
        font-size:13.5px;
        color: #676AFB !important;
        float: right;
        font-weight: 500;
    }
    .hour_box_holder{
        display: flex;
        flex-direction: row;
        overflow-x: scroll;
    }
</style>

@for($i = 0; $i < 24; $i++)
    <div class="hour-box hour_box_holder rounded  
        <?php if(date("H") == $i){ echo " active ";}?>">
        @foreach($kegiatan as $kg)
            @if(date("H", strtotime($kg->waktu_mulai)) == $i)
                <div class="kegiatan-box shadow">
                    <a class="time"><i class="fa-regular fa-clock"></i> {{date("H:i", strtotime($kg->waktu_mulai))}}-{{date("H:i", strtotime($kg->waktu_selesai))}}</a>
                    <h7 style="font-size:13.5px; font-weight:500;">{{$kg->kegiatan_title}}</h7><br>
                    <a class="desc">{{$kg->kegiatan_desc}}</a>
                </div>
            @endif
        @endforeach
    </div>
@endfor