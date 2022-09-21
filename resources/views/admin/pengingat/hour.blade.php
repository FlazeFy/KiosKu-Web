<style>
    .hour-box{
        width:100%;
        height: 120px;
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
        margin-top:50px;
    }
</style>

@for($i = 0; $i < 24; $i++)
    <div class="hour-box rounded  
        <?php if(date("H") == $i){ echo " active ";}?>">
        <h6 class="hour-text">
            {{$i}}:00 
            - {{$i}}:59
        </h6>
        <button class="btn btn-warning py-0 px-2 text-white"><i class="fa-solid fa-gear"></i></button>
        <button class="btn btn-danger py-0 px-2"><i class="fa-solid fa-trash"></i></button>
        <button class="btn btn-success py-0 px-2 ms-2" data-bs-toggle="modal" data-bs-target="#add_kegiatan_{{$i}}">Tambah</button>
    </div>
    <div class="modal fade" id="add_kegiatan_{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/pengingat/tambah_kegiatan" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="kegiatan_title" required>
                            <label for="floatingInput">Nama Kegiatan</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" name="kegiatan_desc" style="height:100px;"></textarea>
                            <label for="floatingInput">Deskripsi</label>
                        </div>
                        <div class="form-floating mb-2">
                            <select class="form-select" id="floatingSelectGrid" name="kegiatan_type">
                                <option value="wajib">Wajib</option>
                                <option value="opsional">Opsional</option>
                                <option value="pertemuan">Pertemuan</option>
                            </select>
                            <label for="floatingInput">Tipe</label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-2">
                                    <input type="date" class="form-control" name="kegiatan_date_mulai" value="{{date('Y-m-d', strtotime(session()->get('filter_day_key')))}}">
                                    <label for="floatingInput">Tanggal Mulai</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="time" class="form-control" name="kegiatan_hour_selesai" value="{{sprintf('%02d', $i)}}:00">
                                    <label for="floatingInput">Waktu Mulai</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-2">
                                    <input type="date" class="form-control" name="kegiatan_date_selesai" value="{{date('Y-m-d', strtotime(session()->get('filter_day_key')))}}">
                                    <label for="floatingInput">Tanggal Selesai</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="time" class="form-control" name="kegiatan_hour_selesai" value="{{sprintf('%02d', $i)}}:59">
                                    <label for="floatingInput">Waktu Selesai</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endfor