<style>
    /*Day view*/
    .day-box{
        display:inline;
        margin:10px 15px;
        padding:0px;
        max-width:90px;
        border-radius:6px;
        width: 20%;
        height: 90px;
        cursor: pointer;
    }

    .day-box:hover{
        background:rgba(105, 122, 255, 0.15);
    }

    .day-box h3{
        color: #676AFB;
    }

    .day-box.active{
        background:#676AFB;
        color:white !important;
        height: 105px;
        max-width: 105px;
        margin-top:5px;
    }
    .day-box.active h3, .day-box.active h5{
        color:white !important;
    }
    .day-box.yesterday{
        
    }
    .btn-transparent-filter{
        border:none;
        margin:0px;
        padding:0px;
        width:100%;
        height:100%;
        background: transparent; 
        text-align:left; 
    }
</style>

<div class="row" id="day_holder">
    @php($i = 0)
    @foreach($day_around as $day)
        @php($val = explode ("-", $day))
        <!--id="form_filter_day_{{$i}}"-->
        <form method="POST" action="/pengingat/filterday" class="day-box <?php
                if($i == 1){
                    echo " active ";
                }
            ?> shadow">
            @csrf
            <input name="date" value="{{$day}}" hidden>
            <button type="submit" class="btn-transparent-filter">
                <h3>&nbsp {{$val[2]}}</h3>
                <h5>&nbsp &nbsp{{$val[1]}}</h5>
            </button>
        </form>
        @php($i++)
    @endforeach
</div>

<script type="text/javascript">    
    //cant post if combine with ajax get

    //Get data ajax
    // $(document).ready(function() {
    //     clear();
    // });
    
    // function clear() {
    //     setTimeout(function() {
    //         update();
    //         clear();
    //     }, 1500); //Every 1500 milliseconds
    // }
    
    // function update() {
    //     $.ajax({
    //         url: '/pengingat/get_days_around',
    //         type: 'get',
    //         dataType: 'json',
    //         success: function(response){
    //             var len = 0;
    //             $('#day_holder').empty(); 
    //             if(response != null){
    //                 len = response.length;
    //             }
                
    //             if(len > 0){
    //                 for(var i=0; i<len; i++){
    //                     //Attribute
    //                     let day = response[i];
    //                     const val = day.split("-");


    //                     var tr_str = 
    //                         "<form id='form_filter_day_" + i + "' class='day-box shadow'> " +
    //                             '@csrf ' +
    //                             "<input name='date' value='" + day + "' hidden > " +
    //                             "<button type='submit' class='btn-transparent-filter'> " +
    //                                 "<h3>" + val[2] + "</h3> " +
    //                                 "<h5>" + val[1] + "</h5> " +
    //                             "</button>" +
    //                         "</form> " ;

    //                     $("#day_holder").append(tr_str);
    //                 }
    //             }
    //         }
    //     });
    // }
    // <?php
    //     $i = 0;
    //     foreach($day_around as $day){
    //         echo"
    //         $('#form_filter_day_".$i."').submit(function( event ) {
    //             event.preventDefault();
    //             $.ajax({
    //                 url: '/pengingat/filterday',
    //                 type: 'post',
    //                 data: $('#form_filter_day_".$i."').serialize(),
    //                 dataType: 'json',
    //                 success: function( _response ){
    //                     // Handle your response..
    //                 },
    //                 error: function( _response ){
    //                     // Handle error
    //                 }
    //             });
    //         });";    
    //         $i++;
    //     }
    // ?>
</script>