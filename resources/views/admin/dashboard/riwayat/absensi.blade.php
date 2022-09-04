<div class="container-fluid p-3 rounded shadow h-100">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-kalender" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-kalender">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <a class="float-start title">Absensi</a><br>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-kalender">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <ul class="custom-scroll scrollbar p-0 m-0 mt-3" style="max-height: calc(65vh - 90px); max-width:auto; overflow-x: auto;">
        @php($date_before = "")
        @php($date_now = "")
        @foreach($absen as $abs)
            @php($date_now = date('Y-m-d', strtotime($abs->waktu_masuk)))
            @if(($date_before == "") || ($date_before != $date_now))
                @php($date_before = date('Y-m-d', strtotime($abs->waktu_masuk)))
                <li class="d-flex my-2">
                    <div class="container w-25 d-block mx-auto text-center rounded p-1" style="background:#676AFB; color:white;">
                        <a style="font-size:14px;">
                            @if(($date_now != date('Y-m-d'))&&($date_now != date('Y-m-d', strtotime('-1 day'))))
                                {{$date_now}}
                            @elseif($date_now == date('Y-m-d', strtotime('-1 day')))
                                Yesterday
                            @else   
                                Today
                            @endif
                        </a>
                    </div>
                </li>
            @endif
            <li class="d-flex mb-4 pb-1">
                <table style="table-layout: fixed; width: 100%;">
                    <tr>
                        <th width="15%"></th>
                        <th width="50%"></th>
                        <th width="35%"></th>
                    </tr>
                    <td>
                        <div class="avatar flex-shrink-0 me-3">
                            @if($abs->karyawan_image_url == "null")
                                <img src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                            @else
                                <img src="{{url('storage/'.$abs->karyawan_image_url)}}" alt="{{$abs->karyawan_image_url}}.png" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">{{$abs->jabatan_karyawan}} <span style="font-weight:500;">({{$abs->nama_shift}})</span></small>
                                <h6 class="mb-0">{{$abs->nama_karyawan}}</h6>
                            </div>
                    </td>
                    <td>
                            <div class="me-2">
                                @php($status_abs = "")
                                @if($abs->status_absen == "Hadir")
                                    @php($status_abs = "success")
                                @elseif($abs->status_absen == "Izin")
                                    @php($status_abs = "muted")
                                @elseif($abs->status_absen == "Alpa")
                                    @php($status_abs = "danger")
                                @elseif($abs->status_absen == "Sakit")
                                    @php($status_abs = "warning")
                                @endif
                                <small class="text-{{$status_abs}} d-block mb-1" style="font-weight:500;">{{$abs->status_absen}}</small>
                                <h6 class="mb-0">
                                    @if($abs->status_absen == "Hadir")
                                        {{date('H:i', strtotime($abs->waktu_masuk))}} - 
                                        @if($abs->waktu_pulang != null)
                                            {{date('H:i', strtotime($abs->waktu_pulang))}}
                                        @else
                                            ...
                                        @endif
                                    @else 
                                        <span class="absen-list-body">{{$abs->deskripsi_absen}}</span>
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </td>
                </table>
            </li>
        @endforeach
    </ul>
</div>