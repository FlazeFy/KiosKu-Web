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
    .fc-day-today .fc-event-title{
        color: #414141 !important;
    }
</style>

<div id="calendar"></div>

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
            // {
            //     groupId: '992',
            //     title: 'All Day Test',
            //     start: '2022-07-09'
            // },
            // {
            //     groupId: '992',
            //     title: 'Long Event',
            //     start: '2022-07-09T16:00:00'
            // },
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