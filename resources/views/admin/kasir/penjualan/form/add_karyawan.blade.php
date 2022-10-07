<style>
    .karyawan_add_holder{
        display: inline-block;
        flex-direction: column;
        height: 70vh;
        width:100%;
        overflow-y: scroll;
        padding:10px;
    }
</style>

<div class="modal fade" id="tambah-karyawan-Modal-{{$ks->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/kasir/penjualan/tambah_karyawan/{{$ks->id}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan ke Kasir "{{$ks->nama_kasir}}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body karyawan_add_holder">
                    @php($count_add = 0)
                    @foreach($karyawan as $kr)       
                        @if($kr->id_kasir != $ks->id)   
                        <input hidden name="nama_lengkap_karyawan" value="{{$kr->nama_lengkap_karyawan}}">
                        <div class="card mb-2 rounded w-100 shadow p-3">
                            <div class='row'>
                                <div class='col-2 p-3'>
                                    @if($kr->karyawan_image_url == "null")
                                        <img src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" height="100" width="100" title="{{$kr->nama_karyawan}}" 
                                            class="img img-avatar rounded-circle shadow"/>
                                    @else
                                        <img src="{{url('storage/'.$kr->karyawan_image_url)}}" alt="{{$kr->karyawan_image_url}}.png" height="100" width="100" title="{{$kr->nama_karyawan}}" 
                                            class="img img-avatar rounded-circle shadow"/>
                                    @endif
                                </div>
                                <div class='col-8'>
                                    <h6>{{$kr->nama_lengkap_karyawan}}</h6>
                                    <a>{{$kr->jabatan_karyawan}}</a><br>
                                    <a>Rp. {{$kr->gaji_karyawan}}</a>
                                </div>
                                <div class='col-1 h-40 mt-1 pt-2 pb-2'>
                                    <div class="form-check">
                                        <input class="form-check-input" name="id_karyawan[]" title="Pilih" style="cursor:pointer; height:25px; width:25px;" type="checkbox" value="{{$kr->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php($count_add++)
                        @endif
                    @endforeach
                    @if($count_add == 0)
                        <div class="container text-center d-block mx-auto">
                            <img class="mx-2" src="{{asset('assets/img/storyset/Empty_3.png')}}" alt='Empty.png' style="width:45%; min-width:280px !important;">
                            <h5>Tidak ada karyawan yang tersisa untuk bergabung</h5>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
