<div class="modal fade" id="tambah_tampilan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/kasir/tampilan/tambah_tampilan" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tampilan</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input class="form-control" name="nama_tampilan" required>
                        <label for="floatingTextarea">Nama Tampilan</label>
                    </div>
                    <p class="text-secondary" style="font-size:13px;"><i class="fa-solid fa-circle-info"></i> Gunakan nama tampilan yang unik</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="container_awal" checked>
                        <label class="form-check-label" for="flexCheckChecked">Sertakan Container Awal</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>