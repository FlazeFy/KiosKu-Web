<div class="card shadow my-3">
    <div class="card-body p-4">
        @php($config = json_decode($ak->status_akun_kios))
        @if($config->status == "aktif")
            <form action="/profil/status/non-aktif" method="POST">
                @csrf
                <h5>Non-Aktifkan Kios</h5>
                <div class="warning-box">
                    <h6>Dengan menon-aktifkan kios. Beberapa fitur akan disesuaikan : </h6>
                    <ul class="warning-text">
                        <li>Karyawan tidak dapat menggunakan fitur <b>kios</b> (kasir, barang, rak, etalase, dll)</li>
                        <li>Absensi otomatis akan diisi <b>"Libur"</b></li>
                        <li>Anda hanya dapat mengakses kumpulan fitur <b>"Manajemen"</b> dan <b>"Lainnya"</b></li>
                        <li>Karyawan dan Anda tidak akan mendapatkan <b>notifikasi</b></li>
                    </ul>  
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput" name="date_start">
                            <label for="floatingInput">Tanggal Mulai</label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingInput" name="date_end">
                            <label for="floatingInput">Tanggal Selesai</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 py-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="check_box" id="flexCheckDefault" required>
                            <label class="form-check-label" for="flexCheckDefault"><h6>Saya setuju untuk menonaktifkan kios</h6></label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-warning text-white" type="submit"><i class="fa-solid fa-power-off"></i> Non-Aktifkan</button>
            </form>
        @else
            <form action="/profil/status/aktif" method="POST">
                @csrf
                <h5>Aktifkan Kios</h5>
                <div class="warning-box">
                    <h6>Dengan mengaktifkan kios. Anda dan karyawan dapat menggunakan kembali seluruh fitur. Dan juga mengaktifkan kembali absensi</h6>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_box" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault"><h6>Saya setuju untuk mengaktifkan kios</h6></label>
                </div>
                <button class="btn btn-warning text-white" type="submit"><i class="fa-solid fa-power-off"></i> Aktifkan</button>
            </form>
        @endif
    </div>
</div>
