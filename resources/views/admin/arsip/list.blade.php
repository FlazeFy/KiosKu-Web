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
        display: flex;
        flex-direction: column;
        height: 80vh;
        overflow-y: scroll;
        width: 20vh;
    }
    .archieve-name{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

<div class="archieve-holder">
    @foreach($archieve as $ar)
        <form class="d-inline mx-auto" action="/arsip/view/{{$ar->id}}" method="POST">
            @csrf
            <input hidden name="nama_arsip" value="{{$ar->nama_arsip}}">
            <button class="btn-archieve" type="submit">
                <img src="{{asset('assets/img/icons/Folder.png')}}" class="img img-fluid folder"/>
                <h6 class="text-primary archieve-name">/{{$ar->nama_arsip}}</h6>
            </buttton>
        </form> 
    @endforeach
</div>