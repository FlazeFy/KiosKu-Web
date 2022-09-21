<style>
    .hour-box{
        width:100%;
        height: 100px;
        padding: 10px;
        margin-bottom:10px;
        background:rgba(105, 122, 255, 0.15);
    }
    .hour-box.active, .hour-box.active h6{
        color:white;
        background:#676AFB;
    }
    .hour-box h6{
        text-align:right;
        color:#676AFB;
        margin-top:55px;
    }
</style>

@for($i = 0; $i < 24; $i++)
    <div class="hour-box rounded  
        <?php if(date("H") == $i){ echo " active ";}?>">
        <h6 class="hour-text">
            {{$i}}:00 
            - {{$i}}:59
        </h6>
    </div>
@endfor