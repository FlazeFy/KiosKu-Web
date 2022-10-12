<style>
    .layout-template{
        width: 100%;
        height: 240px;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 20px;
        background: white;
        border: none;
        position: relative;
    }
    .btn{
        cursor:pointer;
    }
</style>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <button class="container-fluid layout-template shadow text-center bg-primary" data-bs-target="#tambah_tampilan" data-bs-toggle="modal">
            <img class="img img-fluid d-block mx-auto" src="{{asset('assets/img/storyset/Template.png')}}" alt='Template.png' style='height:150px;'>
            <h5 class="text-white">Buat Template</h5>
            <h6 class="text-white">Kreasikan tampilan menu kasir Anda</h6>
        </button>
    </div>
    @foreach($tampilan as $tp)
        @php($config = json_decode($tp->format_tampilan))
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="container-fluid layout-template shadow">
                <a class="text-danger position-absolute btn" style="right:15px; top:15px;" title="Hapus Tampilan"
                    data-bs-target="#hapus_tampilan_{{$tp->id}}" data-bs-toggle="modal"><i class="fa-solid fa-trash fa-lg"></i></a>
                <h6 class="text-primary">{{$tp->nama_tampilan}}</h6>
                <a class="text-primary position-absolute" style="bottom:20px; left:15px;"><i class="fa-solid fa-table-columns"></i> {{count($config)}}</a>
                <div class="position-absolute" style="bottom:8px; right:16vh;">
                    <a class="text-secondary" style="font-size:12px;">Terakhir diperbarui</a>
                    <h6 class="text-primary" style="font-size:14px;">{{date("Y-m-d h:i", strtotime($tp->updated_at))}}</h6>
                </div>
                <button class="btn btn-primary position-absolute" style="bottom:15px; right:15px; width:100px;" onclick="location.href='/kasir/tampilan/custom/{{$tp->id}}'">
                    <i class="fa-solid fa-pen-to-square"></i> Edit</button>
            </div>
        </div>
        @include('admin.kasir.tampilan.form.hapus_tampilan')
    @endforeach
</div>