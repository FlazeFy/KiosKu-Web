<div class="modal fade" id="sign-out-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin untuk keluar dari Akun?</p>
            </div>
            <div class="modal-footer">
                <form action="/profil/sign_out" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width:120px;"><i class="fa-solid fa-right-from-bracket"></i> Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>