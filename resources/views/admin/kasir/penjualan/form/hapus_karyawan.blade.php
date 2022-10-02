<div class="modal fade" id="hapus-karyawan-Modal-{{$rk->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/kasir/penjualan/hapus_karyawan/{{$rk->id}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus {{$rk->nama_karyawan}} dari Kasir "{{$ks->nama_kasir}}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
