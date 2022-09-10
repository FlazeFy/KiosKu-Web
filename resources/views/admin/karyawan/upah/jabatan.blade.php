<a class="title">Jabatan</a><br>
@foreach($jabatan as $jbt)
    <div class="card rounded shadow mx-1 my-2 p-2 border-0" style="background:#696cFF; display: inline-block;">
        <a class="text-white">(<span>{{$jbt->karyawan_jml}}</span>) {{$jbt->jabatan_karyawan}}</a>
    </div>
@endforeach