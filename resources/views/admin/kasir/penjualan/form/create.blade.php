<button class="btn btn-success me-2 my-1" data-bs-toggle="modal" data-bs-target="#tambah-kasir-Modal"><i class="fa-solid fa-plus"></i> Tambah</button>

<div class="modal fade" id="tambah-kasir-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/kasir/penjualan/tambah_kasir" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kasir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="nama_kasir" required>
                        <label for="floatingInput">Nama Kasir</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="textarea" class="form-control" name="deskripsi_kasir" required>
                        <label for="floatingInput">Deskripsi Kasir</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
