<style>
    .hour-box{
        width:100%;
        height: 120px;
        padding: 10px;
        margin-bottom:10px;
        background:rgba(105, 122, 255, 0.15);
    }
    .hour-box.active{
        color:white;
        background:rgba(105, 122, 255, 0.55);
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
        <button class="btn btn-danger py-0 px-2" data-bs-toggle="modal" data-bs-target="#delete_hour_kegiatan_{{$i}}"><i class="fa-solid fa-trash"></i></button>
        <button class="btn btn-success py-0 px-2 ms-2" data-bs-toggle="modal" data-bs-target="#add_kegiatan_{{$i}}">Tambah</button>
    </div>

    <!--BUG!!!! when pengingat's hours more than 12:00 -->
    <!--Add kegiatan-->
    <div class="modal fade" id="add_kegiatan_{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/pengingat/tambah_kegiatan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
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
                                            <input type="date" class="form-control" name="kegiatan_date_mulai" value="<?php 
                                                if(strtotime(session()->get('filter_day_key')) != null){
                                                    echo date('Y-m-d', strtotime(session()->get('filter_day_key')));
                                                } else {
                                                    echo date('Y-m-d');
                                                }?>">
                                            <label for="floatingInput">Tanggal Mulai</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="time" class="form-control" name="kegiatan_hour_mulai" value="{{sprintf('%02d', $i)}}:00">
                                            <label for="floatingInput">Waktu Mulai</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-2">
                                            <input type="date" class="form-control" name="kegiatan_date_selesai" value="<?php 
                                                if(strtotime(session()->get('filter_day_key')) != null){
                                                    echo date('Y-m-d', strtotime(session()->get('filter_day_key')));
                                                } else {
                                                    echo date('Y-m-d');
                                                }?>">
                                            <label for="floatingInput">Tanggal Selesai</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="time" class="form-control" name="kegiatan_hour_selesai" value="{{sprintf('%02d', $i)}}:59">
                                            <label for="floatingInput">Waktu Selesai</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Tambahkan File <span class="fw-bold text-secondary">Opsional</span></label>
                                    <input class="form-control" name="kegiatan_url" type="file" id="formFile" onchange="loadFile<?php echo $i; ?>(event)">
                                </div>
                                <div class="file-holder">
                                    <label for="formFile" class="form-label">File Terlampir</label>
                                    <img class="img img-fluid" id="img-show-{{$i}}"/>
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
    <!--Delete kegiatan-->
    <div class="modal fade" id="delete_hour_kegiatan_{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda ingin menghapus seluruh pengingat pada tanggal {{date("d-M-Y", strtotime(session()->get('filter_day_key')))}} jam {{$i}}:00</p>
                </div>
                <div class="modal-footer">
                    <form action="/pengingat/hapus_hour_kegiatan/{{$i}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endfor

<script>
    //Image upload preview.
    <?php
        for($i = 0; $i < 24; $i++){
            echo"
            var loadFile".$i." = function(event) {
            var output = document.getElementById('img-show-".$i."');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                }
            };";
        }
    ?>
</script>