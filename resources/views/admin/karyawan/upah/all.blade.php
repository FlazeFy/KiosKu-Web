<h5>Karyawan</h5>
<div class="text-nowrap  table-responsive">
    @if(count($karyawan) > 0)
    <table class="table table-paginate" id="karyawanTable" cellspacing="0">
        <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Kontak</th>
            <th>Jabatan</th>
            <th>Absensi</th>
            <th>Gaji</th>
            <th>Diedit Pada</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($karyawan as $kr)
                <!--Status karyawan-->
                @php($status_bg = "")
                @if(($kr->status_karyawan != "aktif")&&($kr->id_context == null))
                    @php($status_bg = "background:rgba(255, 0, 0, 0.15);")
                @elseif(($kr->id_context != null)&&($kr->status_karyawan == "aktif")&&($kr->type_context == "table_upah"))
                    @php($status_bg = "background:rgba(105, 122, 255, 0.15);")
                @endif
                <tr style="{{$status_bg}}">
                    <td>{{$kr->nama_lengkap_karyawan}}</td>
                    <td>
                        <a>{{$kr->ponsel_karyawan}}</a><br>
                        <a>{{$kr->email_karyawan}}</a>
                    </td>
                    <td>{{$kr->jabatan_karyawan}}</td>
                    <td>------</td>
                    <td>Rp. {{$kr->gaji_karyawan}}</td>
                    <td>{{date('Y-m-d', strtotime($kr->updated_at))}}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if($kr->id_context != null)
                                    <form action="/karyawan/upah/unpin/{{$kr->id_tandai}}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit"><i class="fa-solid fa-thumbtack"></i> Lepas</button>
                                    </form>
                                @else
                                    <form action="/karyawan/upah/pin/{{$kr->id_karyawan}}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                                    </form>
                                @endif
                                <a class="dropdown-item"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
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
            <h5>Anda belum memiliki karyawan...</h5>
        </div>
    @endif
</div>