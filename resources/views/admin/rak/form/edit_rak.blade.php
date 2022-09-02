<div class="modal fade" id="edit-rak-Modal-{{$rk->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/rak/edit_rak/{{$rk->id}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="nama_rak" value="{{$rk->nama_rak}}" required>
                        <label for="floatingInput">Nama Rak</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="deskripsi_rak" value="{{$rk->deskripsi_rak}}" required>
                        <label for="floatingInput">Deskripsi Rak</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
