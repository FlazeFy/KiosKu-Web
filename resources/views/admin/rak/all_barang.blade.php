<h5>Semua Barang</h5>
<div class="text-nowrap">
    @if(count($barang_rak) > 0)
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
                    <td>
                        @if(strtotime($bk->expired_at) == strtotime('0000-00-00 00:00:00'))
                            -
                        @else
                            {{date('Y-m-d', strtotime($bk->expired_at))}}
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"><i class="fa-solid fa-thumbtack"></i> Tandai</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-barang-Modal"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapus-barang-Modal"><i class="fa-solid fa-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @include('admin.rak.form.hapus_barang')
                @include('admin.rak.form.edit_barang')
            @endforeach
        </tbody>
    </table>
    @else
        <div class="container text-center d-block mx-auto">
            <img class="mx-2" src="{{asset('assets/img/storyset/Empty_1.png')}}" alt='Empty.png' style="width:250px;">
            <h5>Rak masih kosong...</h5>
        </div>
    @endif
</div>