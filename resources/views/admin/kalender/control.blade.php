<h6>Pengaturan</h6>
<form id="form_filter" action="/kalender/filter" method="POST">
        @csrf
    <div class="form-floating mt-3">
            <select class="form-select" id="filter_calender" name="filtercalender" aria-label="Floating label select example" onchange="this.form.submit()">
                <option <?php if(session()->get('filter_calendar_key') == null){ echo "selected"; }?>>...</option>
                <option value="Absensi" <?php if(session()->get('filter_calendar_key') == "Absensi"){ echo "selected"; }?>>Absensi</option>
                <option value="Total Keuntungan" <?php if(session()->get('filter_calendar_key') == "Total Keuntungan"){ echo "selected"; }?>>Total Keuntungan</option>
                <option value="Barang Terjual" <?php if(session()->get('filter_calendar_key') == "Barang Terjual"){ echo "selected"; }?>>Barang Terjual</option>
                <option value="Kegiatan" <?php if(session()->get('filter_calendar_key') == "Kegiatan"){ echo "selected"; }?>>Kegiatan</option>
            </select>
        <label for="floatingSelect">Saring Tampilan</label>
    </div>
    <p class="text-secondary m-1">Saring : {{session()->get('filter_calendar_key')}}</p>
</form>

<script>
    //Not used until calender use with ajax

    // function filter_calendar(){
    //     event.preventDefault();
    //     $.ajax({
    //         url: '/kalender/filter',
    //         type: 'post',
    //         data: $('#form_filter').serialize(),
    //         dataType: 'json',
    //         success: function( _response ){
    //             // Handle your response..
    //         },
    //         error: function( _response ){
    //             // Handle error
    //         }
    //     });
    // }
</script>