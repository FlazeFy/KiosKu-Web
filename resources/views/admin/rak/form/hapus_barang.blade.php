<div class="modal fade" id="hapus-barang-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin untuk menghapus "{{$bk->nama_barang}}" dari rak?</p>
            </div>
            <div class="modal-footer">
                <form action="/rak/delete_barang/{{$bk->id}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
