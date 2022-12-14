<h5>Gudang</h5>
<div class="text-nowrap  table-responsive">
    @if(count($gudang) > 0)
    <table class="table table-paginate" id="gudangTable" cellspacing="0">
        <thead>
        <tr>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Expired</th>
            <th>Diedit Pada</th>
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
                        @if($brg->expired_at == null)
                            -
                        @else
                            {{date('Y-m-d', strtotime($brg->expired_at))}}
                        @endif
                    </td>
                    <td>{{date('Y-m-d', strtotime($brg->updated_at))}}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"><i class="fa-solid fa-thumbtack"></i> Tandai</a>
                                <form id="add_barang_rak_{{$brg->id}}_form">
                                    @csrf
                                    <input type="hidden" value="{{$op->id}}" name="id_rak">
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

<script type="text/javascript">
    //Post ajax
    <?php
        foreach($gudang as $brg){
            echo"
            $('#add_barang_rak_".$brg->id."_form').submit(function( event ) {
                event.preventDefault();
                $.ajax({
                    url: '/rak/tambah_barang_rak',
                    type: 'post',
                    data: $('#add_barang_rak_".$brg->id."_form').serialize(),
                    dataType: 'json',
                    success: function( _response ){
                        // Handle your response..
                    },
                    error: function( _response ){
                        // Handle error
                    }
                });
            });";
        }
    ?>
</script>