<div class="modal fade" id="delete-all-activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin untuk menghapus semua notifikasi? <b class="text-danger">Notifikasi mengenai kios pada akun karyawan akan ikut terhapus</b></p>
            </div>
            <div class="modal-footer">
                <form action="/aktivitas/delete_all_aktivitas" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width:120px;"><i class="fa-solid fa-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>