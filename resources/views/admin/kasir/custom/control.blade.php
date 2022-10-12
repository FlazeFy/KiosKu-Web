<style>
    .control-box{
        background:white;
        border-radius:50px;
        position:fixed;
        padding: 15px;
        bottom:2vh;
        left:30%;
        display: inline-block;
    }
    .title_input{
        border: 1.5px solid white;
        padding:5px 5px 5px 35px;
        border-radius: 6px;
    }
    .title_input:hover{
        background: #ebebeb;
    }

    .btn-transparent{
        width: 45px;
        height: 45px;
        border-radius: 100%;
    }

    .exit{
        color: #df4759;
    }
    .exit:hover{
        color: white;
        background: #df4759;
    }

    .help{
        color: #676AFB;
    }
    .help:hover{
        color: white;
        background: #676AFB;
    }
</style>

<div class="control-box shadow">
    <button class="btn btn-transparent exit mx-1" title="Kembali ke Menu" onclick="location.href='/kasir/tampilan'"><i class="fa-solid fa-arrow-left fa-lg"></i></button>
    @foreach($tampilan as $tp)
        <form method="POST" action="/kasir/tampilan/edit_tampilan_title/{{$tp->id}}" class="d-inline position-relative">
            @csrf
            <i class="fa-solid fa-pencil position-absolute" style="top:3px; left:10px;"></i>
            <input class="title_input py-2" type="text" value="{{$tp->nama_tampilan}}" name="nama_tampilan" onblur="this.form.submit()" required>
        </form>
    @endforeach
    <button class="btn btn-transparent help mx-1" title="Bantuan"><i class="fa-solid fa-info fa-lg"></i></button>
    <button class="btn btn-success mx-1 rounded-pill py-2" data-bs-toggle="modal" data-bs-target="#tambah-container-Modal"><i class="fa-solid fa-plus"></i> Tambah Container</button>
</div>