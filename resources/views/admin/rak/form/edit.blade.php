<div class="modal fade" id="edit-barang-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/rak/edit_barang/{{$bk->id_barang}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="harga_jual" value="{{$bk->harga_jual}}" required>
                                <label for="floatingInput">Harga Jual (Rp.)</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="stok_barang" value="{{$bk->stok_barang}}" required>
                                <label for="floatingInput">Stok</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="harga_stok" value="{{$bk->harga_stok}}" required>
                                <label for="floatingInput">Harga Stok (Rp.)</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" name="expired_at" value="{{date('Y-m-d',strtotime($bk->expired_at))}}" required>
                                <label for="floatingInput">Tanggal Expired</label>
                            </div>
                        </div>
                    </div>
                    <a class="text-secondary fst-italic"><i class="fa-solid fa-circle-info"></i> Untuk mengubah secara lengkap, buka menu "Barang"</a>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
