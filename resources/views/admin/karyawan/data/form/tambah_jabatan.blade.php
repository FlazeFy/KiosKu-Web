<div class="modal fade" id="tambah-jabatan-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/karyawan/data/tambah_jabatan" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class='form-floating mb-2'> 
                        <input type='text' class='form-control' name='nama_jabatan' required> 
                        <label for='floatingInput'>Nama Jabatan</label> 
                    </div>
                    <h6 class="text-primary" style="font-size:14px;">Deskripsi Jabatan</h6>
                    <textarea class='form-control desc-edit' name='deskripsi_jabatan' style='height:110px;'></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>