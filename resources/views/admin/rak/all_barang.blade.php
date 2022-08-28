<h5>Semua Barang</h5>
<div class="text-nowrap">
    <table class="table">
        <thead>
        <tr>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga Jual</th>
            <th>Harga Stok</th>
            <th>Keuntungan</th>
            <th>Stok</th>
            <th>Expired</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($barang_rak as $bk)
                <tr>
                    <td>{{$bk->kategori_barang}}</td>
                    <td>{{$bk->nama_barang}}</td>
                    <td>{{$bk->deskripsi_barang}}</td>
                    <td>Rp. {{$bk->harga_jual}}</td>
                    <td>Rp. {{$bk->harga_stok}}</td>
                    <td>Rp. {{$bk->harga_jual - $bk->harga_stok}}</td>
                    <td>{{$bk->stok_barang}}</td>
                    <td>{{date('Y-m-d', strtotime($bk->expired_at))}}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"><i class="fa-solid fa-thumbtack"></i> Tandai</a>
                                <a class="dropdown-item"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
                                <a class="dropdown-item"><i class="fa-solid fa-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>