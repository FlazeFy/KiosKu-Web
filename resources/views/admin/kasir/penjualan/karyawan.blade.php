<style>
    .img-avatar{
        width:45px;
        height:45px;
        margin-right:5px;
        margin-bottom:5px;
        cursor: pointer;
    }
    .karyawan_kasir_holder{
        display: inline-block;
        flex-direction: column;
        height: 140px;
        width:100%;
        overflow-y: scroll;
        padding:5px;
    }
</style>

<span class="karyawan_kasir_holder">
    <img src="{{asset('assets/img/icons/add_karyawan_kasir.png')}}" height="100" width="100" title="Tambah Karyawan" 
        data-bs-toggle="modal" data-bs-target="#tambah-karyawan-Modal-{{$ks->id}}" class="img img-avatar rounded-circle shadow bg-success p-1"/>
    @foreach($rel_kasir as $rk)
        @if($rk->id_kasir == $ks->id)
            @if($ks->karyawan_image_url == "null")
                <img src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" height="100" width="100" title="{{$rk->nama_karyawan}}" 
                    data-bs-toggle="modal" data-bs-target="#hapus-karyawan-Modal-{{$rk->id}}" class="img img-avatar rounded-circle shadow"/>
            @else
                <img src="{{url('storage/'.$rk->karyawan_image_url)}}" alt="{{$rk->karyawan_image_url}}.png" height="100" width="100" title="{{$rk->nama_karyawan}}" 
                    data-bs-toggle="modal" data-bs-target="#hapus-karyawan-Modal-{{$rk->id}}" class="img img-avatar rounded-circle shadow"/>
            @endif
            @include('admin.kasir.penjualan.form.hapus_karyawan')
        @endif
    @endforeach
</span>