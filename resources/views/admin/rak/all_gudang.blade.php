<h5>Gudang</h5>
<div class="text-nowrap">
    @if(count($gudang) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Expired</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($gudang as $brg)
                <tr>
                    <td>{{$brg->kategori_barang}}</td>
                    <td>{{$brg->nama_barang}}</td>
                    <td>{{$brg->deskripsi_barang}}</td>
                    <td>Rp. {{$brg->harga_jual}}</td>
                    <td>{{$brg->stok_barang}}</td>
                    <td>
                        @if(strtotime($brg->expired_at) == strtotime('0000-00-00 00:00:00'))
                            -
                        @else
                            {{date('Y-m-d', strtotime($brg->expired_at))}}
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"><i class="fa-solid fa-thumbtack"></i> Tandai</a>
                                <form action="/rak/tambah_barang_rak/{{$op->id}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$brg->id}}" name="id_barang">
                                    <button class="dropdown-item" type="submit"><i class="fa-solid fa-plus"></i> Tambahkan</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="container text-center d-block mx-auto">
            <img class="mx-2" src="{{asset('assets/img/storyset/Empty_1.png')}}" alt='Empty.png' style="width:250px;">
            <h5>Gudang masih kosong...</h5>
        </div>
    @endif
</div>