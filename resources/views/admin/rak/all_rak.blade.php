<h5>Semua Rak</h5>
<button class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#tambah-rak-Modal"><i class="fa-solid fa-plus"></i> Tambah Rak</button>
<div class="text-nowrap">
    @if(count($rak) > 0)
    <table class="table table-paginate" id="rakTable" cellspacing="0">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Dibuat pada</th>
            <th>Diedit pada</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($rak as $rk)
                <tr>
                    <td>{{$rk->nama_rak}}</td>
                    <td>{{$rk->deskripsi_rak}}</td>
                    <td>{{date('Y-m-d', strtotime($rk->created_at))}}</td>
                    <td>{{date('Y-m-d', strtotime($rk->updated_at))}}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"><i class="fa-solid fa-thumbtack"></i> Tandai</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-rak-Modal-{{$rk->id}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hapus-rak-Modal-{{$rk->id}}"><i class="fa-solid fa-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @include('admin.rak.form.edit_rak')
                @include('admin.rak.form.hapus_rak')
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