<style>
    .dot{
        height: 15px;
        width: 15px;
        border-radius: 50%;
        display: inline-block;
        background-color:#d2d2d2;
    }
    .dot.hadir{
        background-color:#198754 !important;
    }
    .dot.alpa{
        background-color:#dc3545 !important;
    }
    .dot.sakit{
        background-color:#ffc107 !important;
    }
    .dot.izin{
        background-color:#696cff !important;
    }

    .btn-link{
        color:#696cff !important;
    }
</style>

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
                @elseif(($kr->id_context != null)&&($kr->status_karyawan == "aktif")&&($kr->type_context == "karyawan"))
                    @php($status_bg = "background:rgba(105, 122, 255, 0.15);")
                @endif
                <tr style="{{$status_bg}}">
                    <td>{{$kr->nama_lengkap_karyawan}}</td>
                    <td>
                        <a>{{$kr->ponsel_karyawan}}</a><br>
                        <a>{{$kr->email_karyawan}}</a>
                    </td>
                    <td>{{$kr->jabatan_karyawan}}</td>
                    <td>
                        @php($dates = array())
                        @for ($i = 0; $i < 5; $i++)
                            @php($check = false)
                            @foreach($absen as $as)
                                @if($kr->id_karyawan == $as->id_karyawan)
                                    @if(date('Y-m-d', strtotime($as->waktu_masuk)) == date('Y-m-d', strtotime("-$i days")))
                                        @php($check = true)
                                        <div class="dot {{strtolower($as->status_absen)}}" title="{{$as->status_absen}}" data-bs-toggle="popover"
                                            data-bs-content="
                                            <?php
                                                if($as->status_absen == "Hadir"){
                                                    echo "Masuk : ".date('H:i', strtotime($as->waktu_masuk))." || ";
                                                    echo "Pulang : ".date('H:i', strtotime($as->waktu_pulang));
                                                } else {
                                                    echo "Verifikasi : ".date('H:i', strtotime($as->waktu_masuk));
                                                }
                                            ?>"></div>
                                    @endif
                                @endif
                            @endforeach
                            @if($check == false)
                                <div class="dot" title="Kosong"></div>
                            @endif
                        @endfor
                        <br><a class="btn btn-link p-1"><i class="fa-solid fa-angle-right"></i> Lihat lainnya</a>
                    </td>
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
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-upah-Modal-{{$kr->id_karyawan}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <!--Modal-->
                @include('admin.karyawan.upah.form.edit')

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
<div class="container-fluid p-2">
    <h6>Keterangan :</h6>
    <div class="dot ms-2"></div><a> Data Kosong</a>
    <div class="dot hadir ms-2"></div><a> Hadir</a>
    <div class="dot izin ms-2"></div><a> Izin</a>
    <div class="dot sakit ms-2"></div><a> Sakit</a>
    <div class="dot alpa ms-2"></div><a> Alpa</a>
</div>