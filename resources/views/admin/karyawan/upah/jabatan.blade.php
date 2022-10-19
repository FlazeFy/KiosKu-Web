<a class="title">Jabatan</a><br>
@foreach($total_jabatan as $jbt)
    <div class="card rounded shadow mx-1 my-2 p-2 border-0" style="background:#696cFF; display: inline-block;">
        <a class="text-white">(<span>{{$jbt->karyawan_jml}}</span>) {{$jbt->nama_jabatan}}</a>
    </div>
@endforeach
<div class="card rounded shadow mx-1 my-2 p-2 border-0 bg-success" style="display: inline-block;" data-bs-toggle="modal" data-bs-target="#tambah-jabatan-Modal">
    <a class="text-white"><i class="fa-solid fa-plus"></i> Tambah Jabatan</a>
</div>