@foreach($kegiatan as $kg)
    <div class="modal fade" id="edit-kegiatan-{{$kg->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/pengingat/edit_kegiatan/{{$kg->id}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-floating mb-2">
                                    <input type="text" class="form-control" name="kegiatan_title" value="{{$kg->kegiatan_title}}" required>
                                    <label for="floatingInput">Nama Kegiatan</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <textarea class="form-control" name="kegiatan_desc" style="height:100px;" value="{{$kg->kegiatan_desc}}">{{$kg->kegiatan_desc}}</textarea>
                                    <label for="floatingInput">Deskripsi</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <select class="form-select" id="floatingSelectGrid" name="kegiatan_type">
                                        <option value="wajib" <?php if($kg->kegiatan_type == "wajib"){ echo " selected "; }?>>Wajib</option>
                                        <option value="opsional" <?php if($kg->kegiatan_type == "opsional"){ echo " selected "; }?>>Opsional</option>
                                        <option value="pertemuan" <?php if($kg->kegiatan_type == "pertemuan"){ echo " selected "; }?>>Pertemuan</option>
                                    </select>
                                    <label for="floatingInput">Tipe</label>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-2">
                                            <input type="date" class="form-control" name="kegiatan_date_mulai" value="{{date('Y-m-d', strtotime($kg->waktu_mulai))}}">
                                            <label for="floatingInput">Tanggal Mulai</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="time" class="form-control" name="kegiatan_hour_mulai" value="{{date('H:i', strtotime($kg->waktu_mulai))}}">
                                            <label for="floatingInput">Waktu Mulai</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-2">
                                            <input type="date" class="form-control" name="kegiatan_date_selesai" value="{{date('Y-m-d', strtotime($kg->waktu_selesai))}}">
                                            <label for="floatingInput">Tanggal Selesai</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="time" class="form-control" name="kegiatan_hour_selesai" value="{{date('H:i', strtotime($kg->waktu_selesai))}}">
                                            <label for="floatingInput">Waktu Selesai</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="file-holder">
                                    <h6 for="formFile" class="text-primary">File Terlampir</h6>
                                    @if($kg->kegiatan_url != null)
                                        @php($url = json_decode($kg->kegiatan_url, true))

                                        @foreach($url as $u)
                                            @if($u['type'] == "image")
                                                <img class="img img-fluid" src="{{url('storage/'.$u['url'])}}"/>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    </form>
                    <form action="/pengingat/hapus_kegiatan/{{$kg->id}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                    </form>
                </div>                
            </div>
        </div>
    </div>
@endforeach