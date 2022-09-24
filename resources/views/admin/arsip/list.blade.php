<style>
    .folder{
        height: 80px;
        display: block;
        margin-inline: auto;
        margin-top:10px;
    }
    .btn-archieve{
        padding:0px;
        margin-bottom:10px;
        border:none;
        background:transparent;
        text-align:center;
    }
    .archieve-holder{
        
    }
</style>

@foreach($archieve as $ar)
    <div class="archieve-holder">
        <form class="d-inline" action="/arsip/view/{{$ar->id}}" method="POST">
            @csrf
            <input hidden name="nama_arsip" value="{{$ar->nama_arsip}}">
            <button class="btn-archieve" type="submit">
                <img src="{{asset('assets/img/icons/Folder.png')}}" class="img img-fluid folder"/>
                <h6 class="text-primary">/{{$ar->nama_arsip}}</h6>
            </buttton>
        </form>
    </div>
@endforeach