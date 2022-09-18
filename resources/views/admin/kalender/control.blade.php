<h6>Pengaturan</h6>
<form id="form_filter">
        @csrf
    <div class="form-floating mt-3">
            <select class="form-select" id="filter_calender" name="filtercalender" aria-label="Floating label select example" onchange="filter_calendar()">
                <option selected>...</option>
                <option value="Absensi">Absensi</option>
                <option value="Total Keuntungan">Total Keuntungan</option>
                <option value="Barang Terjual">Barang Terjual</option>
                <option value="Kegiatan">Kegiatan</option>
            </select>
        <label for="floatingSelect">Saring Tampilan</label>
    </div>
    <p class="text-secondary m-1">Saring : {{session()->get('filter_calendar_key')}}</p>
</form>

<script>
    function filter_calendar(){
        event.preventDefault();
        $.ajax({
            url: '/kalender/filter',
            type: 'post',
            data: $('#form_filter').serialize(),
            dataType: 'json',
            success: function( _response ){
                // Handle your response..
            },
            error: function( _response ){
                // Handle error
            }
        });
    }
</script>