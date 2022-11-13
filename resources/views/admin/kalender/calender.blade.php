<style>
    #calendar {
        width: 100%;
        margin: 40px auto;
    }
    .fc-event-main{
        background:#696cff;
        padding:0px 10px;
        border-radius:6px;
    }
    .fc-h-event{
        border:none;
        border-radius:6px;
    }
    .fc-daygrid-event-dot{
        border:calc(var(--fc-daygrid-event-dot-width,8px)/ 2) solid var(--fc-event-border-color, #198553);
    }
    .fc .fc-daygrid-day.fc-day-today{
        background: rgba(105, 107, 255, 0.4);
    }
    .fc-event-time{
        display:none;
    }
    .fc-event-title{
        color: whitesmoke !important;
        white-space: normal !important;
        font-weight: 500;
    }
    /* .fc-daygrid-day-events{
        display: flex;
        flex-direction: column;
        height: 80px;
        overflow-y: scroll;
    } */
</style>

<div id="calendar"></div>
<div class="container-fluid p-2">
    <h6>Keterangan :</h6>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
            //right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        selectable: true,
        navLinks: true, 
        <?php 
            if(session()->get('filter_calendar_key') == "Pengingat"){
                echo "editable: true,";
            }
        ?>
        //eventLimit: true,
        //eventLimit: 4,
        events: [
            <?php
                //Initial value
                $i = 0;

                if(session()->get('filter_calendar_key') == "Absensi"){
                    foreach($c_absensi as $ca){
                        echo "
                            {
                                groupId: '".$i."',
                                title: 'Hadir: ".$ca->Hadir."',
                                start: '".$ca->date_c."'
                            },
                            {
                                groupId: '".$i."',
                                title: 'Sakit/Izin: ".$ca->SI."',
                                start: '".$ca->date_c."'
                            },
                            {
                                groupId: '".$i."',
                                title: 'Alpa: ".$ca->Alpa."',
                                start: '".$ca->date_c."'
                            },
                        ";
                        $i++;
                    }
                } else if(session()->get('filter_calendar_key') == "Total Keuntungan"){
                    foreach($c_keuntungan as $ck){
                        echo "
                            {
                                groupId: '".$i."',
                                title: 'Total: Rp. ".$ck->keuntungan."',
                                start: '".$ck->date_c."'
                            },
                            {
                                groupId: '".$i."',
                                title: 'Item: ".$ck->item."',
                                start: '".$ck->date_c."'
                            },
                        ";
                        $i++;
                    }
                } else if(session()->get('filter_calendar_key') == "Barang Terjual"){
                    foreach($c_b_terjual as $cbj){
                        echo "
                            {
                                groupId: '".$i."',
                                title: 'Makanan: ";
                                    if($cbj->Makanan == null){
                                        echo 0;
                                    } else {
                                        echo $cbj->Makanan;
                                    }
                                echo "',
                                start: '".$cbj->date_c."'
                            },
                            {
                                groupId: '".$i."',
                                title: 'Sembako: ";
                                    if($cbj->Sembako == null){
                                        echo 0;
                                    } else {
                                        echo $cbj->Sembako;
                                    }
                                echo "',
                                start: '".$cbj->date_c."'
                            },
                        ";
                        $i++;
                    }
                } else if(session()->get('filter_calendar_key') == "Pengingat"){
                    foreach($c_pengingat as $cp){
                        echo "
                            {
                                groupId: '".$i."',
                                id: '".$cp->id."',
                                title: '".$cp->kegiatan_title."',
                                start: '".$cp->date_c."',
                                extendedProps: {
                                    datetime: '".$cp->time_c."'
                                }
                            },
                        ";
                        $i++;
                    }
                }
            ?>
        ],

        //Show calender detail
        eventClick:  function(info, jsEvent, view) {
            //
            $('#recipeDetailModal').modal('show');
        },

        eventDrop: function(info) {
            var newDate= info.event.start
            var fulldate = newDate.getFullYear() + "-" + ("0" + (newDate.getMonth()+1)).slice(-2) + "-" + ("0" + newDate.getDate()).slice(-2) + " " + info.event.extendedProps.datetime;
            
            //Post ajax
            $.ajax({
                url: 'kalender/edit_tanggal/'+info.event.id,
                type: 'post',
                data: {_token: '{{csrf_token()}}', waktu_mulai: fulldate},
                dataType: 'json',
                success: function( _response ){
                    //...
                },
                error: function( _response ){
                    // Handle error
                }
            });
            location.reload();
            
        },

        //Add event
        dateClick: function(info, date) {
            document.getElementById("modalDate").defaultValue = info.dateStr;
            //
            $('#addDailyModal').modal('show');
        }
    });
    calendar.render();
    });
</script>