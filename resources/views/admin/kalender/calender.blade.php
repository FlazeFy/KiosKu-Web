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
</style>

<div id="calendar"></div>
<div class="container-fluid p-2">
    <h6>Keterangan :</h6>
    <a class="ms-2"><b>H</b>: Hadir</a>
    <a class="ms-2"><b>SI</b>: Sakit (Sakit/Izin)</a>
    <a class="ms-2"><b>A</b>: Alpa</a>
</div>

<script>
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
                    //
                } else if(session()->get('filter_calendar_key') == "Barang Terjual"){
                    //
                } else if(session()->get('filter_calendar_key') == "Kegiatan"){
                    //
                }
            ?>
        ],

        //Show calender detail
        eventClick:  function(info, jsEvent, view) {
            //
            $('#recipeDetailModal').modal('show');
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